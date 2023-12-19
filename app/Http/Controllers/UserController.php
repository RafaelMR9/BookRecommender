<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userHistory($userId)
    {
        $user = User::with('ratings.book')->find($userId);

        if (!$user)
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        return response()->json($user->ratings);
    }

    public function userPreferences(Request $request)
    {
        $user = auth()->user();
        $user->preferences = $request->get('preferences');
        $user->save();
        return response()->json(['message' => 'Preferencias atualizadas com sucesso!']);
    }
}
