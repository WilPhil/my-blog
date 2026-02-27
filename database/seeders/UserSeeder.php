<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->create([
            'name' => 'Wilsent Philip',
            'username' => 'wilsentphilip',
            'email' => 'wphilip465@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::factory(4)->create();
    }
}
