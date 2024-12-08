<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FuncionarioAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        $funcionario = Funcionario::where('email', $request->email)->first();

        if (!$funcionario || !Hash::check($request->senha, $funcionario->senha)) {
            return response()->json(['message' => 'Credenciais inválidas.'], 401);
        }

        $token = $funcionario->createToken('FuncionarioToken')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'user' => $funcionario,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso!'], 200);
    }
}
