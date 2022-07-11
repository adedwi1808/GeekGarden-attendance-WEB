<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mading>
 */
class MadingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'judul'=>$this->faker->sentence(mt_rand(1,4)),
            'informasi'=>$this->faker->paragraph(mt_rand(1,3)),
            'foto'=>'',
        ];
    }
}
