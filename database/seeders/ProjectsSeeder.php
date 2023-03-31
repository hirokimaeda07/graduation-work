<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Image;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /** DB::table('projects')->insert([
            'plan_title' => Str::random(5),
            'created_at' => now(),
            'updated_at' => now(),
            ]); */
        
        DB::table('images')->insert([
            'name' => Str::random(5),
            'created_at' => now(),
            'updated_at' => now(),
            ]);

        DB::table('images')->insert([
            'name' => Str::random(5),
            'created_at' => now(),
            'updated_at' => now(),
            ]);
            
        DB::table('images')->insert([
            'name' => Str::random(5),
            'created_at' => now(),
            'updated_at' => now(),
            ]);
        DB::table('images')->insert([
            'name' => Str::random(5),
            'created_at' => now(),
            'updated_at' => now(),
            ]);
            



        
            /**Image::factory()->count(4)->create()->each(fn($image) =>
                $project->images()->attach($image->id)
                

        );*/
    }
}
