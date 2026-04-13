<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function presensiMasuk(Request $request)
    {
        $request->validate([
            'waktu_absen' => 'required|date',
            'latitude'    => 'required|string',
            'longitude'   => 'required|string',
            'catatan'     => 'nullable|string'
        ]);

        $absen = Absensi::create([
            'user_id'     => Auth::id(),
            'tipe'        => 'Masuk',
            'waktu_absen' => $request->waktu_absen,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'catatan'     => $request->catatan,
        ]);

        return response()->json([
            'message' => 'Presensi masuk berhasil dicatat.',
            'data'    => $absen
        ], 201);
    }

    public function presensiKeluar(Request $request)
    {
        $request->validate([
            'waktu_absen' => 'required|date',
            'latitude'    => 'required|string',
            'longitude'   => 'required|string',
            'aktivitas'   => 'nullable|array' 
        ]);

        $absen = Absensi::create([
            'user_id'     => Auth::id(),
            'tipe'        => 'Keluar',
            'waktu_absen' => $request->waktu_absen,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'aktivitas'   => $request->aktivitas, 
        ]);

        return response()->json([
            'message' => 'Presensi keluar berhasil dicatat.',
            'data'    => $absen
        ], 201);
    }

    public function mulaiLembur(Request $request)
    {
        $request->validate([
            'waktu_absen' => 'required|date',
            'latitude'    => 'required|string',
            'longitude'   => 'required|string',
            'catatan'     => 'nullable|string'
        ]);

        $absen = Absensi::create([
            'user_id'     => Auth::id(),
            'tipe'        => 'Mulai Lembur',
            'waktu_absen' => $request->waktu_absen,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'catatan'     => $request->catatan,
        ]);

        return response()->json([
            'message' => 'Mulai lembur berhasil dicatat.',
            'data'    => $absen
        ], 201);
    }

    public function selesaiLembur(Request $request)
    {
        $request->validate([
            'waktu_absen' => 'required|date',
            'latitude'    => 'required|string',
            'longitude'   => 'required|string',
            'aktivitas'   => 'nullable|array' 
        ]);

        $absen = Absensi::create([
            'user_id'     => Auth::id(),
            'tipe'        => 'Selesai Lembur',
            'waktu_absen' => $request->waktu_absen,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'aktivitas'   => $request->aktivitas,
        ]);

        return response()->json([
            'message' => 'Selesai lembur berhasil dicatat.',
            'data'    => $absen
        ], 201);
    }

    public function histori(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole(['admin', 'manager'])) {
            $histori = Absensi::with('user:id,name') 
                ->orderBy('waktu_absen', 'desc')
                ->get();
        } else {
            $histori = Absensi::where('user_id', $user->id)
                ->with('user:id,name')
                ->orderBy('waktu_absen', 'desc')
                ->get();
        }

        return response()->json([
            'message' => 'Berhasil mengambil histori absensi.',
            'data'    => $histori
        ], 200);
    }
}