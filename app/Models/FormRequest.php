<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'negocio',
        'whatsapp',
        'actividad',
        'instagram',
        'autorizo',
    ];
}
