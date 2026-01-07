<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'sub_category_id',
        'price',
        'discount_price',
        'tax_percentage',
        'stock',
        'lens_width',
        'bridge_width',
        'temple_length',
        'frame_width',
        'face_width_recommended',
        'frame_shape',
        'material',
        'front_color',
        'lens_color',
        'size',
        'is_featured',
        'status',
        'brand_id', // Added brand_id
        'description',
        'primary_image',
        'length',
        'width',
        'height',
        'weight',
        'unit',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'tax_percentage' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')
                    ->withPivot('value')
                    ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
