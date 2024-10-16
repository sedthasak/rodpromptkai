<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaySolutionsController extends Controller
{
    public function createPayment(Request $request)
    {
        $merchantId = '02948897';
        $authKey = 'Bearer AEZUUuvd';
        $apiUrl = 'https://apis.paysolutions.asia/redirect';

        $payload = [
            'merchantid' => $merchantId,
            'orderid' => 'INV' . time(),
            'channel' => 'promptpay',  // Default to PromptPay
            'amount' => '100.00',
            'currency' => 'THB',
            'redirectsuccess' => url('/payment/success'),
            'redirectfail' => url('/payment/fail'),
        ];

        // dd($merchantId, $authKey, $apiUrl, $payload);

        $response = Http::withHeaders([
            'Authorization' => $authKey,
            'Accept' => 'application/json',
        ])->post($apiUrl, $payload);

        if ($response->successful()) {
            return redirect($response->json('paymentUrl'));
        } else {
            return back()->withErrors($response->json('message', 'Failed to create payment link'));
        }
    }

    public function paymentSuccess()
    {
        return view('payment.success');
    }

    public function paymentFail()
    {
        return view('payment.fail');
    }
}
