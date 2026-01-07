<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'lens_type_id',
        'lens_coating_id',
        'attributes',
    ];

    protected $casts = [
        'attributes' => 'array',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function lensType()
    {
        return $this->belongsTo(LensType::class);
    }

    public function lensCoating()
    {
        return $this->belongsTo(LensCoating::class);
    }
}
