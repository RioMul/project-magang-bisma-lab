<?php

namespace App\Services\Template;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TemplateContentService
{
    private array $editableTemplates = [
        'nexus',
        'artisan',
    ];

    public function isEditable(string $slug): bool
    {
        return in_array($slug, $this->editableTemplates, true);
    }

    public function getMaster(string $slug): ?array
    {
        $path = resource_path('templates/' . $slug . '.json');

        if (!file_exists($path)) {
            return null;
        }

        $content = file_get_contents($path);

        if (!$content) {
            return null;
        }

        $data = json_decode($content, true);

        return is_array($data) ? $data : null;
    }

    public function getMasterByOrder(Order $order): ?array
    {
        $item = $this->getOrderItem($order);
        $slug = $item?->template?->slug
            ?? $order->template?->slug;

        if (!$slug) {
            return null;
        }

        return $this->getMaster($slug);
    }

    /**
     * Lokasi baru memakai ID order_item.
     * Jika pesanan lama belum memiliki item, gunakan lokasi lama.
     */
    public function getUserPath(Order $order): string
    {
        $item = $this->getOrderItem($order);

        if ($item) {
            return 'user_websites/order_items/item_'
                . $item->id
                . '.json';
        }

        return $this->getLegacyUserPath($order);
    }

    private function getLegacyUserPath(Order $order): string
    {
        return 'user_websites/user_'
            . $order->user_id
            . '_'
            . $order->order_number
            . '.json';
    }

    private function getOrderItem(Order $order): ?OrderItem
    {
        return $order->orderItems()
            ->with('template')
            ->orderBy('id')
            ->first();
    }

    public function userCopyExists(Order $order): bool
    {
        $newPath = $this->getUserPath($order);

        if (Storage::disk('local')->exists($newPath)) {
            return true;
        }

        $legacyPath = $this->getLegacyUserPath($order);

        return $legacyPath !== $newPath
            && Storage::disk('local')->exists($legacyPath);
    }

    public function createUserCopy(Order $order): ?array
    {
        $master = $this->getMasterByOrder($order);

        if (!$master) {
            return null;
        }

        $item = $this->getOrderItem($order);
        $slug = $item?->template?->slug
            ?? $order->template?->slug;

        if (!$slug || !$this->isEditable($slug)) {
            return null;
        }

        $path = $this->getUserPath($order);

        Storage::disk('local')->put(
            $path,
            json_encode(
                $master,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );

        return $master;
    }

    public function getUserWebsite(Order $order): ?array
    {
        $newPath = $this->getUserPath($order);

        if (Storage::disk('local')->exists($newPath)) {
            $content = Storage::disk('local')->get($newPath);
            $website = json_decode($content, true);

            return is_array($website) ? $website : null;
        }

        $legacyPath = $this->getLegacyUserPath($order);

        if (
            $legacyPath === $newPath
            || !Storage::disk('local')->exists($legacyPath)
        ) {
            return null;
        }

        $content = Storage::disk('local')->get($legacyPath);
        $website = json_decode($content, true);

        return is_array($website) ? $website : null;
    }

    public function saveUserWebsite(Order $order, array $website): void
    {
        $path = $this->getUserPath($order);

        Storage::disk('local')->put(
            $path,
            json_encode(
                $website,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );
    }

    public function getEditableOrder(): ?Order
    {
        if (!Auth::check()) {
            return null;
        }

        $orders = Order::where('user_id', Auth::id())
            ->where('status', 'paid')
            ->with([
                'template',
                'orderItems.template',
            ])
            ->latest()
            ->get();

        foreach ($orders as $order) {
            $item = $order->orderItems->first();
            $template = $item?->template ?? $order->template;

            if (
                $template
                && $this->isEditable($template->slug)
            ) {
                return $order;
            }
        }

        return null;
    }

    public function canManageWebsite(): bool
    {
        $order = $this->getEditableOrder();

        if (!$order) {
            return false;
        }

        return $this->userCopyExists($order);
    }
}