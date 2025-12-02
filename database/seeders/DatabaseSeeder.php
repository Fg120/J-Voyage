<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengelola;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Fasilitas;
use App\Models\Highlight;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     PermissionSeeder::class,
        //     RoleSeeder::class,
        //     WilayahSeeder::class,
        //     UserSeeder::class,
        // ]);

        $faker = Faker::create('id_ID');

        $listKecamatanID = Kecamatan::pluck('id')->toArray();

        if (empty($listKecamatanID)) {
            $this->command->error('❌ Error: Tabel Kecamatan kosong!');
            return;
        }

        $this->command->info('⏳ Sedang membuat 50 Akun & Data Wisata...');

        foreach (range(10, 50) as $index) {

            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->userName . '@gmail.com',
                'password' => Hash::make('password'),
                'telepon' => $faker->phoneNumber,
                'email_verified_at' => now(),
            ]);


            $kecamatanID = $faker->randomElement($listKecamatanID);

            $desa = Desa::where('kecamatan_id', $kecamatanID)->inRandomOrder()->first();
            $desaID = $desa ? $desa->id : null;

            $prefix = $faker->randomElement(['Wisata', 'Pantai', 'Bukit', 'Kampung', 'Taman', 'Pemandian']);
            $namaWisata = $prefix . ' ' . $faker->citySuffix . ' ' . $faker->firstName;

            $pengelola = Pengelola::create([
                'user_id' => $user->id,
                'nama_wisata' => $namaWisata,

                'kecamatan_id' => $kecamatanID,
                'desa_id' => $desaID,

                'alamat_wisata' => $faker->address,
                'deskripsi_wisata' => $faker->paragraph(3),
                'harga' => $faker->numberBetween(5, 50) * 1000, // Rp 5.000 - 50.000
                'jam_buka' => '08:00',
                'jam_tutup' => '16:00',
                'kontak_wisata' => $faker->phoneNumber,

                'status' => $faker->randomElement(['approved', 'approved', 'approved', 'pending']),


                'nama_bank' => $faker->randomElement(['BRI', 'BCA', 'Mandiri', 'Jatim']),
                'nomor_rekening' => $faker->creditCardNumber,
                'nama_pemilik_rekening' => $user->name,
                'verified_at' => now(),
            ]);

            $opsiFasilitas = ['Toilet', 'Musholla', 'Parkir', 'Kantin', 'Gazebo', 'WiFi', 'Spot Foto'];
            foreach ($faker->randomElements($opsiFasilitas, 3) as $item) {
                Fasilitas::create(['pengelola_id' => $pengelola->id, 'nama' => $item]);
            }
            $opsiHighlight = ['Sunset', 'Air Jernih', 'Sejuk', 'Pasir Putih', 'Instagramable'];
            foreach ($faker->randomElements($opsiHighlight, 2) as $item) {
                Highlight::create(['pengelola_id' => $pengelola->id, 'nama' => $item]);
            }
        }

        $this->command->info('✅ Selesai! 50 Data User & Pengelola berhasil dibuat.');
    }
}
