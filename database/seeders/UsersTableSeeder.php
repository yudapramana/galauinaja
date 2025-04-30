<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orgs = [
            [ #1
                'name' => 'Kantor Kementerian Agama Kabupaten Pesisir Selatan',
                'email' => 'pessel@kemenag.go.id'
            ],
            [ #2
                'name' => 'Sub Bagian Tata Usaha - Kantor Kementerian Agama Kabupaten Pesisir Selatan',
                'email' => 'pessel@kemenag.go.id'
            ],
            [ #3
                'name' => 'Seksi Pendidikan Madrasah - Kantor Kementerian Agama Kabupaten Pesisir Selatan',
                'email' => 'pessel@kemenag.go.id'
            ],
            [ #4
                'name' => 'Seksi Penyelenggaraan Haji dan Umrah - Kantor Kementerian Agama Kabupaten Pesisir Selatan',
                'email' => 'pessel@kemenag.go.id'
            ],
            [ #5
                'name' => 'Seksi Pendidikan Agama Islam	- Kantor Kementerian Agama Kabupaten Pesisir Selatan',
                'email' => 'pessel@kemenag.go.id'
            ],
            [ #6
                'name' => 'Seksi Bimbingan Masyarakat Islam - Kantor Kementerian Agama Kabupaten Pesisir Selatan',
                'email' => 'pessel@kemenag.go.id'
            ],
            [ #7
                'name' => 'Seksi Pendidikan Diniyah dan Pondok Pesantren - Kantor Kementerian Agama Kabupaten Pesisir Selatan',
                'email' => 'pessel@kemenag.go.id'
            ],
            [ #8
                'name' => 'Penyelenggara Zakat dan Wakaf - Kantor Kementerian Agama Kabupaten Pesisir Selatan',
                'email' => 'pessel@kemenag.go.id'
            ],

            // MAN
            [
                'name' => 'MAN 1 Pesisir Selatan',
                'email' => 'man1.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MAN 2 Pesisir Selatan',
                'email' => 'man2.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MAN 3 Pesisir Selatan',
                'email' => 'man3.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MAN 4 Pesisir Selatan',
                'email' => 'man4.pessel@kemenag.go.id'
            ],

            // MTsN
            [
                'name' => 'MTsN 1 Pesisir Selatan',
                'email' => 'mtsn1.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 2 Pesisir Selatan',
                'email' => 'mtsn2.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 3 Pesisir Selatan',
                'email' => 'mtsn3.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 4 Pesisir Selatan',
                'email' => 'mtsn4.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 5 Pesisir Selatan',
                'email' => 'mtsn5.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 6 Pesisir Selatan',
                'email' => 'mtsn6.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 7 Pesisir Selatan',
                'email' => 'mtsn7.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 8 Pesisir Selatan',
                'email' => 'mtsn8.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 9 Pesisir Selatan',
                'email' => 'mtsn9.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 10 Pesisir Selatan',
                'email' => 'mtsn10.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 11 Pesisir Selatan',
                'email' => 'mtsn11.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 12 Pesisir Selatan',
                'email' => 'mtsn12.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MTsN 13 Pesisir Selatan',
                'email' => 'mtsn13.pessel@kemenag.go.id'
            ],


            // MIN
            // MTsN
            [
                'name' => 'MIN 1 Pesisir Selatan',
                'email' => 'min1.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 2 Pesisir Selatan',
                'email' => 'min2.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 3 Pesisir Selatan',
                'email' => 'min3.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 4 Pesisir Selatan',
                'email' => 'min4.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 5 Pesisir Selatan',
                'email' => 'min5.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 6 Pesisir Selatan',
                'email' => 'min6.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 7 Pesisir Selatan',
                'email' => 'min7.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 8 Pesisir Selatan',
                'email' => 'min8.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 9 Pesisir Selatan',
                'email' => 'min9.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 10 Pesisir Selatan',
                'email' => 'min10.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 11 Pesisir Selatan',
                'email' => 'min11.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 12 Pesisir Selatan',
                'email' => 'min12.pessel@kemenag.go.id'
            ],
            [
                'name' => 'MIN 13 Pesisir Selatan',
                'email' => 'min13.pessel@kemenag.go.id'
            ],


            // KUA
            [
                'name' => 'KUA KOTO XI TARUSAN',
                'email' => 'kua.kotoxitarusan@kemenag.go.id'
            ],
            [
                'name' => 'KUA BAYANG',
                'email' => 'kua.bayang@kemenag.go.id'
            ],
            [
                'name' => 'KUA IV NAGARI BAYANG UTARA',
                'email' => 'kua.bayu@kemenag.go.id'
            ],
            [
                'name' => 'KUA IV JURAI',
                'email' => 'kua.ivjurai@kemenag.go.id'
            ],
            [
                'name' => 'KUA BATANG KAPAS',
                'email' => 'kua.batangkapas@kemenag.go.id'
            ],
            [
                'name' => 'KUA SUTERA',
                'email' => 'kua.sutera@kemenag.go.id'
            ],
            [
                'name' => 'KUA LENGAYANG',
                'email' => 'kua.lengayang@kemenag.go.id'
            ],
            [
                'name' => 'KUA RANAH PESISIR',
                'email' => 'kua.ranahpesisir@kemenag.go.id'
            ],
            [
                'name' => 'KUA LINGGO SARI BAGANTI',
                'email' => 'kua.linggo@kemenag.go.id'
            ],
            [
                'name' => 'KUA AIRPURA',
                'email' => 'kua.airpura@kemenag.go.id'
            ],
            [
                'name' => 'KUA PANCUNG SOAL',
                'email' => 'kua.pancungsoal@kemenag.go.id'
            ],
            [
                'name' => 'KUA BASA AMPEK BALAI TAPAN',
                'email' => 'kua.bab@kemenag.go.id'
            ],
            [
                'name' => 'KUA RANAH AMPEK HULU TAPAN',
                'email' => 'kua.rahul@kemenag.go.id'
            ],
            [
                'name' => 'KUA LUNANG',
                'email' => 'kua.lunang@kemenag.go.id'
            ],
            [
                'name' => 'KUA SILAUT',
                'email' => 'kua.silaut@kemenag.go.id'
            ],
        ];
        

        foreach ($orgs as $key => $item) {
            \App\Models\Organization::firstOrCreate(
                ['name' => $item['name']],
                $item
            );
        }

        $data = [
            [
                'name' => 'Pramana Yuda Sayeti, S.Kom',
                'username' => '199407292022031002',
                'jabatan' => 'Ahli Pertama - Pranata Komputer',
                'email' => '199407292022031002@kemenag.go.id',
                'password' => Hash::make('superadmin'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 1,
                'organization_id' => 2
            ],
            [
                'name' => 'H. Abrar Munanda, M.Ag',
                'username' => '197105141995031001',
                'jabatan' => 'Kepala Kantor',
                'email' => '197105141995031001@kemenag.go.id',
                'password' => Hash::make('197105141995031001'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 1
            ],
            [
                'name' => 'Yossef Yuda, S.HI, MA',
                'username' => '198008042005011007',
                'jabatan' => 'Kepala Sub Bagian Tata Usaha',
                'email' => '198008042005011007@kemenag.go.id',
                'password' => Hash::make('198008042005011007'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            
            [
                'name' => 'Sumardi, S.Ag, M.Pd',
                'username' => '197107051998031013',
                'jabatan' => 'Kepala Seksi Pendidikan Madrasah',
                'email' => '197107051998031013@kemenag.go.id',
                'password' => Hash::make('197107051998031013'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 3
            ],
            [
                'name' => 'Betriadi, S.HI',
                'username' => '198106122008011013',
                'jabatan' => 'Kepala Seksi Penyelenggara Haji dan Umrah',
                'email' => '198106122008011013@kemenag.go.id',
                'password' => Hash::make('198106122008011013'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 4
            ],
            [
                'name' => 'Masrizal, S.Ag, M.Pd',
                'username' => '197202051997031003',
                'jabatan' => 'Kepala Seksi Pendidikan Agama Islam',
                'email' => '197202051997031003@kemenag.go.id',
                'password' => Hash::make('197202051997031003'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 5
            ],
            [
                'name' => 'Drs. Firdaus',
                'username' => '196706191994031004',
                'jabatan' => 'Kepala Seksi Bimbingan Masyarakat Islam',
                'email' => '196706191994031004@kemenag.go.id',
                'password' => Hash::make('196706191994031004'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 6
            ],
            [
                'name' => 'Sudirman, S.Ag',
                'username' => '197202112003121003',
                'jabatan' => 'Kepala Seksi Pondok Pesantren',
                'email' => '197202112003121003@kemenag.go.id',
                'password' => Hash::make('197202112003121003'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 7
            ],
            [
                'name' => 'Gustiwarni, S.Ag',
                'username' => '196906151996032002',
                'jabatan' => 'Kepala Seksi Zakat dan Wakaf',
                'email' => '196906151996032002@kemenag.go.id',
                'password' => Hash::make('196906151996032002'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 8
            ],

            // Umum
           
            [
                'name' => 'Afrison, S.HI',
                'username' => '197901012007101004',
                'jabatan' => 'Pelaksana Analis Pelayanan',
                'email' => '197901012007101004@kemenag.go.id',
                'password' => Hash::make('197901012007101004'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [
                'name' => 'Upik Mike, S.AP',
                'username' => '198505202014122005',
                'jabatan' => 'Pelaksana Pengadministrasi Keuangan ',
                'email' => '198505202014122005@kemenag.go.id',
                'password' => Hash::make('198505202014122005'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [
                'name' => 'DENI MARLINA S.Pd.I',
                'username' => '197703072023212012',
                'jabatan' => 'Arsiparis Ahli Pertama ',
                'email' => '197703072023212012@kemenag.go.id',
                'password' => Hash::make('197703072023212012'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],

            // Staff Kepegawaian
            [
                'name' => 'Jarmil',
                'username' => '198005152005011007',
                'jabatan' => 'Analis SDM Aparatur Ahli Muda',
                'email' => '198005152005011007@kemenag.go.id',
                'password' => Hash::make('198005152005011007'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2

            ],
            [
                'name' => 'Anna Yoladevika, SH',
                'username' => '197505152005012003',
                'jabatan' => 'Analis Sumber Daya Manusia Aparatur',
                'email' => '197505152005012003@kemenag.go.id',
                'password' => Hash::make('197505152005012003'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [
                'name' => 'Sri Mulyani, SH',
                'username' => '198006222014112002',
                'jabatan' => 'Pelaksana Analis Pengembangan SDM Aparatur',
                'email' => '198006222014112002@kemenag.go.id',
                'password' => Hash::make('198006222014112002'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            // Staff Keuangan
            [
                'name' => 'MUCHLIS, S.TP',
                'username' => '197603152005011006',
                'jabatan' => 'Perencana Ahli Muda',
                'email' => '197603152005011006@kemenag.go.id',
                'password' => Hash::make('197603152005011006'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2

            ],
            [
                'name' => 'NELDAFINA, A.Md',
                'username' => '197112252007102002',
                'jabatan' => 'Pranata Keuangan APBN Mahir',
                'email' => '197112252007102002@kemenag.go.id',
                'password' => Hash::make('197112252007102002'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2

            ],
            [
                'name' => 'Yunefri, S.Kom ',
                'username' => '197406142007101001',
                'jabatan' => 'Pranata Keuangan APBN Penyelia',
                'email' => '197406142007101001@kemenag.go.id',
                'password' => Hash::make('197406142007101001'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [
                'name' => 'Del Junefri, SE',
                'username' => '197606082009121001',
                'jabatan' => 'Analis Pengelolaan Keuangan APBN Ahli Muda',
                'email' => '197606082009121001@kemenag.go.id',
                'password' => Hash::make('197606082009121001'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [
                'name' => 'Ramadhanera P Madya, SE',
                'username' => '198705122011012008',
                'jabatan' => 'Pelaksana Penyusun Program Anggaran dan Pelaporan',
                'email' => '198705122011012008@kemenag.go.id',
                'password' => Hash::make('198705122011012008'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [
                'name' => 'Nila Oksana, A. Ma',
                'username' =>'198210132007102002',
                'jabatan' => 'Pengadministrasi Umum',
                'email' => '198210132007102002@kemenag.go.id',
                'password' => Hash::make('198210132007102002'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 5
            ],
            [
                'name' => 'Roni Hendra',
                'username' =>'198212152005011002',
                'jabatan' => 'Pengadministrasi Keuangan',
                'email' => '198212152005011002@kemenag.go.id',
                'password' => Hash::make('198212152005011002'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [
                'name' => 'Asriwansyah',
                'username' =>'198204032005011001',
                'jabatan' => 'Pelaksana Pengadministrasi Keuangan',
                'email' => '198204032005011001@kemenag.go.id',
                'password' => Hash::make('198204032005011001'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [
                'name' => 'Meiriza Lidya, S.S',
                'username' => '198605052023212065',
                'jabatan' => 'Pengembang Teknologi Pembelajaran Ahli Pertama',
                'email' => '198605052023212065@kemenag.go.id',
                'password' => Hash::make('198605052023212065 '),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [

                'name' => 'Fauzhi Abdhilah, S.Kom',
                'username' => '198810252023211021',
                'jabatan' => 'Pengembang Teknologi Pembelajaran Ahli Pertama',
                'email' => '198810252023211021@kemenag.go.id',
                'password' => Hash::make('198810252023211021'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [

                'name' => 'AZKA JUANDA, S.Pd',
                'username' => '199307222023211014',
                'jabatan' => 'Pengembang Teknologi Pembelajaran Ahli Pertama',
                'email' => '199307222023211014@kemenag.go.id',
                'password' => Hash::make('199307222023211014'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [

                'name' => 'KIKI DESETRI S.Pd.I',
                'username' => '199009152023211019',
                'jabatan' => 'Pengembang Teknologi Pembelajaran Ahli Pertama',
                'email' => '199009152023211019@kemenag.go.id',
                'password' => Hash::make('199009152023211019'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            [

                'name' => 'AFRINOZAYENTI S.AP',
                'username' => '197904092023212012',
                'jabatan' => 'Analis SDM Aparatur Ahli Pertama',
                'email' => '197904092023212012@kemenag.go.id',
                'password' => Hash::make('197904092023212012'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],




            // Staff Penmad
            [

                'name' => 'DEDI GUSTIAWAN, S.Pd.',
                'username' => '198808222023211013',
                'jabatan' => 'Pengembang Teknologi Pembelajaran Ahli Pertama',
                'email' => '198808222023211013@kemenag.go.id',
                'password' => Hash::make('198808222023211013'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 3
            ],
            [
                'name' => 'Heru Syafri,A.Ma',
                'username' => '198212262005011004',
                'jabatan' => 'Pengadministrasi Sertifkasi',
                'email' => '198212262005011004@kemenag.go.id',
                'password' => Hash::make('198212262005011004'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 5
            ],
            
           
            [

                'name' => 'Dewi Martaliza, S.AP',
                'username' => '197903062014122002',
                'jabatan' => 'Pelaksana Pengadministrasi Umum',
                'email' => '197903062014122002@kemenag.go.id',
                'password' => Hash::make('197903062014122002'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 3
            ],
            // Staff Haji
            [
                'name' => 'MARDANITA JALPIDA, S.S',
                'username' => '198003162007102002',
                'jabatan' => 'Analis Pengembangan Peserta Didik',
                'email' => '198003162007102002@kemenag.go.id',
                'password' => Hash::make('198003162007102002'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 3
            ],
            [
                'name' => 'Liswarti, S.Th I',
                'username' => '198104122009012004',
                'jabatan' => 'Penyusun Bahan Pendaftaran atau Pembatalan Haji',
                'email' => '198104122009012004@kemenag.go.id',
                'password' => Hash::make('198104122009012004'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 4
            ],
            [
                'name' => 'Martinis, S.Th I',
                'username' => '197101152007102002',
                'jabatan' => 'Pelaksana Analis Haji pada Seksi Penyelenggaraan Haji dan Umrah',
                'email' => '197101152007102002@kemenag.go.id',
                'password' => Hash::make('197101152007102002'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 4
            ],
            // Staff PAIS
            [
                'name' => 'ENDRIZAL, S.Ag, MA',
                'username' => '197205062007101002',
                'jabatan' => 'Penyusun Data Pendidikan Agama dan Keagamaan',
                'email' => '197205062007101002@kemenag.go.id',
                'password' => Hash::make('197205062007101002'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 7
            ],
            [
                'name' => 'Syafria Norawati, A.Ma',
                'username' => '198004142007102006',
                'jabatan' => 'Analis Kesejahteraan Sumber Daya Manusia',
                'email' => '198004142007102006@kemenag.go.id',
                'password' => Hash::make('19800414 200710 2 006'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2
            ],
            // Staff Bimas
            [
                'name' => 'MARSEHARTI, S.Ag',
                'username' => '197208212000032003',
                'jabatan' => 'Pelaksana Penyusun Administrasi Kepenghuluan',
                'email' => '197208212000032003@kemenag.go.id',
                'password' => Hash::make('197208212000032003'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 6
            ],
            [
                'name' => 'Efnurdawati, S.HI',
                'username' => '197809292005012003',
                'jabatan' => 'Pelaksana Penyusun Bahan Pembinaan Masjid',
                'email' => '197809292005012003@kemenag.go.id',
                'password' => Hash::make('197809292005012003'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 6
            ],
            // Staff ZaWa
            [
                'name' => 'ERMANINGSIH ',
                'username' => '197706292007102008',
                'jabatan' => 'Pengadministrasi Umum',
                'email' => '197706292007102008@kemenag.go.id',
                'password' => Hash::make('197706292007102008'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 8

            ],
            [
                'name' => 'EDROMITA',
                'username' => '197801182014111001',
                'jabatan' => 'Pengadministrasi Umum',
                'email' => '197801182014111001@kemenag.go.id',
                'password' => Hash::make('197801182014111001'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 8

            ],

            // New One
            
            [
                'name' => 'YUSNETI',
                'username' => '196702121998032002',
                'jabatan' => 'Pengadministrasi Umum',
                'email' => '196702121998032002@kemenag.go.id',
                'password' => Hash::make('196702121998032002'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2

            ],
           
            [
                'name' => 'AFNIZON, S.AP ',
                'username' => '197610182009011004',
                'jabatan' => 'Penyusun Data Peserta Didik pada Seksi Pendidikan Madrasah',
                'email' => '197610182009011004@kemenag.go.id',
                'password' => Hash::make('197610182009011004'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 3

            ],
            [
                'name' => 'KOKO NURHADI YANTO ',
                'username' => '198305042014111002',
                'jabatan' => 'Pelaksana Pengadministrasi Keuangan',
                'email' => '198305042014111002@kemenag.go.id',
                'password' => Hash::make('198305042014111002'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 2

            ],
          
            [
                'name' => 'SARIFAH AINI, S.Th I',
                'username' => '198701032011012010',
                'jabatan' => 'Penyusun Dokumen Haji',
                'email' => '198701032011012010@kemenag.go.id',
                'password' => Hash::make('198701032011012010'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 4

            ],
            [
                'name' => 'DODY YUSRIYAL',
                'username' => '198406262007101003',
                'jabatan' => 'Pengadministrasi Umum',
                'email' => '198406262007101003@kemenag.go.id',
                'password' => Hash::make('198406262007101003'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 7

            ],
            [
                'name' => 'RICHO HARDIATNO, S.Pd',
                'username' => '198312122009011013',
                'jabatan' => 'Pelaksana Analis Data Dan Informasi Pendidik Dan Tenaga Kependidikan',
                'email' => '198312122009011013@kemenag.go.id',
                'password' => Hash::make('198312122009011013'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 3

            ],
            [
                'name' => 'USRI',
                'username' => '197505162014111001',
                'jabatan' => 'Pelaksana Pengadministrasi Umum',
                'email' => '197505162014111001@kemenag.go.id',
                'password' => Hash::make('197505162014111001'),
                'updated_at' => \Carbon\Carbon::now(),
                'role' => 3,
                'organization_id' => 6
            ],
            
        ];


        // DB::table('users')->insert($data);

        foreach ($data as $key => $item) {
            \App\Models\User::firstOrCreate(
                ['username' => $item['username']],
                $item
            );
        }
    }
}
