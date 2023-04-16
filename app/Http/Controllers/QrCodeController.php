<?php

namespace App\Http\Controllers;

use App\Events\QrScannerEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show(Request $request)
    {
        $signed_url = URL::signedRoute('qr_verified', Auth::user()->id);
        
        return view('qrcode.show_qrcode', ['qr_code' => QrCode::size(300)->generate($signed_url), 'url'=>$signed_url]) ;
    }
    
    public function qr_verified(Request $request)
    {
        $user = $request->user();
        event(new QrScannerEvent($user));
        return 'fired';
        # code...
    }
}
