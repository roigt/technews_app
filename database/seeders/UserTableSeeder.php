<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user= User::create([
            'name' => 'adm',
            'email' => 'adm@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $role = Role::where('name', 'admin')->first();
        $user->roles()->attach($role->id);
    }
}
