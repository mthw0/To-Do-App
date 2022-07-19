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

        $data = [
            [
                'name' => 'Uloha 1',
                'description' => 'Toto je popis ulohy c.1',
                'owner' => 1,
                'done' => true
            ],
            [
                'name' => 'Uloha 2',
                'description' => 'Toto je popis ulohy c.2',
                'owner' => 1,
                'done' => true
            ],
            [
                'name' => 'Uloha 3',
                'description' => 'Toto je popis ulohy c.3',
                'owner' => 1,
                'done' => false
            ],
            [
                'name' => 'Uloha 4',
                'description' => 'Toto je popis ulohy c.4',
                'owner' => 1,
                'done' => false
            ],
            [
                'name' => 'Uloha 5',
                'description' => 'Toto je popis ulohy c.5',
                'owner' => 1,
                'done' => false
            ],
            [
                'name' => 'Uloha 6',
                'description' => 'Toto je popis ulohy c.6',
                'owner' => 1,
                'done' => false
            ],
            [
                'name' => 'Uloha 2',
                'description' => 'Toto je popis ulohy c.2',
                'owner' => 2,
                'done' => true
            ],
            [
                'name' => 'Uloha 3',
                'description' => 'Toto je popis ulohy c.3',
                'owner' => 2,
                'done' => false
            ],
            [
                'name' => 'Uloha 4',
                'description' => 'Toto je popis ulohy c.4',
                'owner' => 2,
                'done' => false
            ],
            [
                'name' => 'Uloha 5',
                'description' => 'Toto je popis ulohy c.5',
                'owner' => 2,
                'done' => true
            ],
            [
                'name' => 'Uloha 6',
                'description' => 'Toto je popis ulohy c.6',
                'owner' => 2,
                'done' => false
            ],
            [
                'name' => 'Uloha 2',
                'description' => 'Toto je popis ulohy c.2',
                'owner' => 3,
                'done' => false
            ],
            [
                'name' => 'Uloha 3',
                'description' => 'Toto je popis ulohy c.3',
                'owner' => 3,
                'done' => false
            ],
            [
                'name' => 'Uloha 4',
                'description' => 'Toto je popis ulohy c.4',
                'owner' => 3,
                'done' => true
            ],
            [
                'name' => 'Uloha 5',
                'description' => 'Toto je popis ulohy c.5',
                'owner' => 3,
                'done' => true
            ],
            [
                'name' => 'Uloha 6',
                'description' => 'Toto je popis ulohy c.6',
                'owner' => 3,
                'done' => true
            ]
        ];

        DB::table('todos')->insert($data);


    }
}
