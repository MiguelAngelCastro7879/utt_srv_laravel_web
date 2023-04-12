<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeMailer;
use App\Models\Codes\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class VerificationCodeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $encryption_key = env('CRYPT_KEY');
        $codigoLogin = strval(mt_rand(100000, 999999));
        $codigoVerificación = strval(mt_rand(100000, 999999));

        $has_code = VerificationCode::where('user_id', Auth::user()->id)
            ->where('status', true)
            ->get();
        if (count($has_code) == 0) {
            $code_gen = new VerificationCode();
            $code_gen->user_id = Auth::user()->id;
            $code_gen->login_code = Hash::make($codigoLogin);
            $code_gen->login_code_confirmation = Crypt::encryptString($codigoLogin, $encryption_key);
            $code_gen->verify_code = Hash::make($codigoVerificación);
            $code_gen->verify_code_confirmation = Crypt::encryptString($codigoVerificación, $encryption_key);
            $code_gen->save();
        }
        $signed_url = URL::temporarySignedRoute(
            'show_code',
            now()->addMinutes(30),
            Auth::user()->id
        );
        $mail = new VerificationCodeMailer($signed_url);
        Mail::to(Auth::user()->email)
            ->send($mail);

        return view('code.verify_code');
    }

    public function show()
    {
        try {
            $encryption_key = env('CRYPT_KEY');
            $code = VerificationCode::where('user_id', Auth::user()->id)
                ->where('status', true)
                ->first();
            return view('code.show_code', ['code' => Crypt::decryptString($code->verify_code_confirmation, $encryption_key)]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Bad Request"
            ], 400);
        }
    }

    /**
     * Se usa para verificar el codigo en el panel web
     */
    public function validate_code_login(Request $request)
    {
        $login_code = $request->input('login_code');
        $user_codes = VerificationCode::where('user_id', Auth::user()->id)
            ->where('status', true)
            ->get();
        foreach ($user_codes as $codes) {
            if (Hash::check($login_code, $codes->login_code)) {
                $trust_code = VerificationCode::find($codes->id);
                $trust_code->status = false;
                $trust_code->save();
                Session::put('code', $codes->login_code);
                return redirect('dashboard');
            }
        }
        // return redirect('verify/code');
        return redirect('qrcode');
    }

    /**
     * Se usa para verificar el codigo en la app movil
     */
    public function validate_code_application(Request $request)
    {
        $encryption_key = env('CRYPT_KEY');
        $application_code = $request->input('application_code');
        $user_codes = VerificationCode::where('status', true)->get();
        foreach ($user_codes as $codes) {
            if (Hash::check($application_code, $codes->verify_code)) {
                return response()->json([
                    'login_code' => Crypt::decryptString($codes->login_code_confirmation, $encryption_key)
                ], 201);
            }
        }
        return response()->json([
            'message' => "invalid Code"
        ], 406);
    }
}
