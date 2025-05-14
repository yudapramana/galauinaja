<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocTypesTableSeeder extends Seeder
{
    public function run()
    {
        $docs = [
            ['Ijazah SD', 'IJZHSD'],
            ['Ijazah SMP/Sederajat', 'IJZHSMP'],
            ['Ijazah SMA/Sederajat', 'IJZHSMA'],
            ['Ijazah D2/D3/S1/A-IV/S2', 'IJZHKLH'],
            ['Transkrip Nilai D2/D3/S1/S2', 'TRANSNILAI'],
            ['SK CPNS', 'SKCPNS'],
            ['SK PNS', 'SKPNS'],
            ['SK Kenaikan Pangkat', 'SKKP'],
            ['SK Pengangkatan Pertama dalam Jabatan Fungsional', 'SKJFPERTAMA', false],
            ['SK Kenaikan Jenjang Jabatan Fungsional', 'SKNAIKJF', false],
            ['SK Pengangkatan Pertama dalam Jabatan Pelaksana', 'SKJPPERTAMA', false],
            ['SK Mutasi/Pindah dan SK Jabatan', 'SKMUT&JAB'],
            ['SK Jabatan Pejabat Struktural Eselon III, IV, dan V', 'SKJABSTRUK', false],
            ['SK Jabatan Pejabat Fungsional bagi Kepala KUA dan Kepala Madrasah', 'SKJABFUNG'],
            ['Surat Pernyataan Pelantikan', 'SPP'],
            ['Berita Acara Sumpah Jabatan', 'BASUMPAH'],
            ['Surat Pernyataan Melaksanakan Tugas', 'SPMT'],
            ['Surat Penyataan Menduduki Jabatan', 'SPMJ'],
            ['PAK Konvensional', 'PAKKONVENSIONAL'],
            ['PAK Integrasi', 'PAKINTEGRASI'],
            ['PAK Konversi 2 Tahun Terakhir', 'PAKKONVERSI'],
            ['SKP 2 Tahun Terakhir', 'SKP'],
            ['KGB 2 Periode Terakhir', 'KGB'],
            ['KARPEG', 'KARPEG'],
            ['NIP Konversi', 'NIPKONVERSI'],
            ['NPWP', 'NPWP'],
            ['Kartu Keluarga', 'KK'],
            ['Buku Nikah', 'BUKUNKH'],
            ['KTP Ybs', 'KTPYBS'],
            ['KTP Pasangan', 'KTPPSGN'],
            ['Akte Kelahiran Ybs', 'AKYBS'],
            ['Akte Kelahiran Pasangan', 'AKPSGN'],
            ['Akte Kelahiran Anak-Anak', 'AKANAK'],
            ['KARIS/KARSU', 'KARISKARSU'],
            ['Buku Rekening Gaji', 'BUKUREK'],
        ];

        // Seed untuk PNS
        foreach ($docs as $doc) {
            DB::table('doc_types')->insert([
                'status'     => 'PNS',
                'type_name'  => $doc[0],
                'label'      => $doc[1],
                'mandatory'  => $doc[2] ?? true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }



        $docsPPPK = [
            ['Ijazah SD', 'IJZHSD'],
            ['Ijazah SMP/Sederajat', 'IJZHSMP'],
            ['Ijazah SMA/Sederajat', 'IJZHSMA'],
            ['Ijazah D2/D3/S1/A-IV/S2', 'IJZHKLH'],
            ['Transkrip Nilai D2/D3/S1/S2', 'TRANSNILAI'],
            ['SK CPPPK', 'SKCPPPK'],
            ['SK PPPK', 'SKPPPK'],
            ['Persetujuan Teknis BKN', 'PERTEK'],
            ['Perjanjian Kerja PPPK', 'PERKERJAPPPK'],
            ['Surat Pernyataan Pelantikan', 'SPP'],
            ['Surat Pernyataan Melaksanakan Tugas', 'SPMT'],
            ['Surat Penyataan Menduduki Jabatan', 'SPMJ'],
            ['SKP 2 Tahun Terakhir', 'SKP'],
            ['KGB 2 Periode Terakhir', 'KGB'],
            ['NPWP', 'NPWP'],
            ['Kartu Keluarga', 'KK'],
            ['Buku Nikah', 'BUKUNKH'],
            ['KTP Ybs', 'KTPYBS'],
            ['KTP Pasangan', 'KTPPSGN'],
            ['Akte Kelahiran Ybs', 'AKYBS'],
            ['Akte Kelahiran Pasangan', 'AKPSGN'],
            ['Akte Kelahiran Anak-Anak', 'AKANAK'],
            ['Buku Rekening Gaji', 'BUKUREK'],
        ];


        // Seed untuk PPPK
        foreach ($docsPPPK as $doc) {
            DB::table('doc_types')->insert([
                'status'     => 'PPPK',
                'type_name'  => $doc[0],
                'label'      => $doc[1],
                'mandatory'  => $doc[2] ?? true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
