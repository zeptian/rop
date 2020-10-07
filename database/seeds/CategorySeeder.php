<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::insert("INSERT INTO `categories` (`id`, `category`, `parent_id`) VALUES
        ('1',	'Perencanaan dan Penganggaran penanganan COVID-19',	null),
        ('2',	'Surveilens dan upaya penemuan kasus secara aktif',	null),
        ('3',	'Pemeriksaan laboratorium',	null),
        ('4',	'Management KLinis',	null),
        ('5',	'Pencegahan dan Pengendalian Infeksi',	null),
        ('6',	'Pencegahan dan Penularan di Masyarakat',	null),
        ('7',	'Komunikasi resiko dan pemberdayaan Masyarakat',	null),
        ('8',	'Refocussing anggaran penanganan COVID-19',	1),
        ('9',	'Penyiapan regulasi penangananan covid-19',	1),
        ('10',	'Penyelidikan Surveilens Epidemiologi',	2),
        ('11',	'Screning kegiatan COVID-19',	2),
        ('12',	'Pembuatan Laboratorium dan perlengkapannya',	3),
        ('13',	'Pengelolaan sampel COVID-19',	3),
        ('14',	'Penyelenggaraan Rumah Isolasi dan tenda karantina',	4),
        ('15',	'Peran Ambulan Hebat sebagai sarana percepatan Rujukan',	4),
        ('16',	'Koordinasi dengan FKTP dan FKTRL',	4),
        ('17',	'Pengelolaan Limbah Medis',	5),
        ('18',	'Pengadaan dan Pengelolaan Obat, APD , dan BMHP',	5),
        ('19',	'Pengelolaan Sanitasi',	5),
        ('20',	'Sosialisasi dan edukasi protokol kesehatan',	6),
        ('21',	'Pengadaan APD untuk masyarakat',	6),
        ('22',	'Desinfektan tempat umum dan lokasi kasus',	7),
        ('23',	'Kemitraan dengan Institusi Pendidikan dan Organisasi Profesi  dalam pendampingan penanganan COVID-19',	7),
        ('24',	'Penguatan manajemen dan sarana ruang kendali COVID-19', 7); ");
    }
}