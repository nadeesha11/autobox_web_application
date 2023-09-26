<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class create_superAdmin_for_testing extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'temp_username',
            'email' => 'jayathilaka221b@gmail.com',
            'password' => Hash::make('temp_Password'),

        ]);
    }
}
