<?php

namespace App\Http\Controllers;

use App\Models\FoodPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodPostController extends Controller
{
    public function index()
    {
        $foodPosts = FoodPost::where('status', 'available')
            ->where('batas_waktu', '>', now())
            ->orderBy('batas_waktu', 'asc')
            ->get();

        return view('food-posts.index', compact('foodPosts'));
    }

    public function create()
    {
        return view('food-posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'jumlah_porsi' => 'required|integer|min:1',
            'lokasi'       => 'required|string|max:255',
            'batas_waktu'  => 'required|date|after:now',
            'foto'         => 'nullable|image|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('food-photos', 'public');
        }

        FoodPost::create([
            'user_id'      => Auth::id(),
            'nama_makanan' => $request->nama_makanan,
            'jumlah_porsi' => $request->jumlah_porsi,
            'lokasi'       => $request->lokasi,
            'batas_waktu'  => $request->batas_waktu,
            'foto'         => $fotoPath,
            'status'       => 'available',
        ]);

        return redirect()->route('food-posts.index')
            ->with('success', 'Makanan berhasil dipost!');
    }

    public function edit(FoodPost $foodPost)
{
    if (auth()->id() !== $foodPost->user_id) {
        abort(403);
    }

    return view('food-posts.edit', compact('foodPost'));
}

public function update(Request $request, FoodPost $foodPost)
{
    if (auth()->id() !== $foodPost->user_id) {
        abort(403);
    }

    $request->validate([
        'nama_makanan' => 'required|string|max:255',
        'jumlah_porsi' => 'required|integer|min:1',
        'lokasi'       => 'required|string|max:255',
        'batas_waktu'  => 'required|date',
        'foto'         => 'nullable|image|max:2048',
    ]);

    $fotoPath = $foodPost->foto;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('food-photos', 'public');
    }

    $foodPost->update([
        'nama_makanan' => $request->nama_makanan,
        'jumlah_porsi' => $request->jumlah_porsi,
        'lokasi'       => $request->lokasi,
        'batas_waktu'  => $request->batas_waktu,
        'foto'         => $fotoPath,
    ]);

    return redirect()->route('food-posts.index')
        ->with('success', 'Makanan berhasil diupdate!');
}

    public function destroy(FoodPost $foodPost)
    {
        $foodPost->delete();
        return redirect()->route('food-posts.index')
            ->with('success', 'Post berhasil dihapus.');
    }
}