<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTernakRequest;
use App\Models\Ternak;

class TernakController extends Controller
{
    public function index()
    {
        $ternak = Ternak::orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Berhasil mengambil data ternak',
            'data' => $ternak
        ], 200);
    }

    public function store(StoreTernakRequest $request)
    {
        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('ternak', 'public');
            $data['foto'] = $path;
        }

        $ternak = Ternak::create($data);

        return response()->json([
            'message' => 'Data ternak berhasil ditambahkan',
            'data' => $ternak
        ], 201);
    }

    public function show($id)
    {
        $ternak = Ternak::with(['perawatan' => function ($query) {
            $query->orderBy('tanggal_tindakan', 'desc');
        }])->find($id);

        if (!$ternak) {
            return response()->json([
                'message' => 'Data ternak tidak ditemukan'
            ], 404);
        }

        if ($ternak->foto) {
            $ternak->foto_url = asset('storage/' . $ternak->foto);
        }

        return response()->json([
            'message' => 'Detail data ternak berhasil diambil',
            'data' => $ternak
        ], 200);
    }
}