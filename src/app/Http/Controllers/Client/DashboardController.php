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
    public function __construct(
        private OrderSessionService $orderSession
    ) {}

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['template', 'package', 'website'])
            ->latest()
            ->get();

        $latestOrder = $orders->first();

        $hasPaidOrder = $orders->contains(function ($order) {
            return strtolower((string) $order->status) === 'paid';
        });

        $hasTemplate = $this->orderSession->hasTemplate();
        $hasDomain = $this->orderSession->hasDomain();
        $hasPackage = $this->orderSession->hasPackage();

        $hasPendingOrder = $hasTemplate || $hasDomain || $hasPackage;

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

        $domainName = $latestOrder?->domain_name
            ?? $this->orderSession->getDomain();

        $packageName = $latestOrder?->package?->name
            ?? $pendingPackage?->name;

        $templateName = $latestOrder?->template?->name
            ?? $pendingTemplate?->name;

        $websiteStatus = $latestOrder?->website?->status;

        if ($hasPaidOrder) {
            $systemStatus = $websiteStatus ?: 'active';
        } elseif ($hasPendingOrder) {
            $systemStatus = 'inactive';
        } else {
            $systemStatus = 'inactive';
        }

        $canManageWebsite = $hasPaidOrder;

        $pendingPaymentUrl = route('order.checkout');

        return view('client.dashboard', compact(
            'orders',
            'latestOrder',
            'hasPaidOrder',
            'hasPendingOrder',
            'hasTemplate',
            'hasDomain',
            'hasPackage',
            'pendingTemplate',
            'pendingPackage',
            'domainName',
            'packageName',
            'templateName',
            'systemStatus',
            'canManageWebsite',
            'pendingPaymentUrl'
        ));
    }
}