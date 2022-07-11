<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */



    public function definition()
    {
        $jenis_kelamin=array("Laki-laki", "Perempuan");
        return [
            'nama' => $this->faker->name(),
            'jenis_kelamin'=>$jenis_kelamin[mt_rand(0,1)],
            'email' => $this->faker->unique()->safeEmail(),
            'jabatan'=>$this->faker->sentence(mt_rand(1,2)),
            'nomor_hp'=>$this->faker->unique()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2', // password
        ];
    }
}
