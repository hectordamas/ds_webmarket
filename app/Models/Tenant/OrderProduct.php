<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant\{OrderProductOption, Product};

class OrderProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function options()
    {
        return $this->hasMany(OrderProductOption::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
