<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=>'akmal',
                'email'=>'akmal@gmail.com',
                'phone_number'=>'089688880608',
                'username'=>'089688880608',
                'role'=>'admin',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=>'akmal',
                'email'=>'akmal@gmail.com',
                'phone_number'=>'089656560608',
                'username'=>'089656560608',
                'role'=>'user',
                'password'=>bcrypt('123456')
            ],
        ];
        foreach ($userData as $key=>$val) {
            User::create($val);

        }
    }
}
