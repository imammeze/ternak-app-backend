<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::with('user:id,name')->orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $pengumuman], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required|string',
        ]);

        $validated['user_id'] = Auth::id(); 

        $pengumuman = Pengumuman::create($validated);
        $pengumuman->load('user:id,name'); 

        return response()->json(['data' => $pengumuman], 201);
    }

    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        
        // Opsional: Validasi agar hanya pembuatnya atau Admin yang bisa edit
        // if ($pengumuman->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) { ... }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required|string',
        ]);

        $pengumuman->update($validated);
        $pengumuman->load('user:id,name');

        return response()->json(['data' => $pengumuman], 200);
    }

    public function destroy($id)
    {
        Pengumuman::destroy($id);
        return response()->json(['message' => 'Pengumuman dihapus'], 200);
    }
}