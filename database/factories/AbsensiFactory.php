<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absensi>
 */
class AbsensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private static $id_pegawai = 1;
    private static $pulang = false;

    public function definition()
    {
        return [
            'id_pegawai' => self::$id_pegawai,
            'tempat' => 'Dikantor',
            'status' => function () {
                if (self::$pulang) {
                    self::$id_pegawai +=1;
                    return 'Pulang';
                }
                return 'Hadir';
            },
            'longitude' => 0,
            'latitude' => 0,
            'foto' => null,
            'tanggal' => function () {
                if (self::$pulang) {
                    self::$pulang = false;
                    return Carbon::now()->addDay(3)->setTime(15,59);
                }
                self::$pulang = true;
                return Carbon::now()->addDay(3)->setTime(8,1);
            }
        ];
    }
}
