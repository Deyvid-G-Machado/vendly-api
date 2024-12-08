<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return Cliente::with('endereco')->get();
    }

    public function show($id)
    {
        return Cliente::with('endereco')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes',
            'senha' => 'required|string|min:6',
            'cpf' => 'required|string|max:14|unique:clientes',
            'telefone' => 'required|string|max:15',
            'endereco.rua' => 'required|string|max:255',
            'endereco.numero' => 'required|string|max:20',
            'endereco.bairro' => 'required|string|max:255',
            'endereco.cidade' => 'required|string|max:255',
            'endereco.estado' => 'required|string|max:2',
            'endereco.cep' => 'required|string|max:9',
            'endereco.complemento' => 'nullable|string|max:255',
        ]);

        $cliente = Cliente::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'senha' => bcrypt($validated['senha']),
            'cpf' => $validated['cpf'],
            'telefone' => $validated['telefone'],
        ]);

        $cliente->endereco()->create($validated['endereco']);

        return response()->json($cliente->load('endereco'), 201);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:clientes,email,' . $id,
            'senha' => 'sometimes|string|min:6',
            'cpf' => 'sometimes|string|max:14|unique:clientes,cpf,' . $id,
            'telefone' => 'sometimes|string|max:15',
            'endereco.rua' => 'sometimes|string|max:255',
            'endereco.numero' => 'sometimes|string|max:20',
            'endereco.bairro' => 'sometimes|string|max:255',
            'endereco.cidade' => 'sometimes|string|max:255',
            'endereco.estado' => 'sometimes|string|max:2',
            'endereco.cep' => 'sometimes|string|max:9',
            'endereco.complemento' => 'nullable|string|max:255',
        ]);

        $cliente->update($validated);

        if (isset($validated['endereco'])) {
            $cliente->endereco->update($validated['endereco']);
        }

        return response()->json($cliente->load('endereco'));
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->endereco()->delete();
        $cliente->delete();

        return response()->json(null, 204);
    }
}
