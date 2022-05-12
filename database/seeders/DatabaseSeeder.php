<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Playlists;
use App\Models\Songs;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // User::factory(5) -> create();
        // Songs::create([
        //     'name' => 'Love Maybe - Secret Number',
        //     'path' => 'Love Maybe - Secret Number'
        // ]);
        // Songs::create([
        //     'name' => 'Love Dive - IVE',
        //     'path' => 'Love Dive - IVE'
        // ]);
        // Songs::create([
        //     'name' => 'O.O - NMIXX',
        //     'path' => 'O.O - NMIXX'
        // ]);


        Playlists::create([
            "name" => 'Yakh'
        ]);
        Playlists::create([
            "name" => 'Lagu'
        ]);
        
        //  post::factory(20) -> create();
     
        
        User::create([
            'name' => "Darrell Hammam",
            'username'=>'darrellhl082',
            'email' => "darrellhl082@gmail.com",
            'password' =>bcrypt("21032005")
        ]);
    }
}
