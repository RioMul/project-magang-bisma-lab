<?php

namespace App\Services\Order;

class OrderSessionService
{
    private string $prefix = 'order.';

    public function setTemplate(int|string $templateId): void
    {
        session([$this->prefix . 'template_id' => $templateId]);
    }

    public function getTemplateId(): int|string|null
    {
        return session($this->prefix . 'template_id');
    }

    public function setDomain(string $domain, float|int $price): void
    {
        session([
            $this->prefix . 'domain' => $domain,
            $this->prefix . 'domain_price' => $price,
        ]);
    }

    public function getDomain(): ?string
    {
        return session($this->prefix . 'domain');
    }

    public function getDomainPrice(): float|int
    {
        return session($this->prefix . 'domain_price', 0);
    }

    public function setPackage(int|string $packageId): void
    {
        session([$this->prefix . 'package_id' => $packageId]);
    }

    public function getPackageId(): int|string|null
    {
        return session($this->prefix . 'package_id');
    }

    public function setPaymentMethod(string $method): void
    {
        session([$this->prefix . 'payment_method' => $method]);
    }

    public function getPaymentMethod(): ?string
    {
        return session($this->prefix . 'payment_method');
    }

    public function hasTemplate(): bool
    {
        return session()->has($this->prefix . 'template_id');
    }

    public function hasDomain(): bool
    {
        return session()->has($this->prefix . 'domain');
    }

    public function hasPackage(): bool
    {
        return session()->has($this->prefix . 'package_id');
    }

    public function hasPaymentMethod(): bool
    {
        return session()->has($this->prefix . 'payment_method');
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
        ]);
    }
}