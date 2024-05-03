<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Iten;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Empresa::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Empresa::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Empresa::findOrFail($id);
    }

    public function showFuncionarios(string $id)
    {
        return User::where('empresa_id', $id)->get();
    }

    public function showItens(string $id)
    {
        $empresa = Empresa::find($id);
        if (is_null($empresa)) {
            return 'Empresa não encontrado';
        } else {
            $itens = Iten::where('empresa_id', $id)->get();
            if ($itens->isEmpty()) {
                return 'Empresa não tem itens cadastrados';
            } else {
                return $itens;
            }
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $selectIten = Empresa::findOrFail($id);
        $selectIten->update($request->all());

        return $selectIten;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Empresa::destroy($id);
    }
}
