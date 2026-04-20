<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PengajuanLibur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanLiburController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole(['admin', 'manager'])) {
            $data = PengajuanLibur::with('user:id,name')->orderBy('created_at', 'desc')->get();
        } else {
            $data = PengajuanLibur::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }

        return response()->json(['data' => $data], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'Menunggu Persetujuan';

        $validated['catatan'] = $validated['catatan'] ?? '-';

        $pengajuan = PengajuanLibur::create($validated);
        
        return response()->json(['message' => 'Pengajuan berhasil dikirim', 'data' => $pengajuan], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak'
        ]);

        $pengajuan = PengajuanLibur::findOrFail($id);
        $pengajuan->update(['status' => $request->status]);

        return response()->json(['message' => 'Status berhasil diperbarui', 'data' => $pengajuan], 200);
    }
}