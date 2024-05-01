<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {

        User::truncate();

        $basePath = base_path();
        $users_path = $basePath . '/data/users.json';

        $data = file_get_contents($users_path);
        $users = json_decode($data);

        foreach ($users as $user) {
            
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt($user->password),
            ]);

        }
    }
}