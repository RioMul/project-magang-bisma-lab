<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainPrice extends Model
{
    protected $fillable = [
        'domain_extension_id',
        'price',
        'billing_period',
    ];

    public function extension()
    {
        return $this->belongsTo(DomainExtension::class, 'domain_extension_id');
    }
}