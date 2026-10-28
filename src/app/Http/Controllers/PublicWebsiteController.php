<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicWebsiteController extends Controller
{
    public function show(Request $request)
    {
        $host = strtolower(rtrim($request->getHost(), '.'));

        $appHost = strtolower(
            (string) parse_url(config('app.url'), PHP_URL_HOST)
        );

        $mainHosts = array_filter([
            $appHost,
            'www.' . $appHost,
            'localhost',
            '127.0.0.1',
            '::1',
        ]);

        if (in_array($host, $mainHosts, true)) {
            return app(LandingController::class)->index();
        }

        $orderItem = OrderItem::query()
            ->with([
                'order',
                'template',
            ])
            ->whereRaw('LOWER(domain_name) = ?', [$host])
            ->whereIn('website_status', ['active', 'published'])
            ->whereIn('domain_status', ['registered', 'active'])
            ->whereHas('order', function ($query) {
                $query->where('status', 'paid');
            })
            ->where(function ($query) {
                $query->whereNull('website_expires_at')
                    ->orWhere('website_expires_at', '>', now());
            })
            ->latest('id')
            ->first();

        if (!$orderItem || !$orderItem->template) {
            abort(404);
        }

        $website = $this->loadWebsiteContent($orderItem);

        if (!$website) {
            abort(404);
        }

        return view(
            'client.template.partials.preview_layout',
            compact('website', 'orderItem')
        );
    }

    private function loadWebsiteContent(OrderItem $orderItem): ?array
    {
        $itemPath = 'user_websites/order_items/item_'
            . $orderItem->id
            . '.json';

        if (Storage::disk('local')->exists($itemPath)) {
            $website = json_decode(
                Storage::disk('local')->get($itemPath),
                true
            );

            if (is_array($website)) {
                return $website;
            }
        }

        $order = $orderItem->order;

        if ($order) {
            $legacyPath = 'user_websites/user_'
                . $order->user_id
                . '_'
                . $order->order_number
                . '.json';

            if (Storage::disk('local')->exists($legacyPath)) {
                $website = json_decode(
                    Storage::disk('local')->get($legacyPath),
                    true
                );

                if (is_array($website)) {
                    return $website;
                }
            }
        }

        $masterPath = resource_path(
            'templates/' . $orderItem->template->slug . '.json'
        );

        if (!is_file($masterPath)) {
            return null;
        }

        $website = json_decode(
            file_get_contents($masterPath),
            true
        );

        return is_array($website) ? $website : null;
    }
}