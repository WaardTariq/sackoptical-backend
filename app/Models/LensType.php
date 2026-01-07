<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LensType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'price_modifier',
        'tax_percentage',
        'description',
        'status',
    ];

    protected $casts = [
        'price_modifier' => 'decimal:2',
        'tax_percentage' => 'decimal:2',
        'status' => 'boolean',
    ];
}
