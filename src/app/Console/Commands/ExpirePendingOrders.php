<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class ExpirePendingOrders extends Command
{
    protected $signature = 'orders:expire-pending';

    protected $description = 'Expire pending orders older than 24 hours';

    public function handle(): int
    {
        $expiredBefore = now()->subHours(24);

        $orders = Order::where('status', 'pending')
            ->where('created_at', '<=', $expiredBefore)
            ->get();

        foreach ($orders as $order) {
            $order->update([
                'status' => 'expired',
            ]);

            if ($order->payment) {
                $order->payment->update([
                    'status' => 'expired',
                ]);
            }
        }

        $this->info(
            $orders->count() . ' pending order(s) expired.'
        );

        return self::SUCCESS;
    }
}