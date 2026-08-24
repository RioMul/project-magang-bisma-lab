<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ServerPackage;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderWizardController extends Controller
{
    // TAHAP 1: Template (Ultra Optimized)
    public function template(Request $request)
    {
        $category = $request->query('category');

        $query = Template::query()
            ->select(['id', 'name', 'slug', 'category', 'description', 'preview_image', 'demo_url', 'setup_price'])
            ->where('is_active', true);

        if ($category && $category !== 'All Templates') {
            $query->where('category', $category);
        }

        $templates = $query->orderBy('id', 'asc')->get();
        $categories = ['All Templates', 'UMKM', 'Company', 'School', 'Government', 'Creative'];

        return view('order.template', compact('templates', 'categories', 'category'));
    }

    public function postTemplate(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:templates,id',
        ]);

        session([
            'order.template_id' => $validated['template_id'],
            'order.step_active' => true,
        ]);

        return redirect()->route('order.domain');
    }

    // TAHAP 2: Domain
    public function domain(Request $request)
    {
        $search = $request->query('search');
        $template = Template::find(session('order.template_id'));

        $extensions = [
            ['tld' => '.com', 'price' => 150000, 'desc' => 'Standar global untuk bisnis'],
            ['tld' => '.id', 'price' => 225000, 'desc' => 'Terpercaya untuk brand Indonesia'],
            ['tld' => '.net', 'price' => 165000, 'desc' => 'Ideal untuk jaringan & teknologi'],
        ];

        return view('order.domain', compact('search', 'extensions', 'template'));
    }

    public function postDomain(Request $request)
    {
        $validated = $request->validate([
            'domain' => 'required|string|max:100',
            'domain_price' => 'required|numeric',
        ]);

        session([
            'order.domain' => strtolower(trim($validated['domain'])),
            'order.domain_price' => $validated['domain_price'],
        ]);

        return redirect()->route('order.package');
    }

    // TAHAP 3: Paket Server
    public function package()
    {
        $template = Template::find(session('order.template_id'));
        $packages = ServerPackage::where('is_active', true)->get();

        return view('order.package', compact('template', 'packages'));
    }

    public function postPackage(Request $request)
    {
        $validated = $request->validate([
            'server_package_id' => 'required|exists:server_packages,id',
        ]);

        session([
            'order.server_package_id' => $validated['server_package_id'],
        ]);

        return redirect()->route('order.checkout');
    }

    // TAHAP 4: Checkout
    public function checkout()
    {
        $template = Template::find(session('order.template_id'));
        $server = ServerPackage::find(session('order.server_package_id'));
        $domain = session('order.domain');
        $domainPrice = session('order.domain_price', 150000);

        if (!$template || !$server || !$domain) {
            return redirect()->route('order.template')->with('info', 'Silakan pilih template terlebih dahulu.');
        }

        $totalAmount = $template->setup_price + $server->price_per_month + $domainPrice;

        return view('order.checkout', compact('template', 'server', 'domain', 'domainPrice', 'totalAmount'));
    }

    public function processOrder(Request $request)
    {
        if (!Auth::check()) {
            $validatedUser = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $validatedUser['name'],
                'email' => $validatedUser['email'],
                'password' => Hash::make($validatedUser['password']),
                'role' => 'cashier',
            ]);

            Auth::login($user);
        }

        $template = Template::findOrFail(session('order.template_id'));
        $server = ServerPackage::findOrFail(session('order.server_package_id'));
        $domain = session('order.domain');
        $domainPrice = session('order.domain_price', 150000);
        $totalAmount = $template->setup_price + $server->price_per_month + $domainPrice;

        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id(),
            'template_id' => $template->id,
            'server_package_id' => $server->id,
            'customer_name' => Auth::user()->name,
            'customer_email' => Auth::user()->email,
            'customer_whatsapp' => $request->customer_whatsapp ?? '-',
            'desired_domain' => $domain,
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        session()->forget(['order.template_id', 'order.domain', 'order.domain_price', 'order.server_package_id', 'order.step_active']);

        return redirect()->route('dashboard')->with('success', 'Pesanan #' . $order->order_number . ' berhasil dibuat!');
    }
}