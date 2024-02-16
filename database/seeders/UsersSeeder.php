<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
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
                'email' => 'davtorresga@gmail.com',
                'password' => Hash::make('user1234'),
                'role' => 'admin'
            ]
        ];

        foreach($users as $user){
            $new_user = User::create($user);
            $token = $new_user->createToken('API TOKEN')->plainTextToken;
        }
    }
}
