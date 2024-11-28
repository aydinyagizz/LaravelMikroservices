<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DB::connection('old_mysql')->table('users')->get();

        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'password' => $user->password,
                'is_admin' => $user->is_admin,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
        }
    }
}
