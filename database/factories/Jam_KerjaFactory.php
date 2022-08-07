<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jam_Kerja>
 */
class Jam_KerjaFactory extends Factory
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
            'jam_mulai'=> "08:00:00",
            'jam_selesai'=>"16:00:00",
            'tanggal_dibuat'=> now()
        ];
    }
}
