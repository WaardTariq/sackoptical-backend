<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'values',
        'status',
    ];

    protected $casts = [
        'values' => 'array',
        'status' => 'boolean',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes')
                    ->withPivot('value')
                    ->withTimestamps();
    }
}
