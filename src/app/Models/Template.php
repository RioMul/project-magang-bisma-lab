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
        'is_featured',
        'is_active',
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}