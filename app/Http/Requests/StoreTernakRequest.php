<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTernakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'id_ternak'      => 'required|string|unique:ternaks,id_ternak',
            'nama_ternak'    => 'required|string|max:255',
            'jenis_ternak'   => 'required|string|max:255',
            'jenis_kelamin'  => 'required|string|max:255',
            'no_kandang'     => 'nullable|string|max:255',
            'kepemilikan'    => 'required|string|max:255',
            'user_id'        => 'nullable|string|exists:users,id',
            'asal_usul'      => 'required|string|max:255',
            'harga_beli'     => 'nullable|numeric|min:0',
            'tanggal_lahir'  => 'nullable|date',
            'berat_lahir'    => 'nullable|numeric|min:0',
            'id_induk'       => 'nullable|string',
            'id_pejantan'    => 'nullable|string',
            'tipe_kelahiran' => 'nullable|string|max:255',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'catatan'        => 'nullable|string',
        ];
    }
}