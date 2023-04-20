<?php

namespace App\Http\Controllers;

use App\Mail\UpdateCodeMailer;
use App\Models\GamesCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class GamesCodesController extends Controller
{
    public function send_update(Request $request)
    {
        $encryption_key = env('CRYPT_KEY');
        $code = GamesCodes::where('id',$request->id)->with('user')->first();
        $code->status = 1;
        $code->codigo = Crypt::encryptString(strval(mt_rand(10000000, 99999999)), $encryption_key);
        $code->save();
        
        $signed_url = URL::signedRoute(
            'show_code_user',
            $code->user->id
        );
        
        $mail = new UpdateCodeMailer($signed_url);
        Mail::to($code->user->email)
            ->send($mail);
        return redirect($code->url);
    }

    public function show(Request $request){
        $codigos = GamesCodes::where('status', 0)->with('user')->get();
        return view('code.update_code', ['data'=>$codigos]);
    }
    
    public function show_code()
    {
        try {
            $encryption_key = env('CRYPT_KEY');
            $code = GamesCodes::where('user_id', Auth::user()->id)
                ->where('status', 1)
                ->first();
            // return $code;
            return view('code.show_update_code', ['code' => Crypt::decryptString($code->codigo, $encryption_key)]);
        } catch (\Throwable $th) {
            return view('code.show_update_code', ['code' => false]);
        }
    }
    public function token_update_sent(Request $request)
    {
        $encryption_key = env('CRYPT_KEY');
        $codes = GamesCodes::where('status', 1)->get();
        foreach ($codes as $code) {
            if($request->upd_token ==  Crypt::decryptString($code->codigo, $encryption_key)){
                Session::put('codigo_juego', $code->codigo);
                return redirect('Actualizar/'.Session::get('url-game')); 
            }
        }
        return back();
    }

    /*
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°*/
    
    public function send_destroy(Request $request)
    {
        $encryption_key = env('CRYPT_KEY');
        $code = GamesCodes::where('id',$request->id)->with('user')->first();
        $code->status = 2;
        $code->codigo = Crypt::encryptString(strval(mt_rand(10000000, 99999999)), $encryption_key);
        $code->save();
        
        $signed_url = URL::signedRoute(
            'show_code_user',
            $code->user->id
        );
        
        $mail = new UpdateCodeMailer($signed_url);
        Mail::to($code->user->email)
            ->send($mail);
        return redirect($code->url);
    }

    public function show_destroy(Request $request){
        $codigos = GamesCodes::where('status', 0)->with('user')->get();
        return view('code.update_code', ['data'=>$codigos]);
    }
    
    public function show_code_destroy()
    {
        try {
            $encryption_key = env('CRYPT_KEY');
            $code = GamesCodes::where('user_id', Auth::user()->id)
                ->where('status', 1)
                ->first();
            // return $code;
            return view('code.show_update_code', ['code' => Crypt::decryptString($code->codigo, $encryption_key)]);
        } catch (\Throwable $th) {
            return view('code.show_update_code', ['code' => false]);
        }
    }
    public function token_destroy_sent(Request $request)
    {
        $encryption_key = env('CRYPT_KEY');
        $codes = GamesCodes::where('status', 2)->get();
        foreach ($codes as $code) {
            if($request->upd_token ==  Crypt::decryptString($code->codigo, $encryption_key)){
                Session::put('codigo_eliminacion', $code->codigo);
                return redirect('delete/games/'.Session::get('url-game')); 
            }
        }
        return back();
    }
}
