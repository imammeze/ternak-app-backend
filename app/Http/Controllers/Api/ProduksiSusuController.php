<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProduksiSusu;
use Illuminate\Http\Request;

class ProduksiSusuController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('stakeholder')) {
            $produksi = ProduksiSusu::where('user_id', $user->id)
                                    ->orderBy('tanggal', 'desc')
                                    ->get();
        } else {
            $produksi = ProduksiSusu::with('pemilik')
                                    ->orderBy('tanggal', 'desc')
                                    ->get();
        }

        return response()->json([
            'message' => 'Berhasil mengambil data produksi susu',
            'data' => $produksi
        ], 200);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'       => 'required|date',
            'kepemilikan'   => 'required|string',
            'user_id'       => 'nullable|string|exists:users,id',
            'pagi_1l'       => 'required|numeric|min:0',
            'pagi_250ml'    => 'required|numeric|min:0',
            'pagi_cempe_ml' => 'required|numeric|min:0',
            'sore_1l'       => 'required|numeric|min:0',
            'sore_250ml'    => 'required|numeric|min:0',
            'sore_cempe_ml' => 'required|numeric|min:0',
            'total_liter'   => 'required|numeric|min:0',
            'petugas'       => 'nullable|string',
            'catatan'       => 'nullable|string',
        ]);

        $produksi = ProduksiSusu::create($validated);

        return response()->json([
            'message' => 'Data produksi susu berhasil disimpan',
            'data'    => $produksi
        ], 201);
    }
}