<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCromo;

class ColeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cromos = UserCromo::where('user_id', $request->user()->id)
            ->orderBy('grupo')
            ->orderBy('seleccion')
            ->orderBy('numero')
            ->get();

        return response()->json($cromos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'grupo' => 'required|string|size:1',
            'seleccion' => 'required|string|max:3',
            'numero' => 'required|integer|min:1',
            'cantidad' => 'integer|min:1',
        ]);

        $cromo = UserCromo::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'seleccion' => strtoupper($request->seleccion),
                'numero' => $request->numero,
            ],
            [
                'grupo' => strtoupper($request->grupo),
                'cantidad' => $request->cantidad ?? 1,
            ]
        );

        return response()->json($cromo, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cromo = UserCromo::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();
        
        $request->validate([
            'cantidad' => 'required|integer|min:0',
        ]);

        $cromo->update(['cantidad' => $request->cantidad]);

        return response()->json($cromo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        UserCromo::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail()
            ->delete();

        return response()->json(['message' => 'Cromo deleted']);
    }

    public function myQr(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'qr_token' => $user->qr_token,
            'url' => url('api/intercambio/' . $user->qr_token),
        ]);
    }
}
