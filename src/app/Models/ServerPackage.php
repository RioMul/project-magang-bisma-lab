<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpu',
        'ram',
        'storage',
        'bandwidth',
        'price_per_month',
        'is_active',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}