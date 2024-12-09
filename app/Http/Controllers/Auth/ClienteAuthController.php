<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ClienteAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        $cliente = Cliente::where('email', $request->email)->first();

        if (!$cliente || !Hash::check($request->senha, $cliente->senha)) {
            return response()->json(['message' => 'Credenciais inválidas.'], 401);
        }

        $token = $cliente->createToken('ClienteToken')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'user' => $cliente,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso!'], 200);
    }
}
