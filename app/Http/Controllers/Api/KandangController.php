<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kandang;
use Illuminate\Http\Request;

class KandangController extends Controller
{
    public function index()
    {
        $kandangs = Kandang::orderBy('kode_kandang', 'asc')->get();
        
        return response()->json([
            'message' => 'Berhasil mengambil data kandang',
            'data'    => $kandangs
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kandang' => 'required|string|unique:kandangs,kode_kandang',
            'nama_kandang' => 'required|string',
            'kapasitas'    => 'required|integer|min:1',
            'jenis'        => 'required|string',
            'status'       => 'required|string',
            'catatan'      => 'nullable|string',
        ]);

        $kandang = Kandang::create($validated);

        return response()->json([
            'message' => 'Kandang baru berhasil ditambahkan',
            'data'    => $kandang
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $kandang = Kandang::find($id);

        if (!$kandang) {
            return response()->json(['message' => 'Data kandang tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'kode_kandang' => 'required|string|unique:kandangs,kode_kandang,' . $id,
            'nama_kandang' => 'required|string',
            'kapasitas'    => 'required|integer|min:1',
            'jenis'        => 'required|string',
            'status'       => 'required|string',
            'catatan'      => 'nullable|string',
        ]);

        $kandang->update($validated);

        return response()->json([
            'message' => 'Data kandang berhasil diperbarui',
            'data'    => $kandang
        ], 200);
    }

    public function destroy($id)
    {
        $kandang = Kandang::find($id);

        if (!$kandang) {
            return response()->json(['message' => 'Data kandang tidak ditemukan'], 404);
        }

        $kandang->delete();

        return response()->json([
            'message' => 'Data kandang berhasil dihapus'
        ], 200);
    }
}