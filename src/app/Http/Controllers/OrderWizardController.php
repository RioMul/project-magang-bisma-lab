<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\Template;
use App\Models\TemplateType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderWizardController extends Controller
{
    // --- 1. TEMPLATE ---
    public function template(Request $request)
    {
        $selectedCategory = $request->query('category', 'All');
        $search = $request->query('search');
        $query = Template::with(['type', 'images'])->where('is_active', true);

        if ($selectedCategory !== 'All' && !empty($selectedCategory)) {
            $query->whereHas('type', function($q) use ($selectedCategory) {
                $q->where('name', $selectedCategory);
            });
        }

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $templates = $query->get();
        $categories = TemplateType::pluck('name')->toArray();

        return view('order.template', compact('templates', 'categories', 'selectedCategory'));
    }

    public function storeTemplate(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:templates,id',
        ]);

        session(['order.template_id' => $validated['template_id']]);

        return redirect()->route('order.domain')->with('success', 'Template berhasil dipilih. Sekarang Anda dapat memilih domain.');
    }

    // --- 2. DOMAIN ---
    public function searchDomain(Request $request)
    {
        $selectedTemplate = session('order.template_id') ? Template::with('images')->find(session('order.template_id')) : null;
        $searchQuery = $request->query('q');
        $domainResults = [];

        if (!empty($searchQuery)) {
            $cleanName = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower($searchQuery));
            
            $extensions = [
                ['ext' => '.com', 'price' => 150000, 'available' => true],
                ['ext' => '.id', 'price' => 225000, 'available' => true],
            ];

            foreach ($extensions as $extension) {
                $domainResults[] = [
                    'domain' => $cleanName . $extension['ext'],
                    'price' => $extension['price'],
                    'available' => $extension['available'],
                ];
            }
        }

        return view('order.domain', compact('selectedTemplate', 'searchQuery', 'domainResults'));
    }

    public function storeDomain(Request $request)
    {
        if (!session('order.template_id')) {
            return redirect()->route('order.domain')->with('error', 'Silakan pilih template terlebih dahulu.');
        }

        $validated = $request->validate([
            'selected_domain' => 'required|string',
            'domain_price' => 'required|numeric',
        ]);

        session([
            'order.domain' => $validated['selected_domain'],
            'order.domain_price' => $validated['domain_price'],
        ]);

        return redirect()->route('order.package')->with('success', 'Domain berhasil dipilih. Anda sekarang dapat memilih paket.');
    }

    // --- 3. PACKAGE ---
    public function selectPackage()
    {
        $packages = Package::with('features')->where('is_active', true)->get();
        $selectedTemplate = session('order.template_id') ? Template::with('images')->find(session('order.template_id')) : null;
        $selectedPackageId = session('order.package_id');
        $selectedDomain = session('order.domain');

        return view('order.package', compact('packages', 'selectedTemplate', 'selectedPackageId', 'selectedDomain'));
    }

    public function storePackage(Request $request)
    {
        if (!session('order.template_id')) {
            return redirect()->route('order.package')->with('error', 'Silakan pilih template terlebih dahulu.');
        }

        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);

        session(['order.package_id' => $validated['package_id']]);

        if (!session('order.domain')) {
            return redirect()->route('order.domain')->with('success', 'Paket berhasil dipilih. Sekarang silakan pilih domain.');
        }

        return redirect()->route('order.checkout');
    }

    // --- 4. CHECKOUT (ALUR CERDAS) ---
    private function getMissingSteps(): array
    {
        $missingSteps = [];
        if (!session('order.template_id')) $missingSteps[] = 'Template';
        if (!session('order.domain')) $missingSteps[] = 'Domain';
        if (!session('order.package_id')) $missingSteps[] = 'Paket';
        return $missingSteps;
    }

    public function checkout()
    {
        $missingSteps = $this->getMissingSteps();
        if (!empty($missingSteps)) {
            return redirect()->route('order.template')->with('error', 'Pesanan belum lengkap. Silakan pilih: ' . implode(', ', $missingSteps) . '.');
        }

        $template = Template::with('images')->findOrFail(session('order.template_id'));
        $package = Package::findOrFail(session('order.package_id'));
        $domain = session('order.domain');
        $domainPrice = session('order.domain_price', 0);
        $totalAmount = $package->price_annually + $domainPrice;

        return view('order.checkout', compact('template', 'package', 'domain', 'domainPrice', 'totalAmount'));
    }

    // Aksi Menyimpan Metode Pembayaran
    public function savePaymentMethod(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => ['required', 'in:bank_transfer,credit_card,ewallet,qris'],
        ]);

        session(['order.payment_method' => $validated['payment_method']]);
        return redirect()->route('order.checkout');
    }

    // Aksi Kembali Memilih Pembayaran (Reset)
    public function resetPaymentMethod()
    {
        session()->forget('order.payment_method');
        return redirect()->route('order.checkout');
    }

    // Aksi Auth Login
    public function processCheckLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'login_email' => 'Email atau password salah.'
            ])->withInput();
        }

        $request->session()->regenerate();
        return redirect()->route('order.checkout')->with('success', 'Berhasil masuk. Silakan konfirmasi pesanan Anda.');
    }

    // Aksi Auth Register
    public function processCheckRegister(Request $request)
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

        return redirect()->route('order.checkout')->with('success', 'Akun berhasil dibuat. Silakan konfirmasi pesanan Anda.');
    }

    // Aksi Finalisasi Pemesanan
    public function finalizeOrder()
    {
        if (!empty($this->getMissingSteps()) || !session('order.payment_method') || !Auth::check()) {
            return redirect()->route('order.checkout')->with('error', 'Data pesanan belum lengkap atau Anda belum login.');
        }

        $template = Template::findOrFail(session('order.template_id'));
        $package = Package::findOrFail(session('order.package_id'));
        $domainPrice = session('order.domain_price', 0);
        $totalAmount = $package->price_annually + $domainPrice;

        $order = Order::create([
            'order_number' => $this->generateOrderNumber(),
            'user_id' => Auth::id(),
            'template_id' => $template->id,
            'package_id' => $package->id,
            'customer_name' => Auth::user()->name,
            'customer_email' => Auth::user()->email,
            'customer_whatsapp' => '-',
            'domain_name' => session('order.domain'),
            'total_amount' => $totalAmount,
            'payment_method' => session('order.payment_method'),
            'status' => 'paid',
            'notes' => null,
        ]);

        $order->website()->create([
            'user_id' => Auth::id(),
            'domain_name' => session('order.domain'),
            'status' => 'building',
            'expires_at' => now()->addYear(),
        ]);

        session()->forget([
            'order.template_id',
            'order.domain',
            'order.domain_price',
            'order.package_id',
            'order.payment_method'
        ]);

        return redirect()->route('order.invoice', $order->order_number)->with('payment_success', 'Pembayaran berhasil!');
    }

    // --- 5. INVOICE ---
    public function invoice(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['template.images', 'package']);
        return view('order.invoice', compact('order'));
    }

    private function generateOrderNumber(): string
    {
        do {
            $orderNumber = 'BISMA-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        } while (Order::where('order_number', $orderNumber)->exists());
        
        return $orderNumber;
    }
}