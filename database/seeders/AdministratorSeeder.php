<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Facade\hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator@larashop.com";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("larashop");
        $administrator->avatar = "avatars/default.png";
        $administrator->address = "Cibinong, Bogor.";

        $administrator->save();

        $this->command->info("User Admin berhasil diinsert");
    }
}
