<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\LogsSaveController;
use App\Models\Sms_session;
use App\Models\Customer;
use App\Models\brandsModel;
use Illuminate\Support\Facades\View;

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
            $codetosend = random_int(100000,999999);
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
        // else{
            // $getcustomersession = Sms_session::where([
            //     ['browserFingerprint', '=', $browserFingerprint],
            // ])->first();
            // if(isset($getcustomersession->id)){
            //     $customer = Customer::where("id", $getcustomersession->customer_id)->first();
            //     $request->session()->put('customer', $customer);
            // }
            
        // }

        $customer_session = $request->session()->get('customer_session');
        if(isset($customer_session)){
            $session = Sms_session::where("customer_session", $customer_session)->first();
            if(isset($session)){
                $customerdata = Customer::where("id", $session->customer_id)->first();
                if(isset($customerdata)){
                    $request->session()->put('customer', $customerdata);
                }
            }
            
        }

        $qrybrand = brandsModel::get();
        View::share('brand', $qrybrand);

        return $next($request);
    }
}
