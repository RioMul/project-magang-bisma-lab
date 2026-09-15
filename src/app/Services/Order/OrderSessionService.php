<?php

namespace App\Services\Order;

use Carbon\Carbon;

class OrderSessionService
{
    private string $prefix = 'order.';

    private int $draftLifetimeMinutes = 60;

    public function start(): void
    {
        if (!session()->has($this->prefix . 'started_at')) {
            session([
                $this->prefix . 'started_at' => now()->toIso8601String(),
                $this->prefix . 'expires_at' => now()
                    ->addMinutes($this->draftLifetimeMinutes)
                    ->toIso8601String(),
            ]);
        }
    }

    public function hasExpired(): bool
    {
        $expiresAt = session($this->prefix . 'expires_at');

        if (!$expiresAt) {
            return false;
        }

        return now()->greaterThanOrEqualTo(
            Carbon::parse($expiresAt)
        );
    }

    public function ensureActive(): bool
    {
        if ($this->hasExpired()) {
            $this->clear();

            return false;
        }

        return true;
    }

    public function getExpiresAt(): ?Carbon
    {
        $expiresAt = session($this->prefix . 'expires_at');

        return $expiresAt
            ? Carbon::parse($expiresAt)
            : null;
    }

    public function getRemainingMinutes(): int
    {
        $expiresAt = $this->getExpiresAt();

        if (!$expiresAt) {
            return 0;
        }

        return max(0, now()->diffInMinutes($expiresAt, false));
    }

    public function setTemplate(int|string $templateId): void
    {
        $this->start();

        session([
            $this->prefix . 'template_id' => $templateId,
        ]);
    }

    public function getTemplateId(): int|string|null
    {
        $this->ensureActive();

        return session($this->prefix . 'template_id');
    }

    public function setDomain(string $domain, float|int $price): void
    {
        $this->start();

        session([
            $this->prefix . 'domain' => $domain,
            $this->prefix . 'domain_price' => $price,
        ]);
    }

    public function getDomain(): ?string
    {
        $this->ensureActive();

        return session($this->prefix . 'domain');
    }

    public function getDomainPrice(): float|int
    {
        $this->ensureActive();

        return session($this->prefix . 'domain_price', 0);
    }

    public function setPackage(int|string $packageId): void
    {
        $this->start();

        session([
            $this->prefix . 'package_id' => $packageId,
        ]);
    }

    public function getPackageId(): int|string|null
    {
        $this->ensureActive();

        return session($this->prefix . 'package_id');
    }

    public function setPaymentMethod(string $method): void
    {
        $this->start();

        session([
            $this->prefix . 'payment_method' => $method,
        ]);
    }

    public function getPaymentMethod(): ?string
    {
        $this->ensureActive();

        return session($this->prefix . 'payment_method');
    }

    public function clearPaymentMethod(): void
    {
        session()->forget(
            $this->prefix . 'payment_method'
        );
    }

    public function hasTemplate(): bool
    {
        $this->ensureActive();

        return session()->has($this->prefix . 'template_id');
    }

    public function hasDomain(): bool
    {
        $this->ensureActive();

        return session()->has($this->prefix . 'domain');
    }

    public function hasPackage(): bool
    {
        $this->ensureActive();

        return session()->has($this->prefix . 'package_id');
    }

    public function hasPaymentMethod(): bool
    {
        $this->ensureActive();

        return session()->has($this->prefix . 'payment_method');
    }

    public function isComplete(): bool
    {
        return $this->hasTemplate()
            && $this->hasDomain()
            && $this->hasPackage();
    }

    public function getMissingSteps(): array
    {
        $missing = [];

        if (!$this->hasTemplate()) {
            $missing[] = 'Template';
        }

        if (!$this->hasDomain()) {
            $missing[] = 'Domain';
        }

        if (!$this->hasPackage()) {
            $missing[] = 'Paket';
        }

        return $missing;
    }

    public function clear(): void
    {
        session()->forget([
            $this->prefix . 'template_id',
            $this->prefix . 'domain',
            $this->prefix . 'domain_price',
            $this->prefix . 'package_id',
            $this->prefix . 'payment_method',
            $this->prefix . 'started_at',
            $this->prefix . 'expires_at',
        ]);
    }
}