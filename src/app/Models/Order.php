<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'template_id',
        'server_package_id',
        'customer_name',
        'customer_email',
        'customer_whatsapp',
        'desired_domain',
        'total_amount',
        'payment_method',
        'status',
        'notes',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function template()
    {
        return $this->belongsTo(Template::class);
    }


    public function serverPackage()
    {
        return $this->belongsTo(ServerPackage::class);
    }
}