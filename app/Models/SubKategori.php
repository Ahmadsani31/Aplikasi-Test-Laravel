<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kategori_id',
        'nama',

    ];

    public $timestamps = true;

    public function kategory()
    {
        return $this->belongsTo(Kategori::class);
    }

    public static function moveAllToNewCategory($oldKategoriId, $newKategoriId)
    {
        $newKategori = Kategori::find($newKategoriId);

        if (!$newKategori) {
            return 0; // Jika kategori tujuan tidak ditemukan, hentikan proses
        }

        return self::where('kategori_id', $oldKategoriId)->update(['kategori_id' => $newKategoriId]);
    }
}
