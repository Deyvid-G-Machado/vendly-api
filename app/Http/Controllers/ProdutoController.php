<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index()
    {
        return Produto::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'imagem' => 'required|image|max:2048', // Limite de 2 MB
        ]);

        $imagemPath = $request->file('imagem')->store('res/produtos-img', 'public');

        $produto = Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
            'imagem' => "/storage/" . $imagemPath,
        ]);

        return response()->json($produto, 201);
    }

    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return response()->json($produto);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'sometimes|required|string',
            'preco' => 'sometimes|required|numeric|min:0',
            'quantidade' => 'sometimes|required|integer|min:0',
            'imagem' => 'sometimes|image|max:2048',
        ]);

        $data = $request->only(['nome', 'descricao', 'preco', 'quantidade']);

        if ($request->hasFile('imagem')) {
            if ($produto->imagem) {
                $oldPath = str_replace('/storage/', 'public/', $produto->imagem);
                Storage::delete($oldPath);
            }

            $imagemPath = $request->file('imagem')->store('res/produtos-img', 'public');
            $data['imagem'] = "/storage/" . $imagemPath;
        }

        $produto->update($data);

        return response()->json($produto);
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        if ($produto->imagem) {
            $oldPath = str_replace('/storage/', 'public/', $produto->imagem);
            Storage::delete($oldPath);
        }

        $produto->delete();

        return response()->json(['message' => 'Produto excluído com sucesso.']);
    }
}
