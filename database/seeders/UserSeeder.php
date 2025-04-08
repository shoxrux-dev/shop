<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
           'name' => 'admin',
           'email' => 'admin@gmail.com',
           'password' => Hash::make('admin')
        ]);
        $user->assignRole(Role::where('name', 'admin')->first());
    }
}
