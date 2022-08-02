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
            'id_admin'=>2,
            'judul'=>$this->faker->sentence(mt_rand(1,4)),
            'informasi'=>$this->faker->paragraph(mt_rand(10,20)),
            'foto'=>'0222638_95f4614ab7fa00067d5cb3b5cc2747bd.jpeg',
        ];
    }
}
