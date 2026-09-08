<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'name',
        'description',
        'sort_order',
    ];

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_features')
            ->withPivot('is_included', 'limit_value')
            ->withTimestamps();
    }
}