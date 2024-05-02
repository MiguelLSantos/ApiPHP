<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iten;

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
    public function store(Request $request)
    {
        return Iten::create($request->all());
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