<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Strage;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        if(!Strage::exists('public/images')){
            Strage::makeDirectory('public/images');
        }
        
        return [
            'name' => $this->faker->images(storage_path('app/Public/images'),
            640, 480, null, false)
        ];
    }
}
