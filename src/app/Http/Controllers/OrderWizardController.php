<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ServerPackage;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrderWizardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TEMPLATE
    |--------------------------------------------------------------------------
    */

    public function template(Request $request)
    {
        $selectedCategory = $request->query('category', 'All');
        $search = $request->query('search');

        $query = Template::where('is_active', true);

        if ($selectedCategory !== 'All' && !empty($selectedCategory)) {
            $query->where('category', $selectedCategory);
        }

        if (!empty($search)) {
            $query->where(
                'name',
                'like',
                '%' . $search . '%'
            );
        }

        $templates = $query->get();

        $categories = Template::where('is_active', true)
            ->pluck('category')
            ->unique()
            ->values()
            ->toArray();

        return view(
            'order.template',
            compact(
                'templates',
                'categories',
                'selectedCategory'
            )
        );
    }

    public function storeTemplate(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:templates,id',
        ]);

        session([
            'order.template_id' => $validated['template_id'],
        ]);

        return redirect()
            ->route('order.domain');
    }


    /*
    |--------------------------------------------------------------------------
    | DOMAIN
    |--------------------------------------------------------------------------
    */

    public function searchDomain(Request $request)
    {
        if (!session('order.template_id')) {
            return redirect()
                ->route('order.template')
                ->with(
                    'error',
                    'Silakan pilih template terlebih dahulu.'
                );
        }

        $selectedTemplate = Template::findOrFail(
            session('order.template_id')
        );

        $searchQuery = $request->query('q');

        $domainResults = [];

        if (!empty($searchQuery)) {
            $cleanName = preg_replace(
                '/[^a-zA-Z0-9-]/',
                '',
                strtolower($searchQuery)
            );

            $extensions = [
                [
                    'ext' => '.com',
                    'price' => 150000,
                    'available' => true,
                ],
                [
                    'ext' => '.id',
                    'price' => 225000,
                    'available' => true,
                ],
                [
                    'ext' => '.co.id',
                    'price' => 275000,
                    'available' => true,
                ],
                [
                    'ext' => '.net',
                    'price' => 140000,
                    'available' => true,
                ],
                [
                    'ext' => '.org',
                    'price' => 140000,
                    'available' => false,
                ],
            ];

            foreach ($extensions as $extension) {
                $domainResults[] = [
                    'domain' => $cleanName . $extension['ext'],
                    'price' => $extension['price'],
                    'available' => $extension['available'],
                ];
            }
        }

        return view(
            'order.domain',
            compact(
                'selectedTemplate',
                'searchQuery',
                'domainResults'
            )
        );
    }

    public function storeDomain(Request $request)
    {
        $validated = $request->validate([
            'selected_domain' => 'required|string',
            'domain_price' => 'required|numeric',
        ]);

        session([
            'order.domain' => $validated['selected_domain'],
            'order.domain_price' => $validated['domain_price'],
        ]);

        return redirect()
            ->route('order.package');
    }


    /*
    |--------------------------------------------------------------------------
    | PACKAGE
    |--------------------------------------------------------------------------
    */

    public function selectPackage()
    {
        if (!session('order.template_id')) {
            return redirect()
                ->route('order.template')
                ->with(
                    'error',
                    'Silakan pilih template terlebih dahulu.'
                );
        }

        if (!session('order.domain')) {
            return redirect()
                ->route('order.domain')
                ->with(
                    'error',
                    'Silakan pilih domain terlebih dahulu.'
                );
        }

        $packages = ServerPackage::where(
            'is_active',
            true
        )->get();

        $selectedTemplate = Template::findOrFail(
            session('order.template_id')
        );

        $selectedPackageId = session(
            'order.package_id'
        );

        $selectedDomain = session(
            'order.domain'
        );

        return view(
            'order.package',
            compact(
                'packages',
                'selectedTemplate',
                'selectedPackageId',
                'selectedDomain'
            )
        );
    }

    public function storePackage(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:server_packages,id',
        ]);

        session([
            'order.package_id' => $validated['package_id'],
        ]);

        return redirect()
            ->route('order.checkout');
    }


    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function checkout()
    {
        if (
            !session('order.template_id') ||
            !session('order.domain') ||
            !session('order.package_id')
        ) {
            return redirect()
                ->route('order.template')
                ->with(
                    'error',
                    'Sesi pesanan belum lengkap.'
                );
        }

        $template = Template::findOrFail(
            session('order.template_id')
        );

        $package = ServerPackage::findOrFail(
            session('order.package_id')
        );

        $domain = session(
            'order.domain'
        );

        $domainPrice = session(
            'order.domain_price',
            0
        );

        $totalAmount =
            $package->price +
            $domainPrice;

        return view(
            'order.checkout',
            compact(
                'template',
                'package',
                'domain',
                'domainPrice',
                'totalAmount'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PROCESS CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => [
                'required',
                'in:bank_transfer,credit_card,ewallet,qris',
            ],
        ]);

        session([
            'order.payment_method' =>
                $validated['payment_method'],
        ]);

        /*
         * Belum login:
         * arahkan ke Check Register.
         */
        if (!Auth::check()) {
            return redirect()
                ->route('order.check_register');
        }

        /*
         * Sudah login:
         * langsung buat order.
         */
        return $this->finalizeOrder();
    }


    /*
    |--------------------------------------------------------------------------
    | CHECK REGISTER
    |--------------------------------------------------------------------------
    */

    public function checkRegister()
    {
        /*
         * Jika sudah login, tidak perlu
         * masuk halaman login/register lagi.
         */
        if (Auth::check()) {
            return redirect()
                ->route('order.checkout');
        }

        if (
            !session('order.template_id') ||
            !session('order.domain') ||
            !session('order.package_id')
        ) {
            return redirect()
                ->route('order.template')
                ->with(
                    'error',
                    'Sesi pesanan belum lengkap.'
                );
        }

        $template = Template::findOrFail(
            session('order.template_id')
        );

        $package = ServerPackage::findOrFail(
            session('order.package_id')
        );

        $domain = session(
            'order.domain'
        );

        $domainPrice = session(
            'order.domain_price',
            0
        );

        $totalAmount =
            $package->price +
            $domainPrice;

        return view(
            'order.check_register',
            compact(
                'template',
                'package',
                'domain',
                'domainPrice',
                'totalAmount'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN DARI CHECK REGISTER
    |--------------------------------------------------------------------------
    */

    public function processCheckLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
            ],
        ]);

        if (
            !Auth::attempt(
                $credentials,
                $request->boolean('remember')
            )
        ) {
            return back()
                ->withErrors([
                    'login_email' =>
                        'Email atau password salah.',
                ])
                ->withInput();
        }

        $request
            ->session()
            ->regenerate();

        return redirect()
            ->route('order.checkout')
            ->with(
                'success',
                'Berhasil masuk. Silakan lanjutkan pembayaran.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER DARI CHECK REGISTER
    |--------------------------------------------------------------------------
    */

    public function processCheckRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make(
                $validated['password']
            ),
        ]);

        Auth::login($user);

        $request
            ->session()
            ->regenerate();

        return redirect()
            ->route('order.checkout')
            ->with(
                'success',
                'Akun berhasil dibuat. Silakan lanjutkan pembayaran.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | FINALIZE ORDER
    |--------------------------------------------------------------------------
    */

    private function finalizeOrder()
    {
        $templateId = session(
            'order.template_id'
        );

        $packageId = session(
            'order.package_id'
        );

        $domain = session(
            'order.domain'
        );

        $domainPrice = session(
            'order.domain_price',
            0
        );

        $paymentMethod = session(
            'order.payment_method'
        );

        if (
            !$templateId ||
            !$packageId ||
            !$domain ||
            !$paymentMethod ||
            !Auth::check()
        ) {
            return redirect()
                ->route('order.checkout')
                ->with(
                    'error',
                    'Data pesanan belum lengkap.'
                );
        }

        $template = Template::findOrFail(
            $templateId
        );

        $package = ServerPackage::findOrFail(
            $packageId
        );

        $totalAmount =
            $package->price +
            $domainPrice;

        $order = Order::create([
            'order_number' =>
                $this->generateOrderNumber(),

            'user_id' =>
                Auth::id(),

            'template_id' =>
                $template->id,

            'server_package_id' =>
                $package->id,

            'customer_name' =>
                Auth::user()->name,

            'customer_email' =>
                Auth::user()->email,

            'customer_whatsapp' =>
                '-',

            'desired_domain' =>
                $domain,

            'total_amount' =>
                $totalAmount,

            'payment_method' =>
                $paymentMethod,

            'status' =>
                'paid',

            'notes' =>
                null,
        ]);

        /*
         * Hapus session wizard setelah order berhasil dibuat.
         */
        session()->forget([
            'order.template_id',
            'order.domain',
            'order.domain_price',
            'order.package_id',
            'order.payment_method',
        ]);

        return redirect()
            ->route(
                'order.invoice',
                $order->order_number
            )
            ->with(
                'payment_success',
                'Pembayaran berhasil!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | INVOICE
    |--------------------------------------------------------------------------
    */

    public function invoice(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load([
            'template',
            'serverPackage',
        ]);

        return view(
            'order.invoice',
            compact('order')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GENERATE ORDER NUMBER
    |--------------------------------------------------------------------------
    */

    private function generateOrderNumber(): string
    {
        do {
            $orderNumber =
                'BISMA-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(
                    str()->random(6)
                );

        } while (
            Order::where(
                'order_number',
                $orderNumber
            )->exists()
        );

        return $orderNumber;
    }
}