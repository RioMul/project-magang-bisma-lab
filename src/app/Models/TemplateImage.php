<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateImage extends Model
{
    protected $fillable = [
        'template_id',
        'image_path',
        'alt_text',
        'is_primary',
        'sort_order',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}