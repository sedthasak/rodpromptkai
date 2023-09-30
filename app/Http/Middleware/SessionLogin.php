<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Sms_session;
use App\Models\Customer;

class SessionLogin
{

    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        function ranInt(){
            $codetosend = random_int(1000000,9999999);
            return $codetosend;
        }

        $browserFingerprint = $request->session()->get('browserFingerprint');
        // $request->session()->put('customer', 'Error');
        if (!$browserFingerprint) {
            do {
                $codetosend = ranInt();
                $exists = Sms_session::where("browserFingerprint", $codetosend)->exists();
            } while ($exists);
            $request->session()->put('browserFingerprint', $codetosend);
            // $request->session()->put('customer', 'empty');
        }
        else{
            $getcustomersession = Sms_session::where([
                ['browserFingerprint', '=', $browserFingerprint],
            ])->first();
            if(isset($getcustomersession->id)){
                $customer = Customer::where("id", $getcustomersession->customer_id)->first();
                $request->session()->put('customer', $customer);
            }
            
        }
        return $next($request);
    }
}
