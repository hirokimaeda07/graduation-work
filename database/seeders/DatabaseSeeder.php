<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //laravel-adminのseeder
        //$this->call([AdminTablesSeeder::class,]);
        
        // 🔽 この行のコメントから外す
        \App\Models\User::factory(10)->create();
        
         $this->call('ProjectsTableSeeder::class');
        //\App\Models\Project::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
