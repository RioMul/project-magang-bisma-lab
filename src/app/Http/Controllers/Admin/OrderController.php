<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with([
                'user',
                'orderItems.template',
                'orderItems.package',
                'payment',
                'invoice',
            ])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');

                $query->where(function ($query) use ($search) {
                    $query
                        ->where('order_number', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_email', 'like', "%{$search}%")
                        ->orWhere('domain_name', 'like', "%{$search}%")
                        ->orWhereHas('orderItems', function ($itemQuery) use ($search) {
                            $itemQuery->where(
                                'domain_name',
                                'like',
                                "%{$search}%"
                            );
                        });
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->input('status'));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $orders->getCollection()->each(function (Order $order) {
            $item = $order->orderItems->first();

            if (!$item) {
                return;
            }

            $order->setAttribute('domain_name', $item->domain_name);
            $order->setRelation('template', $item->template);
            $order->setRelation('package', $item->package);
        });

        $returnSource = $request->query('return_to', 'billing');
        $returnQueryString = (string) $request->query('return_query', '');

        parse_str($returnQueryString, $returnQuery);

        $allowedBillingQueryKeys = ['search', 'status', 'page'];
        $safeBillingQuery = array_intersect_key(
            $returnQuery,
            array_flip($allowedBillingQueryKeys)
        );

        if ($returnSource === 'dashboard') {
            $backUrl = route('admin.dashboard');
            $backLabel = 'Kembali ke Dashboard';
        } else {
            $backUrl = route('admin.billing.index', $safeBillingQuery);
            $backLabel = 'Kembali ke Billing';
        }

        return view('admin.orders.index', compact(
            'orders',
            'backUrl',
            'backLabel',
            'returnSource',
            'returnQueryString'
        ));
    }

    public function show(Request $request, Order $order)
    {
        $order->load([
            'user',
            'orderItems.template',
            'orderItems.package',
            'payment',
            'invoice',
        ]);

        $item = $order->orderItems->first();

        if ($item) {
            $order->setAttribute('domain_name', $item->domain_name);
            $order->setRelation('template', $item->template);
            $order->setRelation('package', $item->package);
        }

        $returnSource = $request->query('return_to');
        $returnQueryString = (string) $request->query('return_query', '');

        parse_str($returnQueryString, $returnQuery);

        $allowedReturnQueryKeys = [
            'search',
            'status',
            'page',
            'return_to',
            'return_query',
        ];

        $safeReturnQuery = array_intersect_key(
            $returnQuery,
            array_flip($allowedReturnQueryKeys)
        );

        if ($returnSource === 'dashboard') {
            $backUrl = route('admin.dashboard');
        } elseif ($returnSource === 'billing') {
            $allowedBillingQueryKeys = ['search', 'status', 'page'];
            $safeBillingQuery = array_intersect_key(
                $returnQuery,
                array_flip($allowedBillingQueryKeys)
            );

            $backUrl = route('admin.billing.index', $safeBillingQuery);
        } elseif ($returnSource === 'orders') {
            $backUrl = route('admin.orders.index', $safeReturnQuery);
        } else {
            $backUrl = route('admin.orders.index');
        }

        return view('admin.orders.show', compact(
            'order',
            'backUrl'
        ));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,paid,expired,cancelled',
            ],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            'Status order berhasil diperbarui.'
        );
    }
}