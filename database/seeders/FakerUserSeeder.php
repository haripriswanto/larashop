<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use Illuminate\Support\Facades\DB;

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

        for ($i = 0; $i < 30; $i++) {
            $data[$i] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'username' => $faker->userName,
                'roles' => json_encode(["ADMIN"]),
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'avatar' => "avatars/default.png",
                // 'avatar' => $faker->image('avatars/', $width = 640, $height = 480),

                'status' => 'ACTIVE',
            ];
        }
        DB::table('users')->insert($data);
    }
}
