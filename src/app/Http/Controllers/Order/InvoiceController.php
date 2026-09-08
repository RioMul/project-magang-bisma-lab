<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load([
            'template.type',
            'template.images',
            'package',
        ]);

        return view('order.invoice.show', compact('order'));
    }
}