<?php

namespace App\Http\Controllers;

use App\Models\Iten;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'empresa_id' => $data['empresa_id'],
            'is_gerente' => $data['is_gerente'],
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user =
            User::find($id);
        return response()->json(['user' => $user,], 200);
    }
    public function showItens(string $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return 'Usuário não encontrado';
        } else {
            $itens = Iten::where('user_id', $id)->get();
            if ($itens->isEmpty()) {
                return 'Usuário não tem itens cadastrados';
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
        $user = auth()->user();
        $selectUser = User::findOrFail($id);

        $credenciais = $user->only(['is_gerente']);
        if ($credenciais['is_gerente'] == '0') {
            return response()->json([
                'Erro' => 'Permição negada'
            ], 404);
        } else {
            $selectUser->update($request->all());
            return $selectUser;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userSelected = User::findOrFail($id);
        $credenciaisSelected = $userSelected->only(['id', 'is_gerente']);

        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'Status' => 'Usuário removido com sucesso!',
        ], 200);
    }
}
