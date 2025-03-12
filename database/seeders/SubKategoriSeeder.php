<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = DB::table('users')->first();

        $subKategori = [
            ['kategori_name' => 'Elektronik', 'sub_kategori' => ['Smartphone', 'Laptop', 'Tablet', 'Smartwatch', 'Kamera']],
            ['kategori_name' => 'Peralatan Dapur', 'sub_kategori' => ['Kompor Gas', 'Blender', 'Rice Cooker', 'Oven', 'Mixer']],
            ['kategori_name' => 'Pakaian', 'sub_kategori' => ['Kaos', 'Kemeja', 'Jaket', 'Celana', 'Rok']],
            ['kategori_name' => 'Sepatu & Sandal', 'sub_kategori' => ['Sneakers', 'Sandal Gunung', 'Sepatu Formal', 'Sepatu Olahraga', 'Sepatu Boots']],
            ['kategori_name' => 'Peralatan Kantor', 'sub_kategori' => ['Printer', 'Scanner', 'Mesin Fotokopi', 'Kursi Kantor', 'Meja Kerja']],
            ['kategori_name' => 'Alat Musik', 'sub_kategori' => ['Gitar', 'Keyboard', 'Drum', 'Biola', 'Mikrofon']],
            ['kategori_name' => 'Aksesoris Fashion', 'sub_kategori' => ['Jam Tangan', 'Topi', 'Kacamata', 'Gelang', 'Cincin']],
            ['kategori_name' => 'Mainan & Hobi', 'sub_kategori' => ['Puzzle', 'Action Figure', 'Lego', 'Board Game', 'Kendaraan RC']],
            ['kategori_name' => 'Peralatan Olahraga', 'sub_kategori' => ['Dumbbell', 'Sepeda', 'Matras Yoga', 'Bola Basket', 'Raket Badminton']],
            ['kategori_name' => 'Produk Kecantikan', 'sub_kategori' => ['Lipstik', 'Foundation', 'Masker Wajah', 'Serum', 'Parfum']],
            ['kategori_name' => 'Kesehatan', 'sub_kategori' => ['Vitamin', 'Obat-obatan', 'Alat Cek Kesehatan', 'Masker Medis', 'Termometer']],
            ['kategori_name' => 'Otomotif', 'sub_kategori' => ['Helm', 'Oli Motor', 'Aki Mobil', 'Ban', 'Wiper']],
            ['kategori_name' => 'Peralatan Rumah Tangga', 'sub_kategori' => ['Vacuum Cleaner', 'Kipas Angin', 'Setrika', 'Lampu LED', 'Dispenser']],
            ['kategori_name' => 'Furnitur', 'sub_kategori' => ['Sofa', 'Meja Makan', 'Lemari', 'Kasur', 'Rak Buku']],
            ['kategori_name' => 'Aksesoris Handphone', 'sub_kategori' => ['Casing HP', 'Tempered Glass', 'Powerbank', 'Kabel Charger', 'Earphone']],
        ];

        foreach ($subKategori as $subKatData) {
            $kategori = DB::table('kategoris')->where('nama', $subKatData['kategori_name'])->first();

            if ($kategori) {
                foreach ($subKatData['sub_kategori'] as $subKatName) {
                    DB::table('sub_kategoris')->insert([
                        'kategori_id' => $kategori->id,
                        'nama' => $subKatName,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
    }
}
