<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LensCoating extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'tax_percentage',
        'description',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'tax_percentage' => 'decimal:2',
        'status' => 'boolean',
    ];
}
