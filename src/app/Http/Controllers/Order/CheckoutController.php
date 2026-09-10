<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\Checkout\LoginRequest;
use App\Http\Requests\Order\Checkout\PaymentRequest;
use App\Http\Requests\Order\Checkout\RegisterRequest;
use App\Models\Order;
use App\Models\Package;
use App\Models\Template;
use App\Models\User;
use App\Services\Order\OrderSessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;

class CheckoutController extends Controller
{
    public function __construct(
        private OrderSessionService $orderSession
    ) {}

    public function index()
    {
        $missingSteps = $this->orderSession->getMissingSteps();

        if (!empty($missingSteps)) {
            if (!$this->orderSession->hasTemplate()) {
                return redirect()->route('order.template')->with('error', 'Silakan pilih template terlebih dahulu.');
            }
            if (!$this->orderSession->hasDomain()) {
                return redirect()->route('order.domain')->with('error', 'Silakan pilih domain terlebih dahulu.');
            }
            return redirect()->route('order.package')->with('error', 'Silakan pilih paket terlebih dahulu.');
        }

        $template = Template::with('images')->findOrFail($this->orderSession->getTemplateId());
        $package = Package::findOrFail($this->orderSession->getPackageId());

        $domain = $this->orderSession->getDomain();
        $domainPrice = $this->orderSession->getDomainPrice();
        $paymentMethod = $this->orderSession->getPaymentMethod();

        $totalAmount = $package->price_annually + $domainPrice;

        return response()
            ->view('order.checkout.index', compact('template', 'package', 'domain', 'domainPrice', 'totalAmount', 'paymentMethod'))
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }

    public function savePaymentMethod(PaymentRequest $request)
    {
        if (!$this->orderSession->isComplete()) {
            return redirect()->route('order.checkout')->with('error', 'Data pesanan belum lengkap.');
        }

        $this->orderSession->setPaymentMethod($request->validated('payment_method'));

        return redirect()->route('order.checkout');
    }

    public function resetPaymentMethod()
    {
        $this->orderSession->clearPaymentMethod();
        return redirect()->route('order.checkout');
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated(), $request->boolean('remember'))) {
            return back()->withErrors(['login_email' => 'Email atau password salah.'])->withInput();
        }

        $request->session()->regenerate();
        return redirect()->route('order.checkout');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => Hash::make($request->validated('password')),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('order.checkout');
    }

    public function finalize()
    {
        if (!$this->orderSession->isComplete()) {
            return redirect()->route('order.checkout')->with('error', 'Data pesanan belum lengkap.');
        }

        if (!$this->orderSession->hasPaymentMethod()) {
            return redirect()->route('order.checkout')->with('error', 'Silakan pilih metode pembayaran terlebih dahulu.');
        }

        if (!Auth::check()) {
            return redirect()->route('order.checkout')->with('error', 'Silakan login atau daftar terlebih dahulu.');
        }

        try {
            DB::beginTransaction();

            $template = Template::findOrFail($this->orderSession->getTemplateId());
            $package = Package::findOrFail($this->orderSession->getPackageId());
            $domain = $this->orderSession->getDomain();
            $domainPrice = $this->orderSession->getDomainPrice();
            $totalAmount = $package->price_annually + $domainPrice;

            $order = Order::create([
                'order_number' => 'BISMA-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
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
            ]);

            $order->website()->create([
                'user_id' => Auth::id(),
                'domain_name' => $domain,
                'status' => 'building',
                'expires_at' => now()->addYear(),
            ]);

            $this->orderSession->clear();
            
            DB::commit();

            return redirect()->route('order.invoice', $order->order_number)->with('payment_success', 'Pembayaran berhasil!');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('order.checkout')->with('error', 'Terjadi kesalahan sistem saat memproses pesanan. Silakan coba lagi.');
        }
    }
}