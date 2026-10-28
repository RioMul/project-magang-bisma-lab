<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'template_id',
        'package_id',
        'domain_name',
        'template_price',
        'package_price',
        'domain_price',
        'billing_period_months',
        'subtotal',
        'domain_status',
        'website_status',
        'website_expires_at',
        'renewal_of_order_item_id',
        'price_breakdown_is_estimated',
    ];

    protected $casts = [
        'template_price' => 'decimal:2',
        'package_price' => 'decimal:2',
        'domain_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'billing_period_months' => 'integer',
        'website_expires_at' => 'datetime',
        'price_breakdown_is_estimated' => 'boolean',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function renewalOf()
    {
        return $this->belongsTo(
            self::class,
            'renewal_of_order_item_id'
        );
    }

    public function renewals()
    {
        return $this->hasMany(
            self::class,
            'renewal_of_order_item_id'
        );
    }
}