<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\Template;
use App\Models\User;
use App\Services\Order\OrderSessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct(
        private OrderSessionService $orderSession
    ) {
    }

    public function index()
    {
        $missingSteps = $this->orderSession->getMissingSteps();

        if (!empty($missingSteps)) {
            if (Auth::check()) {
                return redirect()->route('dashboard');
            }

            return redirect()->route('order.template');
        }

        $template = Template::with('images')
            ->findOrFail($this->orderSession->getTemplateId());

        $package = Package::findOrFail(
            $this->orderSession->getPackageId()
        );

        $domain = $this->orderSession->getDomain();
        $domainPrice = $this->orderSession->getDomainPrice();

        $totalAmount = $package->price_annually + $domainPrice;

        return response()
            ->view('order.checkout.index', compact(
                'template',
                'package',
                'domain',
                'domainPrice',
                'totalAmount'
            ))
            ->header(
                'Cache-Control',
                'no-cache, no-store, max-age=0, must-revalidate'
            )
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }

    public function savePaymentMethod(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => [
                'required',
                'in:bank_transfer,credit_card,ewallet,qris',
            ],
        ]);

        $this->orderSession->setPaymentMethod(
            $validated['payment_method']
        );

        return redirect()->route('order.checkout');
    }

    public function resetPaymentMethod()
    {
        session()->forget('order.payment_method');

        return redirect()->route('order.checkout');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            return back()
                ->withErrors([
                    'login_email' => 'Email atau password salah.',
                ])
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('order.checkout');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('order.checkout');
    }

    public function finalize()
    {
        if (
            !empty($this->orderSession->getMissingSteps()) ||
            !$this->orderSession->hasPaymentMethod() ||
            !Auth::check()
        ) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Sesi pembayaran telah kedaluwarsa atau pesanan sudah diproses.'
                );
        }

        $template = Template::findOrFail(
            $this->orderSession->getTemplateId()
        );

        $package = Package::findOrFail(
            $this->orderSession->getPackageId()
        );

        $domain = $this->orderSession->getDomain();
        $domainPrice = $this->orderSession->getDomainPrice();

        $totalAmount = $package->price_annually + $domainPrice;

        $order = Order::create([
            'order_number' => 'BISMA-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(Str::random(6)),

            'user_id' => Auth::id(),
            'template_id' => $template->id,
            'package_id' => $package->id,

            'customer_name' => Auth::user()->name,
            'customer_email' => Auth::user()->email,
            'customer_whatsapp' => '-',

            'domain_name' => $domain,
            'total_amount' => $totalAmount,
            'payment_method' => $this->orderSession->getPaymentMethod(),

            'status' => 'paid',
            'notes' => null,
        ]);

        $order->website()->create([
            'user_id' => Auth::id(),
            'domain_name' => $domain,
            'status' => 'building',
            'expires_at' => now()->addYear(),
        ]);

        $this->orderSession->clear();

        return redirect()
            ->route('order.invoice', $order->order_number)
            ->with('payment_success', 'Pembayaran berhasil!');
    }
}