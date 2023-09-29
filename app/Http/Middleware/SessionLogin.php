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
        $messages = $request->session()->get('messages');
        $customer_session = $request->session()->get('customer_session');
        if (!$messages) {
            $codetosend = rand(100000,999999);
            $request->session()->put('messages', $codetosend);
        }
        if ($customer_session) {
            $gets = Sms_session::where("customer_session", $customer_session)->first();
            $customer_id = $gets->customer_id;
            $getsCUs = Customer::where("id", $customer_id)->first();
            if(isset($getsCUs)){
                $request->session()->put('customer', $getsCUs);
            }
            
        }
        return $next($request);
    }
}
