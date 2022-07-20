<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'User1',
            'email' => 'user1@todo.com',
            'password' => Hash::make("user1")
        ]);
        User::factory()->create([
            'name' => 'User2',
            'email' => 'user2@todo.com',
            'password' => Hash::make("user2")
        ]);
        User::factory()->create([
            'name' => 'User3',
            'email' => 'user3@todo.com',
            'password' => Hash::make("user3")
        ]);
        User::factory()->create([
            'name' => 'User4',
            'email' => 'user4@todo.com',
            'password' => Hash::make("user4")
        ]);


        for ($y = 0; $y < 4; $y++) {
            for ($x = 1; $x < 10; $x++) {
                DB::table('todos')->insert([
                    'name' => 'Uloha ' . $x,
                    'description' => 'Toto je popis ulohy c.' . $x,
                    'owner' => $y,
                    'done' => false
                ]);

            }
        }
    }
}
