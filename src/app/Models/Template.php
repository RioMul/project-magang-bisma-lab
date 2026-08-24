<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'preview_image',
        'demo_url',
        'setup_price',
        'is_active',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}