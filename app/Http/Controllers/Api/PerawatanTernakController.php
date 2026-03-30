<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PerawatanTernak;
use Illuminate\Http\Request;

class PerawatanTernakController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_tindakan' => 'required|date',
            'id_ternak'        => 'required|string|exists:ternaks,id_ternak',
            'diagnosa'         => 'required|string|max:255',
            'obat'             => 'required|string|max:255',
            'dosis'            => 'required|numeric|min:0',
            'satuan_dosis'     => 'required|string|max:255',
            'catatan'          => 'nullable|string',
        ]);

        $perawatan = PerawatanTernak::create($validated);

        return response()->json([
            'message' => 'Data perawatan ternak berhasil disimpan',
            'data'    => $perawatan
        ], 201);
    }
}