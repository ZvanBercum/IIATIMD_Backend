<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // medicijn seed 1
         DB::table('users')->insert([
            'firstname' => 'Henk',
            'lastname' => 'Peters',
            'email' => 'henkpeters@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
