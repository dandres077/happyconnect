<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function renewToken()
    {
        // Renovar el token actual
        $newToken = auth()->refresh();

        // Devolver el nuevo token en la respuesta
        return response()->json(['token' => $newToken]);
    }
}
