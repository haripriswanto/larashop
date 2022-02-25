<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('AdministratorSeeder');
        // $this->call('FakerUserSeeder');
        // \App\Models\User::factory(10)->create();
    }
}
