<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'phone' => '0977989826',
                'address' => 'Phnom Penh',
                'user_type' => 'admin',
            ],
            [
                'name' => 'Ly',
                'email' => 'ly@gmail.com',
                'password' => bcrypt('123456'),
                'phone' => '010202622',
                'address' => 'Phnom Penh',
                'user_type' => 'normal',
            ],
           
        ];
  
        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
