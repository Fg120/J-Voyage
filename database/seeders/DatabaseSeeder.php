<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Fasilitas;
use App\Models\Highlight;
use App\Models\Kecamatan;
use App\Models\Pengelola;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Ulasan;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            WilayahSeeder::class,
            UserSeeder::class,
        ]);

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

        $listUserID = User::pluck('id')->toArray();
        // --- F. BUAT ULASAN (BARU) ---
        // Membuat 5 sampai 15 ulasan random per wisata
        $jumlahUlasan = $faker->numberBetween(5, 15);

        for ($i = 0; $i < $jumlahUlasan; $i++) {
            // Pilih user acak dari list untuk jadi reviewer
            // (Menggunakan array_rand atau randomElement)
            $reviewerId = $faker->randomElement($listUserID);

            // Opsional: Cek agar pemilik tidak mereview wisatanya sendiri
            if ($reviewerId == $user->id && count($listUserID) > 1) {
                continue;
            }

            // Kata-kata ulasan random
            $komentar = $faker->randomElement([
                'Tempatnya sangat bagus dan bersih!',
                'Pemandangan indah, tapi akses jalan agak susah.',
                'Fasilitas lengkap, cocok untuk keluarga.',
                'Tiket murah meriah, worth it banget!',
                'Sangat merekomendasikan tempat ini.',
                'Toiletnya bersih, musholla nyaman.',
                'Parkiran luas, aman.',
                'Kurang terawat sedikit, tapi oke lah.',
                'Best view in Jember!',
                'Makanan di kantinnya enak-enak.'
            ]);

            Ulasan::create([
                'user_id' => $reviewerId,
                'pengelola_id' => $pengelola->id,
                'rating' => $faker->numberBetween(3, 5), // Rating antara 3 sampai 5 biar kelihatan bagus
                'ulasan' => $komentar . ' ' . $faker->sentence(), // Gabung template + kalimat random
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'), // Tanggal acak 1 tahun terakhir
            ]);
        }
        $this->command->info('✅ Selesai! 50 Data User & Pengelola berhasil dibuat.');
    }
}
