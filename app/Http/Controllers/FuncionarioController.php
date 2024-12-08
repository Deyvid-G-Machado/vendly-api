<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        return Funcionario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:funcionarios,email',
            'senha' => 'required|string|min:6',
        ]);

        $funcionario = Funcionario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => bcrypt($request->senha),
        ]);

        return response()->json($funcionario, 201);
    }

    public function show($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return response()->json($funcionario);
    }

    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::findOrFail($id);

        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:funcionarios,email,' . $id,
            'senha' => 'sometimes|required|string|min:6',
        ]);

        $funcionario->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $request->senha ? bcrypt($request->senha) : $funcionario->senha,
        ]);

        return response()->json($funcionario);
    }

    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        return response()->json(['message' => 'Funcionário excluído com sucesso.']);
    }
}

