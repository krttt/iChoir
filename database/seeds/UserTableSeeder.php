<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create(array('name' => 'Administrator',
                           'email' => 'admin@ichoir.lv', 
                           'password' => bcrypt('secret'),
                           'role' => 4));
        User::create(array('name' => 'Gints Ceplenieks',
                           'email' => 'conductor@gmail.com', 
                           'password' => bcrypt('secret'),
                           'choir_id' => 1,
                           'role' => 3));
        User::create(array('name' => 'Kristīne Voļska',
                           'email' => 'singer@inbox.lv', 
                           'password' => bcrypt('secret'),
                           'choir_id' => 1,
                           'role' => 2));
        User::create(array('name' => 'Vineta Bondarenko',
                           'email' => 'registered@inbox.lv', 
                           'password' => bcrypt('secret'),
                           'choir_id' => 0,
                           'role' => 1));
    }
}
