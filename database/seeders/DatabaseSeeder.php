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
            "nomor_hp" => "08225521234501",
            "jabatan" => "Mobile Engineer",
            "email" => "adedwip1808@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Sephia Dwinadella",
            "jenis_kelamin" => "Perempuan",
            "nomor_hp" => "08225521234502",
            "jabatan" => "HRD",
            "email" => "sephia@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Aulya Yasifa Narwienda",
            "jenis_kelamin" => "Perempuan",
            "nomor_hp" => "08225521234503",
            "jabatan" => "Asisten Project Manager",
            "email" => "aulya@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Achmad Fawait",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234504",
            "jabatan" => "Backend Developer",
            "email" => "fawait@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Ahmad Fahrezy",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234505",
            "jabatan" => "Backend Developer",
            "email" => "fahrezy@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Bagus Megantoro",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234506",
            "jabatan" => "Backend Developer",
            "email" => "bagus@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Adi Kannatasik",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234507",
            "jabatan" => "DevOps",
            "email" => "adi@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Viqri Riatra",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234508",
            "jabatan" => "Digital Marketing",
            "email" => "viqri@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Fatimah Barir Azyarah",
            "jenis_kelamin" => "Perempuan",
            "nomor_hp" => "08225521234509",
            "jabatan" => "Finance",
            "email" => "fatimah.br@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Muhamad Lutfi Hakim",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234510",
            "jabatan" => "Frontend Developer",
            "email" => "lutfi.hkm@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Muhammad Dzaki",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234511",
            "jabatan" => "Frontend Developer",
            "email" => "mhmmd.dzaki@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Ryan Mustofa",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234512",
            "jabatan" => "Frontend Developer",
            "email" => "ryan@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Wahyu Hadianto",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234513",
            "jabatan" => "Frontend Developer",
            "email" => "wahyu@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Ahmad Raihan Akhdani",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234514",
            "jabatan" => "Frontend Developer",
            "email" => "raihan@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Anggitya Nur Rahmadhani",
            "jenis_kelamin" => "Perempuan",
            "nomor_hp" => "08225521234515",
            "jabatan" => "HRD",
            "email" => "anggitya@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Norma Indah Pratiwi",
            "jenis_kelamin" => "Perempuan",
            "nomor_hp" => "08225521234516",
            "jabatan" => "HRD Staff",
            "email" => "norma.indh@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Deni Hendri Kurniawan",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234517",
            "jabatan" => "Legal Officer",
            "email" => "deni.hendri@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Arief Rachman",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234518",
            "jabatan" => "International Marcom",
            "email" => "arief.rhmn@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Achmad Yukrisna",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234519",
            "jabatan" => "Mobile Developer",
            "email" => "achmad.ykrsn@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Muhammad Rizky",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234520",
            "jabatan" => "Mobile Developer",
            "email" => "mhmd.rzky@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Mahendra Prabowo",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234521",
            "jabatan" => "Quality Control Software",
            "email" => "mhmd.prabowo@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Prastowo Ardi Widigdo",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234522",
            "jabatan" => "Quality Control Software",
            "email" => "prastowo.ardi@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Fuad",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234523",
            "jabatan" => "Regional Marketing Communication",
            "email" => "fuad123@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Yasri Singgih Riyanta",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234524",
            "jabatan" => "Regional Marketing Communication",
            "email" => "yasri@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Stevanus Fajar Pradika",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234525",
            "jabatan" => "Social Media Specialist",
            "email" => "stevanus@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Noviani Widyalisti",
            "jenis_kelamin" => "Perempuan",
            "nomor_hp" => "08225521234526",
            "jabatan" => "Talent Acquisition",
            "email" => "noviani@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Dhimas Insan Saputra",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234527",
            "jabatan" => "Technical Manager",
            "email" => "dhimas@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Muh Rizky Kurniawan A",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234528",
            "jabatan" => "UI/UX",
            "email" => "rizky.kurniawan@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Pegawai::create([
            "nama" => "Akhmad Miftah Riyadhi",
            "jenis_kelamin" => "Laki-laki",
            "nomor_hp" => "08225521234529",
            "jabatan" => "Website",
            "email" => "miftah@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        //ADMIN
        Admin::create([
            "nama"=>"Ade Dwi Prayitno",
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

        Admin::create([
            "nama" => "Anggitya Nur Rahmadhani",
            "email"=>"anggitya@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Admin::create([
            "nama" => "Norma Indah Pratiwi",
            "email"=>"norma.indah@gmail.com",
            "password" => '$2y$10$iUu6128DzUs7Kt/l.Eer9ebo4UopLfm2pxfp3tz.5YBmU05vmnuQ2'
        ]);

        Mading::create([
            'id_admin'=>1,
            'judul'=>"Perayaan 17 Agustus 2022",
            'informasi'=>"Dirgahayu negeriku yang ke-76, semoga semakin maju dan lekas pulih dari pandemi!",
            'foto'=>'1056113_750x500-40-ucapan-hari-kemerdekaan-ri-17-agustus-penuh-semangat-200813i-rev2.jpeg',
        ]);

        Mading::create([
            'id_admin'=>4,
            'judul'=>"Perayaan 17 Agustus 2022",
            'informasi'=>"Dirgahayu negeriku yang ke-76, semoga semakin maju dan lekas pulih dari pandemi!",
            'foto'=>'1056113_750x500-40-ucapan-hari-kemerdekaan-ri-17-agustus-penuh-semangat-200813i-rev2.jpeg',
        ]);


        Jam_Kerja::factory(1)->create();

        Absensi::factory(29)->create();

    }
}
