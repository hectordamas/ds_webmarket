<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modles\Tenant\{OrderProduct};

class OrderProductOption extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class);
    }
}
