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
             'name' => 'Test User',
             'email' => 'admin@todo.com',
             'password'=> Hash::make("heslo123")
         ]);

        $data = [
            [
                'name'=>'Uloha 1',
                'description'=>'Toto je popis ulohy c.1'
            ],
            [
                'name'=>'Uloha 2',
                'description'=>'Toto je popis ulohy c.2'
            ],
            [
                'name'=>'Uloha 3',
                'description'=>'Toto je popis ulohy c.3'
            ],
            [
                'name'=>'Uloha 4',
                'description'=>'Toto je popis ulohy c.4'
            ],
            [
                'name'=>'Uloha 5',
                'description'=>'Toto je popis ulohy c.5'
            ],
            [
                'name'=>'Uloha 6',
                'description'=>'Toto je popis ulohy c.6'
            ]
        ];

         DB::table('todos')->insert($data);


    }
}
