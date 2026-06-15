<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
        'food_post_id',
        'user_id',
        'kode_klaim',
        'status',
    ];

    public function foodPost()
    {
        return $this->belongsTo(FoodPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}