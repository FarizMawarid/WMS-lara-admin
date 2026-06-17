<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Emergency Super Admin Account
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['nik' => '9999999999'],
            [
                'factory'   => 'ESGI Klego',
                'role'      => 'Admin',
                'nik'       => '142600600',
                'department'=> 'Finish Goods 1',
                'name'      => 'Super Administrator',
                'email'     => 'arum600@gmail.com',
                'password'  => Hash::make('Arumie601')
            ]
        );
    }
}