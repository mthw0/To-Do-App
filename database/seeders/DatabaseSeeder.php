<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
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
            'name' => 'Janko Hraško',
            'email' => 'user1@todo.com',
            'password' => Hash::make("user1")
        ]);
        User::factory()->create([
            'name' => 'Jožko Mrkvička',
            'email' => 'user2@todo.com',
            'password' => Hash::make("user2")
        ]);
        User::factory()->create([
            'name' => 'Eva Múdra',
            'email' => 'user3@todo.com',
            'password' => Hash::make("user3")
        ]);
        User::factory()->create([
            'name' => 'Peter Rýchly',
            'email' => 'user4@todo.com',
            'password' => Hash::make("user4")
        ]);


        DB::table('categories')->insert([
            'name' => 'Škola'
        ]);DB::table('categories')->insert([
            'name' => 'Práca'
        ]);DB::table('categories')->insert([
            'name' => 'Zábava'
        ]);

        for ($y = 1; $y <= 4; $y++) {
            for ($x = 1; $x <= rand(10,20); $x++) {
                DB::table('todos')->insert([
                    'name' => 'Uloha ' . $x,
                    'description' => 'Toto je popis ulohy c.' . $x. '. Bla Bla toto je text, toto je test, toto je text.',
                    'owner' => $y,
                    'done' => false,
                    'category'=>rand(1,3)
                ]);

            }
        }

    }
}
