<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Berhasil mengambil data user',
            'users' => $users
        ], 200);
    }
}