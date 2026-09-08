<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PackageFeature extends Pivot
{
    protected $table = 'package_features';

    protected $fillable = [
        'package_id',
        'feature_id',
        'is_included',
        'limit_value',
    ];
}