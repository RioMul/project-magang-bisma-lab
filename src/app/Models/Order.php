<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'order_number',
        'user_id',
        'template_id',
        'package_id',
        'customer_name',
        'customer_email',
        'customer_whatsapp',
        'domain_name',
        'total_amount',
        'payment_method',
        'status',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi lama untuk kompatibilitas dengan pesanan lama.
     * Pesanan baru sebaiknya membaca template dari orderItems.
     */
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * Relasi lama untuk kompatibilitas dengan pesanan lama.
     * Pesanan baru sebaiknya membaca paket dari orderItems.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Alias untuk kode yang membutuhkan nama relasi jamak.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * Relasi lama dipertahankan selama fitur lama masih menggunakannya.
     */
    public function website()
    {
        return $this->hasOne(UserWebsite::class);
    }
}