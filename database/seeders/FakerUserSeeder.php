<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use Illuminate\Support\Facades\DB;
use Database\Seeders\str;

class FakerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');


        for ($i = 1; $i <= 50; $i++) {

            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'username' => $faker->userName,
                'roles' => json_encode('ADMIN'),
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'avatar' => $faker->image,
                'active' => 'ACTIVE',
            ]);
        }
    }
}
