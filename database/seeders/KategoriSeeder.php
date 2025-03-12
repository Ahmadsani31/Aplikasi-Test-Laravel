<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = DB::table('users')->first();
        $kategori = [
            ['nama' => 'Elektronik', 'user_id' => $user->id],
            ['nama' => 'Peralatan Dapur', 'user_id' => $user->id],
            ['nama' => 'Pakaian', 'user_id' => $user->id],
            ['nama' => 'Sepatu & Sandal', 'user_id' => $user->id],
            ['nama' => 'Peralatan Kantor', 'user_id' => $user->id],
            ['nama' => 'Alat Musik', 'user_id' => $user->id],
            ['nama' => 'Aksesoris Fashion', 'user_id' => $user->id],
            ['nama' => 'Mainan & Hobi', 'user_id' => $user->id],
            ['nama' => 'Peralatan Olahraga', 'user_id' => $user->id],
            ['nama' => 'Produk Kecantikan', 'user_id' => $user->id],
            ['nama' => 'Kesehatan', 'user_id' => $user->id],
            ['nama' => 'Otomotif', 'user_id' => $user->id],
            ['nama' => 'Peralatan Rumah Tangga', 'user_id' => $user->id],
            ['nama' => 'Furnitur', 'user_id' => $user->id],
            ['nama' => 'Aksesoris Handphone', 'user_id' => $user->id],
        ];
        DB::table('kategoris')->insert($kategori);
    }
}
