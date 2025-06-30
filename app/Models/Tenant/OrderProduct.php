<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modles\Tenant\{OrderProductOption};

class OrderProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function options()
    {
        return $this->hasMany(OrderProductOption::class);
    }
}
