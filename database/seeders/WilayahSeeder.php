<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatan = json_decode(file_get_contents(database_path('seeders/data/wilayah/kecamatan.json')), true);
        $desa = json_decode(file_get_contents(database_path('seeders/data/wilayah/desa.json')), true);

        foreach ($kecamatan as $kec) {
            Kecamatan::updateOrCreate(['id' => $kec['id']], [
                'nama' => $kec['nama']
            ]);
        }

        foreach ($desa as $d) {
            Desa::updateOrCreate(['id' => $d['id']], [
                'kecamatan_id' => $d['kecamatan_id'],
                'nama' => $d['nama']
            ]);
        }
    }
}
