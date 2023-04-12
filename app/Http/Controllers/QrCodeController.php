<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show(Request $request)
    {
        return QrCode::size(300)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-9');
    }
}
