<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_website_id',
        'page_path',
        'visitor_id',
        'ip_address',
        'user_agent',
        'referer',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    public function website()
    {
        return $this->belongsTo(UserWebsite::class, 'user_website_id');
    }
}