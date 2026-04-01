<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PerawatanTernak;
use App\Models\PerpindahanTernak;
use App\Models\Ternak;

class ActivityController extends Controller
{
    public function index()
    {
        $ternaks = Ternak::select('id_ternak', 'nama_ternak', 'created_at as waktu')
            ->get()
            ->map(function ($item) {
                return [
                    'id'          => 'T-' . $item->id_ternak . '-' . $item->waktu,
                    'tipe'        => 'input_ternak',
                    'judul'       => 'Ternak Baru Terdaftar',
                    'deskripsi'   => "Ternak {$item->nama_ternak} ({$item->id_ternak}) ditambahkan ke sistem.",
                    'id_ternak'   => $item->id_ternak,
                    'waktu'       => $item->waktu,
                ];
            });

        $perawatans = PerawatanTernak::select('id_ternak', 'diagnosa', 'created_at as waktu')
            ->get()
            ->map(function ($item) {
                return [
                    'id'          => 'R-' . $item->id_ternak . '-' . $item->waktu,
                    'tipe'        => 'perawatan',
                    'judul'       => 'Perawatan Medis',
                    'deskripsi'   => "Ternak {$item->id_ternak} mendapat perawatan untuk: {$item->diagnosa}.",
                    'id_ternak'   => $item->id_ternak,
                    'waktu'       => $item->waktu,
                ];
            });

        $perpindahans = PerpindahanTernak::select('id_ternak', 'kandang_awal', 'kandang_tujuan', 'created_at as waktu')
            ->get()
            ->map(function ($item) {
                return [
                    'id'          => 'P-' . $item->id_ternak . '-' . $item->waktu,
                    'tipe'        => 'perpindahan',
                    'judul'       => 'Perpindahan Kandang',
                    'deskripsi'   => "Ternak {$item->id_ternak} dipindah dari {$item->kandang_awal} ke {$item->kandang_tujuan}.",
                    'id_ternak'   => $item->id_ternak,
                    'waktu'       => $item->waktu,
                ];
            });

        $activities = $ternaks->concat($perawatans)
                              ->concat($perpindahans)
                              ->sortByDesc('waktu')
                              ->values();

        return response()->json([
            'message' => 'Berhasil mengambil riwayat aktivitas',
            'data'    => $activities
        ], 200);
    }
}