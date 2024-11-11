<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::insert([
            [
                "name" => "admin",
            ],
            [
                "name" => "moderator",
            ],
            [
                "name" => "client",
            ],
        ]);

        $user = User::create([
            'name'=> '7amza',
            'email'=> 'hamza.mondour12@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $roleAdmin = Role::where('name','admin')->first();
        $user->roles()->attach($roleAdmin);
    }
}
