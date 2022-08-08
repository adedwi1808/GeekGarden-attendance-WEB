<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Admin;
use App\Models\Jam_Kerja;
use App\Models\Mading;
use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Pegawai::create([
            "nama" => "Ade Dwi Prayitno",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "42342342",
            "jabatan" => "Mobile Engineer",
            "email" => "adedwip1808@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Sephia Dwinadella",
            "jenis_kelamin" => "Perempuan",
            "nomor_hp" => "0823132343432323221",
            "jabatan" => "HRD",
            "email" => "sephia@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Admin::create([
            "nama"=>"Ade",
            "email"=>"ade@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Admin::create([
            "nama"=>"Adeeee",
            "email"=>"adedp.gaming@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Admin::create([
            "nama"=>"Sephia",
            "email"=>"sephia@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::factory(10)->create();
        Mading::factory(5)->create();
        Jam_Kerja::factory(1)->create();

        Absensi::factory(12)->create();

    }
}
