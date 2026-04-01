<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PerpindahanTernak;
use App\Models\Ternak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerpindahanTernakController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_tindakan' => 'required|date',
            'id_ternak'        => 'required|string|exists:ternaks,id_ternak',
            'kandang_awal'     => 'required|string',
            'kandang_tujuan'   => 'required|string|different:kandang_awal', 
            'catatan'          => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $perpindahan = PerpindahanTernak::create($validated);

            $ternak = Ternak::where('id_ternak', $validated['id_ternak'])->first();
            $ternak->no_kandang = $validated['kandang_tujuan'];
            $ternak->save();
            
            DB::commit();

            return response()->json([
                'message' => 'Perpindahan berhasil dan lokasi sapi telah diperbarui!',
                'data'    => $perpindahan
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'message' => 'Gagal memproses perpindahan: ' . $e->getMessage()
            ], 500);
        }
    }
}