<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Truncate Products Tables
        Schema::disableForeignKeyConstraints();
        ProductImage::truncate();
        ProductVariant::truncate();
        Product::truncate();
        DB::table('product_attributes')->truncate();
        
        // Truncate Orders & Order Items if you want fresh start, 
        // but user only asked to "add some order", maybe keep existing? 
        // "add some order in order list" implies adding to existing or fresh. 
        // Given "delete all products", likely wants clean slate for products. 
        // Since orders depend on products usually... but here orders might be linked to deleted products?
        // Let's assume we can keep orders independent or just clear them too since products are gone.
        // For consistency, let's clear orders too so we don't have orders pointing to null products (though schema says set null).
        // BUT, user technically didn't ask to delete orders.
        // I will just ADD orders.
        Schema::enableForeignKeyConstraints();

        $faker = \Faker\Factory::create();

        // 2. Create Users
        // We ensure we have at least some users
        $users = User::factory(10)->create([
            'status' => 'active',
            'phone' => $faker->phoneNumber,
            'total_orders' => rand(0, 5),
            'total_spend' => rand(0, 1000)
        ]);

        // 3. Create Orders & Addresses for new users
        foreach ($users as $user) {
            // Create Address
            DB::table('user_addresses')->insert([
                'user_id' => $user->id,
                'type' => 'billing',
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'state' => $faker->stateAbbr,
                'zip' => $faker->postcode,
                'country' => 'USA',
                'is_default' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create 1-3 Orders
            $numOrders = rand(1, 3);
            for ($i = 0; $i < $numOrders; $i++) {
                $status = $faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']);
                $total = $faker->randomFloat(2, 50, 500);
                
                DB::table('orders')->insert([
                    'user_id' => $user->id,
                    'order_number' => 'ORD-' . strtoupper(uniqid()),
                    'status' => $status,
                    'payment_status' => $status === 'delivered' ? 'paid' : ($status === 'cancelled' ? 'failed' : 'pending'),
                    'payment_method' => 'credit_card',
                    'total' => $total,
                    'tax' => $total * 0.1,
                    'shipping_cost' => 15.00,
                    'discount' => 0,
                    'shipping_address' => json_encode([
                        'name' => $user->name,
                        'address' => $faker->streetAddress,
                        'city' => $faker->city,
                        'zip' => $faker->postcode
                    ]),
                    'billing_address' => json_encode([ // minimal
                        'name' => $user->name,
                        'zip' => $faker->postcode
                    ]),
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
