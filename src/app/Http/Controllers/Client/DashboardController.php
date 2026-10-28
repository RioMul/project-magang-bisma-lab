<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\Template;
use App\Services\Order\OrderSessionService;
use App\Services\Template\TemplateContentService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private int $pendingOrderLifetimeHours = 24;

    public function __construct(
        private OrderSessionService $orderSession,
        private TemplateContentService $templateContent
    ) {}

    public function index()
    {
        $this->expireOldPendingOrders();

        $orders = Order::where('user_id', Auth::id())
            ->with([
                'template',
                'package',
                'orderItems.template',
                'orderItems.package',
                'payment',
            ])
            ->latest()
            ->get();

        $latestOrder = $orders->first();

        $paidOrder = $orders
            ->where('status', 'paid')
            ->first();

        $pendingOrder = $orders
            ->where('status', 'pending')
            ->first();

        $paidOrderItem = $paidOrder?->orderItems->first();
        $pendingOrderItem = $pendingOrder?->orderItems->first();

        $hasPaidOrder = $paidOrder !== null;
        $hasPendingOrder = $pendingOrder !== null;

        $hasTemplate = $this->orderSession->hasTemplate();
        $hasDomain = $this->orderSession->hasDomain();
        $hasPackage = $this->orderSession->hasPackage();
        $hasPaymentMethod = $this->orderSession->hasPaymentMethod();

        $hasPendingDraft =
            $hasTemplate ||
            $hasDomain ||
            $hasPackage;

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

        $activeOrder = $pendingOrder ?? $paidOrder;
        $activeOrderItem = $pendingOrder
            ? $pendingOrderItem
            : $paidOrderItem;

        $domainName =
            $activeOrderItem?->domain_name
            ?? $activeOrder?->domain_name
            ?? $this->orderSession->getDomain();

        $packageName =
            $activeOrderItem?->package?->name
            ?? $activeOrder?->package?->name
            ?? $pendingPackage?->name;

        $planName =
            $activeOrderItem?->package?->short_description
            ?? $activeOrder?->package?->short_description
            ?? $pendingPackage?->short_description;

        $templateName =
            $activeOrderItem?->template?->name
            ?? $activeOrder?->template?->name
            ?? $pendingTemplate?->name;

        $websiteStatus = $paidOrderItem?->website_status;

        if ($hasPaidOrder) {
            $systemStatus = $websiteStatus ?: 'pending';
        } elseif ($hasPendingOrder) {
            $systemStatus = 'pending';
        } elseif ($hasPendingDraft) {
            $systemStatus = 'inactive';
        } else {
            $systemStatus = 'inactive';
        }

        $editorAvailable = false;
        $canManageWebsite = false;

        $paidTemplate =
            $paidOrderItem?->template
            ?? $paidOrder?->template;

        if ($paidOrder && $paidTemplate) {
            $editorAvailable = $this->templateContent->isEditable(
                $paidTemplate->slug
            );

            $canManageWebsite =
                $editorAvailable
                && $this->templateContent->userCopyExists($paidOrder);
        }

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
            ? $pendingOrder->created_at->copy()
                ->addHours($this->pendingOrderLifetimeHours)
            : null;

        $remainingDraftMinutes =
            $this->orderSession->getRemainingMinutes();

        return view(
            'client.dashboard',
            compact(
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
                'editorAvailable',
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
            )
        );
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