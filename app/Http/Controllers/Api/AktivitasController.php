<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    public function index()
    {
        $aktivitas = Aktivitas::orderBy('id', 'desc')->get();
        return response()->json(['data' => $aktivitas], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_aktivitas' => 'required|string',
            'kategori'       => 'required|string',
            'status'         => 'required|string',
        ]);

        $aktivitas = Aktivitas::create($validated);
        return response()->json(['data' => $aktivitas], 201);
    }

    public function update(Request $request, $id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        
        $validated = $request->validate([
            'nama_aktivitas' => 'required|string',
            'kategori'       => 'required|string',
            'status'         => 'required|string',
        ]);

        $aktivitas->update($validated);
        return response()->json(['data' => $aktivitas], 200);
    }

    public function destroy($id)
    {
        Aktivitas::destroy($id);
        return response()->json(['message' => 'Berhasil dihapus'], 200);
    }
}