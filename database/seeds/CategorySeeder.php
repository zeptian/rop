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
        DB::insert("INSERT INTO `categories` (`id`, `category`, `parent_id`,`created_at`,`updated_at`) VALUES
        ('1',	'Perencanaan dan Penganggaran penanganan COVID-19',	null, now(), now() ),
        ('2',	'Surveilens dan upaya penemuan kasus secara aktif',	null, now(), now() ),
        ('3',	'Pemeriksaan laboratorium',	null, now(), now() ),
        ('4',	'Management KLinis',	null, now(), now() ),
        ('5',	'Pencegahan dan Pengendalian Infeksi',	null, now(), now() ),
        ('6',	'Pencegahan dan Penularan di Masyarakat',	null, now(), now() ),
        ('7',	'Komunikasi resiko dan pemberdayaan Masyarakat',	null, now(), now() ),
        ('8',	'Refocussing anggaran penanganan COVID-19',	1, now(), now() ),
        ('9',	'Penyiapan regulasi penangananan covid-19',	1, now(), now() ),
        ('10',	'Penyelidikan Surveilens Epidemiologi',	2, now(), now() ),
        ('11',	'Screning kegiatan COVID-19',	2, now(), now() ),
        ('12',	'Pembuatan Laboratorium dan perlengkapannya',	3, now(), now() ),
        ('13',	'Pengelolaan sampel COVID-19',	3, now(), now() ),
        ('14',	'Penyelenggaraan Rumah Isolasi dan tenda karantina',	4, now(), now() ),
        ('15',	'Peran Ambulan Hebat sebagai sarana percepatan Rujukan',	4, now(), now() ),
        ('16',	'Koordinasi dengan FKTP dan FKTRL',	4, now(), now() ),
        ('17',	'Pengelolaan Limbah Medis',	5, now(), now() ),
        ('18',	'Pengadaan dan Pengelolaan Obat, APD , dan BMHP',	5, now(), now() ),
        ('19',	'Pengelolaan Sanitasi',	5, now(), now() ),
        ('20',	'Sosialisasi dan edukasi protokol kesehatan',	6, now(), now() ),
        ('21',	'Pengadaan APD untuk masyarakat',	6, now(), now() ),
        ('22',	'Desinfektan tempat umum dan lokasi kasus',	7, now(), now() ),
        ('23',	'Kemitraan dengan Institusi Pendidikan dan Organisasi Profesi  dalam pendampingan penanganan COVID-19',	7, now(), now() ),
        ('24',	'Penguatan manajemen dan sarana ruang kendali COVID-19', 7, now(), now() ); ");
    }
}