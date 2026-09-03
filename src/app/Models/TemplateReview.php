<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'user_id',
        'rating',
        'comment',
    ];

    /**
     * Relasi ke Template (Setiap review dimiliki oleh satu template)
     */
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * Relasi ke User (Setiap review ditulis oleh satu user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}