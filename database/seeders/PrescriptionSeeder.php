<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prescription;
use App\Models\User;
use Faker\Factory as Faker;

class PrescriptionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();

        if ($users->count() == 0) {
            $this->command->info('No users found to seed prescriptions for.');
            return;
        }

        foreach ($users as $user) {
            // Create 1-3 prescriptions for each user
            $count = rand(1, 3);
            for ($i = 0; $i < $count; $i++) {
                Prescription::create([
                    'user_id' => $user->id,
                    'title' => $faker->randomElement(['Daily Wear', 'Reading', 'Driving', 'Computer', 'Backup Specs']),
                    'od_sph' => $faker->randomFloat(2, -5, 5),
                    'od_cyl' => $faker->randomFloat(2, -2, 0),
                    'od_axis' => $faker->numberBetween(0, 180),
                    'os_sph' => $faker->randomFloat(2, -5, 5),
                    'os_cyl' => $faker->randomFloat(2, -2, 0),
                    'os_axis' => $faker->numberBetween(0, 180),
                    'add' => $faker->optional(0.3)->randomFloat(2, 1, 3), // 30% chance of ADD value
                    'pd' => $faker->numberBetween(58, 70),
                    'image_path' => null, // Optional
                ]);
            }
        }
        
        $this->command->info('Prescriptions seeded successfully!');
    }
}
