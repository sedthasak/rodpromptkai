<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionLoginController extends Controller
{
    public function SetSession(Request $request)
    {
        $customer_session = $request->text.$request->phone;
        $request->session()->put('customer_session', $customer_session);

        return "Success";
    }
}
