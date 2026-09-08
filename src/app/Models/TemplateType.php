<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function templates()
    {
        return $this->hasMany(Template::class);
    }
}