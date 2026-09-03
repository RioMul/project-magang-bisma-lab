<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'price_monthly',
        'price_annually',
        'is_popular',
        'is_active',
    ];

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'package_features')
            ->withPivot('is_included', 'limit_value')
            ->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}