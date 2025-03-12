<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextComparison extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'input1', 'input2', 'percentage', 'match_count', 'matched_chars'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
