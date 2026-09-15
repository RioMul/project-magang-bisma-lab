<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\Template;
use App\Services\Order\OrderSessionService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private int $pendingOrderLifetimeHours = 24;

    public function __construct(
        private OrderSessionService $orderSession
    ) {}

    public function index()
    {
        $this->expireOldPendingOrders();

        $orders = Order::where('user_id', Auth::id())
            ->with(['template', 'package', 'website', 'payment'])
            ->latest()
            ->get();

        $latestOrder = $orders->first();

        $paidOrder = $orders
            ->where('status', 'paid')
            ->first();

        $pendingOrder = $orders
            ->where('status', 'pending')
            ->first();

        $hasPaidOrder = $paidOrder !== null;
        $hasPendingOrder = $pendingOrder !== null;

        $hasTemplate = $this->orderSession->hasTemplate();
        $hasDomain = $this->orderSession->hasDomain();
        $hasPackage = $this->orderSession->hasPackage();
        $hasPaymentMethod = $this->orderSession->hasPaymentMethod();

        $hasPendingDraft = $hasTemplate
            || $hasDomain
            || $hasPackage;

        $pendingTemplate = null;
        $pendingPackage = null;

        if ($hasTemplate) {
            $pendingTemplate = Template::find(
                $this->orderSession->getTemplateId()
            );
        }

        if ($hasPackage) {
            $pendingPackage = Package::find(
                $this->orderSession->getPackageId()
            );
        }

        /*
         * Order yang pending diprioritaskan agar user melihat
         * pesanan terbaru yang masih menunggu pembayaran/verifikasi.
         */
        $activeOrder = $pendingOrder ?? $paidOrder;

        $domainName = $activeOrder?->domain_name
            ?? $this->orderSession->getDomain();

        $packageName = $activeOrder?->package?->name
            ?? $pendingPackage?->name;

        $planName = $activeOrder?->package?->short_description
            ?? $pendingPackage?->short_description;

        $templateName = $activeOrder?->template?->name
            ?? $pendingTemplate?->name;

        $websiteStatus = $paidOrder?->website?->status;

        if ($hasPaidOrder) {
            $systemStatus = $websiteStatus ?: 'active';
        } elseif ($hasPendingOrder) {
            $systemStatus = 'pending';
        } elseif ($hasPendingDraft) {
            $systemStatus = 'inactive';
        } else {
            $systemStatus = 'inactive';
        }

        $canManageWebsite = $hasPaidOrder;

        /*
         * Order Wizard
         */
        $completedSteps = 0;

        if ($hasTemplate) {
            $completedSteps++;
        }

        if ($hasDomain) {
            $completedSteps++;
        }

        if ($hasPackage) {
            $completedSteps++;
        }

        if ($hasPaymentMethod) {
            $completedSteps++;
        }

        $totalSteps = 4;

        $progressPercentage = (int) round(
            ($completedSteps / $totalSteps) * 100
        );

        $nextStepRoute = null;
        $nextStepLabel = null;
        $nextStepDescription = null;

        if ($hasPendingOrder) {
            $nextStepRoute = route(
                'order.invoice',
                $pendingOrder->order_number
            );

            $nextStepLabel = 'Lihat Pesanan';

            $nextStepDescription =
                'Pesanan Anda sudah dibuat dan sedang menunggu proses verifikasi pembayaran.';
        } elseif (!$hasTemplate) {
            $nextStepRoute = route('order.template');

            $nextStepLabel = 'Mulai Pesanan';

            $nextStepDescription =
                'Pilih template website untuk mulai membuat website Anda.';
        } elseif (!$hasDomain) {
            $nextStepRoute = route('order.domain');

            $nextStepLabel = 'Lanjutkan';

            $nextStepDescription =
                'Template sudah dipilih. Lanjutkan dengan memilih domain untuk website Anda.';
        } elseif (!$hasPackage) {
            $nextStepRoute = route('order.package');

            $nextStepLabel = 'Lanjutkan';

            $nextStepDescription =
                'Domain sudah dipilih. Selanjutnya tentukan paket website yang sesuai.';
        } elseif (!$hasPaymentMethod) {
            $nextStepRoute = route('order.checkout');

            $nextStepLabel = 'Lanjutkan Pembayaran';

            $nextStepDescription =
                'Semua kebutuhan website sudah dipilih. Tinggal menyelesaikan pembayaran.';
        }

        $pendingPaymentUrl = $hasPendingOrder
            ? route('order.invoice', $pendingOrder->order_number)
            : route('order.checkout');

        $pendingOrderExpiresAt = $pendingOrder?->created_at
            ? $pendingOrder->created_at->copy()->addHours(
                $this->pendingOrderLifetimeHours
            )
            : null;

        $remainingDraftMinutes = $this->orderSession
            ->getRemainingMinutes();

        return view('client.dashboard', compact(
            'orders',
            'latestOrder',
            'paidOrder',
            'pendingOrder',
            'hasPaidOrder',
            'hasPendingOrder',
            'hasPendingDraft',
            'hasTemplate',
            'hasDomain',
            'hasPackage',
            'hasPaymentMethod',
            'pendingTemplate',
            'pendingPackage',
            'domainName',
            'packageName',
            'planName',
            'templateName',
            'systemStatus',
            'canManageWebsite',
            'pendingPaymentUrl',
            'pendingOrderExpiresAt',
            'completedSteps',
            'totalSteps',
            'progressPercentage',
            'nextStepRoute',
            'nextStepLabel',
            'nextStepDescription',
            'remainingDraftMinutes'
        ));
    }

    private function expireOldPendingOrders(): void
    {
        $expiredBefore = now()->subHours(
            $this->pendingOrderLifetimeHours
        );

        Order::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->where('created_at', '<=', $expiredBefore)
            ->update([
                'status' => 'expired',
            ]);
    }
}