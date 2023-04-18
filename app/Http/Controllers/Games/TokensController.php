<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TokenModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class TokensController extends Controller
{
    public function index ()
    {
        $tokens = TokenModel::with('users')->where('status', true)->get();
        // return view('games.index', compact('games'));

        // $games = GameModel::all();
        return response()->json(['tokens' => $tokens], 200);
        // return view('games.index', compact('games'));
    }

    public function store()
    {

        $user = Auth::user(); // Obtiene al usuario actualmente autenticado
        $userId = $user->id; // Obtiene el ID del usuario actualmente autenticado
        $edit_token = Crypt::encryptString(Str::random(6));
        $status = true;
        
        $myModel = new TokenModel;
        $myModel->user_id = $userId;
        $myModel->edit_token = $edit_token;
        $myModel->status = $status;

        $myModel->save();

    }

}
