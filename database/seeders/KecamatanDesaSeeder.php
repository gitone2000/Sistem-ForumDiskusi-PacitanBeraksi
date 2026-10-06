<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kecamatanList = [
            'Arjosari' => ['Borang', 'Gayuhan', 'Gegeran', 'Gembong', 'Gunungsari', 'Jatimalang', 'Jetis Kidul', 'Karanggede', 'Karangrejo', 'Kedungbendo', 'Mangunharjo', 'Mlati', 'Pagutan', 'Sedayu', 'Temon', 'Tremas'],
            'Bandar' => ['Bandar', 'Bangunsari', 'Jeruk', 'Kledung', 'Ngunut', 'Petungsinarang', 'Tumpuk', 'Watupatok'],
            'Nawangan' => ['Gondang', 'Jetis Lor', 'Mujing', 'Nawangan', 'Ngromo', 'Pakis Baru', 'Penggung', 'Sempu', 'Tokawi'],
        ];

        foreach ($kecamatanList as $kecamatanNama => $desas) {
            $kecamatan = Kecamatan::create(['nama' => $kecamatanNama]);

            foreach ($desas as $desaNama) {
                Desa::create([
                    'nama' => $desaNama,
                    'kecamatan_id' => $kecamatan->id,
                ]);
            }
        }
    }
}
