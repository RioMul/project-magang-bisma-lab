<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function show(Order $order)
    {
        if ((string) $order->user_id !== (string) Auth::id()) {
            abort(403);
        }

        $order->load([
            // Relasi lama tetap dimuat karena view invoice saat ini
            // masih membaca kolom template_id/package_id/domain_name.
            'template.type',
            'template.images',
            'package',

            // Data baru untuk invoice dan rincian website.
            'invoice',
            'orderItems.template.images',
            'orderItems.package',
        ]);

        return view('order.invoice.show', compact('order'));
    }
}