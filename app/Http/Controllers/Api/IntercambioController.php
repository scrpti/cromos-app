<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCromo;
use Illuminate\Http\Request;

class IntercambioController extends Controller
{
    public function show(Request $request, $qr_token)
    {
        $friend = User::where('qr_token', $qr_token)->firstOrFail();
        $me = $request->user();

        $iCanTrade = UserCromo::where('user_id', $me->id)
            ->where('cantidad', '>', 1)
            ->whereNotExists(function ($query) use ($friend) {
                $query->from('user_cromos as uc')
                    ->whereColumn('uc.seleccion', 'user_cromos.seleccion')
                    ->whereColumn('uc.numero', 'user_cromos.numero')
                    ->where('uc.user_id', $friend->id);
            })
            ->get();
        
        $friendCanTrade = UserCromo::where('user_id', $friend->id)
            ->where('cantidad', '>', 1)
            ->whereNotExists(function ($query) use ($me) {
                $query->from('user_cromos as uc')
                    ->whereColumn('uc.seleccion', 'user_cromos.seleccion')
                    ->whereColumn('uc.numero', 'user_cromos.numero')
                    ->where('uc.user_id', $me->id);
            })
            ->get();

        return response()->json([
            'friend' => $friend->name,
            'iCanTrade' => $iCanTrade,
            'friendCanTrade' => $friendCanTrade,
        ]);
    }
}
