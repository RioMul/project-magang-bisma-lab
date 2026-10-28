<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'template_type_id',
        'name',
        'slug',
        'description',
        'demo_url',
        'difficulty',
        'is_active',
        'is_featured',
        'price',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function type()
    {
        return $this->belongsTo(TemplateType::class, 'template_type_id');
    }

    public function images()
    {
        return $this->hasMany(TemplateImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(TemplateReview::class);
    }

    /**
     * Relasi lama dipertahankan untuk pesanan lama.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}