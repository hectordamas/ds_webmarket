<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant\{OrderProduct, Payment, Customer};

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($order) {
            // Generar número único: YYYYMMDD + ID
            $order->numero_orden = 'ORD' . now()->format('Ymd') . $order->id;
            $order->save();
        });
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
