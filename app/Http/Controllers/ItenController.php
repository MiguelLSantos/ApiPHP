<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iten;
use App\Models\User;

class ItenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Iten::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $credenciais = $user->only(['id', 'empresa_id']);
        $data = $request->all();
        return Iten::create([
            'codigo' => $data['codigo'],
            'nome' => $data['nome'],
            'categoria' => $data['categoria'],
            'descricao' => $data['descricao'],
            'preco' => $data['preco'],
            'qtdunitaria' => $data['qtdunitaria'],
            'user_id' => $credenciais['id'],
            'empresa_id' => $credenciais['empresa_id'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Iten::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $selectIten = Iten::findOrFail($id);
        $selectIten->update($request->all());

        return $selectIten;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Iten::destroy($id);
    }
}
