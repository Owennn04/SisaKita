<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\FoodPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClaimController extends Controller
{
    public function store(Request $request, FoodPost $foodPost)
    {
        // Cek apakah sudah pernah klaim post ini
        $existing = Claim::where('food_post_id', $foodPost->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            return redirect()->route('food-posts.index')
                ->with('error', 'Kamu sudah mengklaim makanan ini.');
        }

        // Cek apakah masih available
        if ($foodPost->status !== 'available') {
            return redirect()->route('food-posts.index')
                ->with('error', 'Makanan ini sudah tidak tersedia.');
        }

        // Buat klaim
        $kode = strtoupper(Str::random(6));

        Claim::create([
            'food_post_id' => $foodPost->id,
            'user_id'      => Auth::id(),
            'kode_klaim'   => $kode,
            'status'       => 'pending',
        ]);

        // Kurangi porsi
        $foodPost->decrement('jumlah_porsi');

        if ($foodPost->jumlah_porsi <= 0) {
            $foodPost->update(['status' => 'claimed']);
        }

        return redirect()->route('food-posts.index')
            ->with('success', "Berhasil klaim! Kode kamu: $kode");
    }

    public function myClaims()
    {
        $claims = Claim::where('user_id', Auth::id())
            ->with('foodPost')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('claims.my-claims', compact('claims'));
    }

        public function confirm(Claim $claim)
    {
        $claim->update(['status' => 'confirmed']);

        return redirect()->back()->with('success', 'Klaim berhasil dikonfirmasi.');
    }

    public function kantinClaims()
    {
        $claims = Claim::whereHas('foodPost', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with('foodPost', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('claims.kantin-claims', compact('claims'));
    }
}