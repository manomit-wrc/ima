<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = new \App\User();
        $users->name = "Manomit Mitra";
        $users->email = "admin@wrctechnologies.com";
        $users->password = bcrypt("123456");
        $users->address = "J-1/12 Block EP-GP, 2nd Floor, Saltlake, Kolkata, West Bengal 700091";
        $users->mobile = "9007341342";
        $users->avators = "";
        $users->save();
    }
}
