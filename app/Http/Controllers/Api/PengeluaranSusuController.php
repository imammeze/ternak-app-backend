<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PengeluaranSusu;
use App\Models\ProduksiSusu;
use Illuminate\Http\Request;

class PengeluaranSusuController extends Controller
{
    public function index()
    {
        $pengeluaran = PengeluaranSusu::orderBy('tanggal', 'desc')->get();
        return response()->json([
            'message' => 'Berhasil mengambil data pengeluaran susu',
            'data' => $pengeluaran
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'     => 'required|date',
            'susu_1l'     => 'required|numeric|min:0',
            'susu_250ml'  => 'required|numeric|min:0',
            'kategori'    => 'required|string',
            'pembayaran'  => 'nullable|string',
            'customer'    => 'nullable|string',
            'total_liter' => 'required|numeric|min:0',
            'keterangan'  => 'nullable|string',
        ]);

        $totalProduksi = ProduksiSusu::selectRaw('SUM((pagi_1l + sore_1l) * 1 + (pagi_250ml + sore_250ml) * 0.25) as stok_masuk')
                                    ->value('stok_masuk') ?? 0;
        $totalPengeluaran = PengeluaranSusu::sum('total_liter') ?? 0;
        $stokTersedia = $totalProduksi - $totalPengeluaran;

        if ($validated['total_liter'] > $stokTersedia) {
            return response()->json([
                'message' => "Stok tidak mencukupi! Sisa stok saat ini hanya {$stokTersedia} Liter."
            ], 422);
        }

        $pengeluaran = PengeluaranSusu::create($validated);

        return response()->json([
            'message' => 'Data pengeluaran susu berhasil dicatat!',
            'data'    => $pengeluaran
        ], 201);
    }
}