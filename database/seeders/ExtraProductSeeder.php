<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class ExtraProductSeeder extends Seeder
{
    public function run()
    {
        $category = Category::firstOrCreate(
            ['name' => 'Eyeglasses', 'slug' => 'eyeglasses']
        );

        $products = [
            [
                'name' => 'Oliver Peoples Gregory Peck',
                'price' => 350.00,
                'optical' => [
                    'lens_width' => 47, 'bridge_width' => 23, 'temple_length' => 150,
                    'frame_shape' => 'Round', 'material' => 'Acetate'
                ],
                'variants' => [
                    ['name' => 'Color: Cocobolo', 'price' => 350.00, 'stock' => 12],
                    ['name' => 'Color: Matte Black', 'price' => 350.00, 'stock' => 8],
                ]
            ],
            [
                'name' => 'Tom Ford FT5178',
                'price' => 410.00,
                'optical' => [
                    'lens_width' => 50, 'bridge_width' => 21, 'temple_length' => 145,
                    'frame_shape' => 'Square', 'material' => 'Acetate'
                ],
                'variants' => [
                    ['name' => 'Color: Dark Havana', 'price' => 410.00, 'stock' => 15],
                    ['name' => 'Color: Shiny Black', 'price' => 410.00, 'stock' => 20],
                ]
            ],
            [
                'name' => 'Ray-Ban Clubmaster Optics',
                'price' => 180.00,
                'optical' => [
                    'lens_width' => 49, 'bridge_width' => 21, 'temple_length' => 140,
                    'frame_shape' => 'Browline', 'material' => 'Metal/Acetate'
                ],
                'variants' => [
                    ['name' => 'Color: Mock Tortoise/Gold', 'price' => 180.00, 'stock' => 30],
                    ['name' => 'Color: Black/Silver', 'price' => 180.00, 'stock' => 25],
                ]
            ],
            [
                'name' => 'Persol PO3007V',
                'price' => 310.00,
                'optical' => [
                    'lens_width' => 50, 'bridge_width' => 19, 'temple_length' => 145,
                    'frame_shape' => 'Pilot', 'material' => 'Acetate'
                ],
                'variants' => [
                    ['name' => 'Color: Havana', 'price' => 310.00, 'stock' => 10],
                ]
            ],
            [
                'name' => 'Gucci GG0026O',
                'price' => 295.00,
                'optical' => [
                    'lens_width' => 55, 'bridge_width' => 17, 'temple_length' => 140,
                    'frame_shape' => 'Rectangular', 'material' => 'Optyl'
                ],
                'variants' => [
                    ['name' => 'Color: Black', 'price' => 295.00, 'stock' => 18],
                    ['name' => 'Color: Avana', 'price' => 295.00, 'stock' => 14],
                ]
            ],
        ];

        foreach ($products as $pData) {
            $product = Product::create([
                'name' => $pData['name'],
                'slug' => Str::slug($pData['name']),
                'category_id' => $category->id,
                'price' => $pData['price'],
                'stock' => array_sum(array_column($pData['variants'], 'stock')),
                'tax_percentage' => 8.25,
                'status' => true,
                'description' => 'Premium eyewear crafted for style and comfort.',
                
                // Optical Specs
                'lens_width' => $pData['optical']['lens_width'],
                'bridge_width' => $pData['optical']['bridge_width'],
                'temple_length' => $pData['optical']['temple_length'],
                'frame_shape' => $pData['optical']['frame_shape'],
                'material' => $pData['optical']['material'],
            ]);

            // Create Variants
            foreach ($pData['variants'] as $vData) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'variant_name' => $vData['name'],
                    'price' => $vData['price'],
                    'stock' => $vData['stock'],
                    'attribute_values' => [] // Simplified for seeder
                ]);
            }
            
            $this->command->info("Created product: " . $product->name);
        }
    }
}
