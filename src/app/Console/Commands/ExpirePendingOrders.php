<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExpirePendingOrders extends Command
{
    protected $signature = 'orders:expire-pending';

    protected $description = 'Expire pending orders older than 24 hours';

    public function handle(): int
    {
        $expiredBefore = now()->subHours(24);

        $orders = Order::query()
            ->with(['payment', 'invoice'])
            ->where('status', 'pending')
            ->where('created_at', '<=', $expiredBefore)
            ->get();

        foreach ($orders as $order) {
            DB::transaction(function () use ($order) {
                $order->update([
                    'status' => 'expired',
                ]);

                if ($order->payment) {
                    $order->payment->update([
                        'status' => 'expired',
                        'paid_at' => null,
                    ]);
                }

                if ($order->invoice) {
                    $order->invoice->update([
                        'status' => 'expired',
                        'paid_at' => null,
                    ]);
                }
            });
        }

        $this->info(
            $orders->count() . ' pending order(s) expired.'
        );

        return self::SUCCESS;
    }
}