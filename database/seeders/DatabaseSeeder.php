<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\LensType;
use App\Models\LensCoating;
use App\Models\Coupon;
use App\Models\BusinessSetting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@sacks.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'status' => true,
        ]);

        // 2. User
        User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'status' => true,
        ]);

        // 3. Business Settings
        BusinessSetting::create([
            'company_name' => 'Sacks Optical',
            'company_email' => 'contact@sacksoptical.com',
            'company_phone' => '+1 555 123 4567',
            'currency' => 'USD',
            'currency_symbol' => '$',
        ]);

        // 4. Lens Types
        $singleVision = LensType::create([
            'name' => 'Single Vision',
            'slug' => 'single-vision',
            'price_modifier' => 0.00,
            'description' => 'Standard lenses for distance or reading.',
            'status' => true
        ]);
        LensType::create([
            'name' => 'Progressive',
            'slug' => 'progressive',
            'price_modifier' => 100.00,
            'description' => 'Multifocal lenses for all distances.',
            'status' => true
        ]);
        LensType::create([
            'name' => 'Bifocal',
            'slug' => 'bifocal',
            'price_modifier' => 50.00,
            'description' => 'Two distinct optical powers.',
            'status' => true
        ]);

        // 5. Lens Coatings
        LensCoating::create([
            'name' => 'Anti-Reflective',
            'slug' => 'anti-reflective',
            'price' => 30.00,
            'description' => 'Reduces glare and eye strain.',
            'status' => true
        ]);
        LensCoating::create([
            'name' => 'Blue Light Block',
            'slug' => 'blue-light-block',
            'price' => 50.00,
            'description' => 'Protects eyes from digital screens.',
            'status' => true
        ]);

        // 6. Brands
        $rayban = Brand::create(['name' => 'Ray-Ban', 'slug' => 'ray-ban', 'status' => true]);
        $oakley = Brand::create(['name' => 'Oakley', 'slug' => 'oakley', 'status' => true]);
        $gucci = Brand::create(['name' => 'Gucci', 'slug' => 'gucci', 'status' => true]);

        // 7. Categories & SubCategories
        $men = Category::create(['name' => 'Men', 'slug' => 'men', 'status' => true]);
        $women = Category::create(['name' => 'Women', 'slug' => 'women', 'status' => true]);
        
        $sunglassesMen = SubCategory::create(['category_id' => $men->id, 'name' => 'Sunglasses', 'slug' => 'men-sunglasses', 'status' => true]);
        $eyeglassesMen = SubCategory::create(['category_id' => $men->id, 'name' => 'Eyeglasses', 'slug' => 'men-eyeglasses', 'status' => true]);
        
        $sunglassesWomen = SubCategory::create(['category_id' => $women->id, 'name' => 'Sunglasses', 'slug' => 'women-sunglasses', 'status' => true]);

        // 8. Attributes
        Attribute::create(['name' => 'Color', 'slug' => 'color', 'values' => ['Black', 'Tortoise', 'Gold', 'Silver'], 'status' => true]);
        Attribute::create(['name' => 'Size', 'slug' => 'size', 'values' => ['Small', 'Medium', 'Large'], 'status' => true]);

        // 9. Products
        $p1 = Product::create([
            'name' => 'Ray-Ban Aviator Classic',
            'slug' => 'ray-ban-aviator-classic',
            'category_id' => $men->id,
            'sub_category_id' => $sunglassesMen->id,
            'brand_id' => $rayban->id,
            'price' => 163.00,
            'stock' => 50,
            'tax_percentage' => 8.25,
            'description' => 'Currently one of the most iconic sunglass models in the world.',
            'frame_shape' => 'Pilot',
            'material' => 'Metal',
            'front_color' => 'Gold',
            'lens_color' => 'Green Classic G-15',
            'lens_width' => '58',
            'bridge_width' => '14',
            'temple_length' => '135',
            'status' => true,
            'is_featured' => true
        ]);
        
        $p2 = Product::create([
            'name' => 'Oakley Holbrook',
            'slug' => 'oakley-holbrook',
            'category_id' => $men->id,
            'sub_category_id' => $sunglassesMen->id,
            'brand_id' => $oakley->id,
            'price' => 142.00,
            'stock' => 30,
            'tax_percentage' => 8.25,
            'description' => 'Timeless, classic design fused with modern Oakley technology.',
            'frame_shape' => 'Square',
            'material' => 'O Matter',
            'front_color' => 'Matte Black',
            'lens_color' => 'Prizm Sapphire',
            'lens_width' => '57',
            'bridge_width' => '18',
            'temple_length' => '137',
            'status' => true,
            'is_featured' => false
        ]);

        $p3 = Product::create([
            'name' => 'Gucci Rectangular Optical',
            'slug' => 'gucci-rectangular',
            'category_id' => $women->id,
            'sub_category_id' => $sunglassesWomen->id,
            'brand_id' => $gucci->id,
            'price' => 350.00,
            'stock' => 15,
            'tax_percentage' => 8.25,
            'description' => 'Elegant rectangular frame.',
            'frame_shape' => 'Rectangle',
            'material' => 'Acetate',
            'front_color' => 'Black',
            'lens_width' => '54',
            'bridge_width' => '16',
            'temple_length' => '140',
            'status' => true,
            'is_featured' => true
        ]);

        // 10. Coupons
        Coupon::create([
            'code' => 'WELCOME10',
            'type' => 'percent',
            'value' => 10,
            'status' => true
        ]);
    }
}
