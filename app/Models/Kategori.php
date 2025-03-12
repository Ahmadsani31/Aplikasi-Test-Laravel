<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama',

    ];

    public $timestamps = true;

    public function subKategori(): HasMany
    {
        return $this->hasMany(SubKategori::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kategori) {
            $kategori->subKategori()->delete();
        });
    }
}
