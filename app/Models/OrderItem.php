<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'price',
        'tax_amount',
        'tax_rate',
        'lens_type_id',
        'lens_coating_id',
        'prescription_data',
        'prescription_file',
        'prescription_doctor',
        'prescription_date',
        'prescription_time',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'prescription_data' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
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
