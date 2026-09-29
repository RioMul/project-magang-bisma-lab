<?php

namespace App\Services;

use App\Models\Order;
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
        $slug = $order->template?->slug;

        if (!$slug) {
            return null;
        }

        return $this->getMaster($slug);
    }

    public function getUserPath(Order $order): string
    {
        return 'user_websites/user_'
            . $order->user_id
            . '_'
            . $order->order_number
            . '.json';
    }

    public function userCopyExists(Order $order): bool
    {
        return Storage::disk('local')->exists(
            $this->getUserPath($order)
        );
    }

    public function createUserCopy(Order $order): ?array
    {
        $slug = $order->template?->slug;

        if (!$slug || !$this->isEditable($slug)) {
            return null;
        }

        $master = $this->getMaster($slug);

        if (!$master) {
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
        $path = $this->getUserPath($order);

        if (!Storage::disk('local')->exists($path)) {
            return null;
        }

        $content = Storage::disk('local')->get($path);

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
            ->with('template')
            ->latest()
            ->get();

        foreach ($orders as $order) {
            if (
                $order->template &&
                $this->isEditable($order->template->slug)
            ) {
                return $order;
            }
        }

        return null;
    }
}