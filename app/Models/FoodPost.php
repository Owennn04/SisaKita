<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodPost extends Model
{
    protected $fillable = [
        'user_id',
        'nama_makanan',
        'jumlah_porsi',
        'lokasi',
        'batas_waktu',
        'foto',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}