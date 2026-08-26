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
    // STEP 1: TEMPLATE
    public function template(Request $request)
    {
        return $this->selectTemplate($request);
    }

    public function selectTemplate(Request $request)
    {
        $selectedCategory = $request->query('category', 'All');
        $search = $request->query('search');

        $query = Template::where('is_active', true);

        if ($selectedCategory !== 'All' && !empty($selectedCategory)) {
            $query->where('category', $selectedCategory);
        }

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $templates = $query->get();

        $categories = Template::where('is_active', true)
            ->pluck('category')
            ->unique()
            ->values()
            ->toArray();

        return view('order.template', compact('templates', 'categories', 'selectedCategory'));
    }

    public function storeTemplate(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:templates,id',
        ]);

        session(['order.template_id' => $validated['template_id']]);
        return redirect()->route('order.domain');
    }

    // STEP 2: DOMAIN
    public function searchDomain(Request $request)
    {
        if (!session('order.template_id')) {
            return redirect()->route('order.template')
                ->with('error', 'Silakan pilih template terlebih dahulu sebelum melanjutkan ke domain.');
        }

        $selectedTemplate = Template::find(session('order.template_id'));
        $searchQuery = $request->query('q');
        $domainResults = [];

        if ($searchQuery) {
            $cleanName = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower($searchQuery));
            
            $extensions = [
                ['ext' => '.com', 'price' => 150000, 'available' => true],
                ['ext' => '.id', 'price' => 225000, 'available' => ($cleanName !== 'tokombakhars' && $cleanName !== 'bismartech')],
                ['ext' => '.co.id', 'price' => 275000, 'available' => true],
                ['ext' => '.net', 'price' => 140000, 'available' => true],
                ['ext' => '.org', 'price' => 140000, 'available' => false],
            ];

            foreach ($extensions as $ext) {
                $domainResults[] = [
                    'domain' => $cleanName . $ext['ext'],
                    'price' => $ext['price'],
                    'available' => $ext['available']
                ];
            }
        }

        return view('order.domain', compact('selectedTemplate', 'searchQuery', 'domainResults'));
    }

    public function storeDomain(Request $request)
    {
        $validated = $request->validate([
            'selected_domain' => 'required|string',
            'domain_price'    => 'nullable|numeric',
        ]);

        session([
            'order.domain'       => $validated['selected_domain'],
            'order.domain_price' => $validated['domain_price'] ?? 150000,
        ]);

        return redirect()->route('order.package');
    }

    // STEP 3: PACKAGE
    public function selectPackage(Request $request)
    {
        if (!session('order.template_id')) {
            return redirect()->route('order.template')
                ->with('error', 'Anda harus memilih template terlebih dahulu.');
        }
        if (!session('order.domain')) {
            return redirect()->route('order.domain')
                ->with('error', 'Anda harus memilih domain terlebih dahulu sebelum masuk ke paket harga.');
        }

        $packages = ServerPackage::where('is_active', true)->get();
        $templateId = session('order.template_id');
        $selectedTemplate = Template::find($templateId);
        $selectedPackageId = session('order.package_id');
        $selectedDomain = session('order.domain');

        return view('order.package', compact('packages', 'selectedTemplate', 'selectedPackageId', 'selectedDomain'));
    }

    public function storePackage(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:server_packages,id',
        ]);

        session(['order.package_id' => $validated['package_id']]);

        return redirect()->route('order.checkout');
    }

    // STEP 4: CHECKOUT (PEMBAYARAN)
    public function checkout(Request $request)
    {
        if (!session('order.template_id') || !session('order.domain') || !session('order.package_id')) {
            return redirect()->route('order.template')
                ->with('error', 'Sesi pemesanan belum lengkap. Silakan lengkapi dari awal.');
        }

        $template = Template::find(session('order.template_id'));
        $package = ServerPackage::find(session('order.package_id'));
        $domain = session('order.domain');
        $domainPrice = session('order.domain_price', 150000);

        return view('order.checkout', compact('template', 'package', 'domain', 'domainPrice'));
    }

    // PROSES LOGIN DARI HALAMAN CHECKOUT
    public function processCheckLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Kembalikan ke checkout dengan status akun terautentikasi (Navbar otomatis berubah)
            return back()->with('success', 'Berhasil masuk! Silakan klik tombol pembayaran untuk menyelesaikan pesanan.');
        }

        return back()->withErrors([
            'login_email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput();
    }

    // PROSES REGISTER DARI HALAMAN CHECKOUT
    public function processCheckRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // Kembalikan ke checkout dengan status akun terautentikasi (Navbar otomatis berubah)
        return back()->with('success', 'Akun berhasil dibuat! Silakan klik tombol pembayaran untuk menyelesaikan pesanan.');
    }

    // EKSEKUSI PEMBAYARAN FINAL (Ketika Tombol Bayar Ditekan Lagi)
    public function processCheckout(Request $request)
    {
        if (!Auth::check()) {
            return back()->with('error', 'Mohon masuk atau buat akun terlebih dahulu.');
        }

        $request->validate([
            'payment_method' => 'nullable|string',
        ]);

        if ($request->filled('payment_method')) {
            session(['order.payment_method' => $request->payment_method]);
        }

        return $this->finalizeOrder();
    }

    // FINALISASI ORDER KE DATABASE
    private function finalizeOrder()
    {
        $packageId   = session('order.package_id');
        $templateId  = session('order.template_id');
        $domain      = session('order.domain');
        $domainPrice = session('order.domain_price', 150000);

        if (!$packageId || !$templateId || !$domain) {
            return redirect()->route('order.package')
                ->with('error', 'Sesi pesanan Anda kedaluwarsa. Silakan pilih paket kembali.');
        }

        $package = ServerPackage::find($packageId);

        if (!$package) {
            return redirect()->route('order.package')
                ->with('error', 'Paket server tidak ditemukan. Silakan pilih ulang.');
        }

        $totalPrice = $package->price + $domainPrice;

        Order::create([
            'user_id'           => Auth::id(),
            'template_id'       => $templateId,
            'server_package_id' => $packageId,
            'domain'            => $domain,
            'total_price'       => $totalPrice, 
            'payment_method'    => session('order.payment_method', 'bank_transfer'),
            'status'            => 'paid',
        ]);

        session()->forget([
            'order.template_id', 
            'order.domain', 
            'order.domain_price', 
            'order.package_id', 
            'order.payment_method'
        ]);

        return back()->with('payment_success', 'Pembayaran berhasil! Nota pesanan telah dikirimkan ke email Anda.');
    }
}