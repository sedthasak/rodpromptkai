<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaySolutionsController extends Controller
{
    public function createPayment(Request $request)
    {
        $merchantId = env('PAYSOLUTIONS_MERCHANT_ID');
        // $merchantId = 12948897;
        $authKey = 'Bearer ' . env('PAYSOLUTIONS_API_KEY');
        // $apiUrl = 'https://apis.paysolutions.asia/redirect';
        // $apiUrl = 'https://payment.paysolutions.asia/epaylink/payment.aspx';
        $apiUrl = 'https://apis.paysolutions.asia/tep/api/v2/promptpay';
        $total = 12.12;
        $referenceNo = 123456789012;

        $payload = [
            'merchantID' => $merchantId,
            'productDetail' => 'productDetail',
            'customerEmail' => 'kk.supernova00@gmail.com',
            'customerName' => 'Kongphop Kamsaikaeo',
            'referenceNo' => $referenceNo,
            'total' => $total,
            // 'orderid' => 'INV' . time(),
            // 'channel' => 'promptpay',  // Default to PromptPay
            // 'currency' => 'THB',
            // 'redirectsuccess' => url('/payment/success'),
            // 'redirectfail' => url('/payment/fail'),
        ];

        // dd($merchantId, $authKey, $apiUrl, $payload);

        $response = Http::withHeaders([
            'Authorization' => $authKey,
            'Accept' => 'application/json',
        ])->post($apiUrl, $payload);

        dd($response);
        if ($response->successful()) {
            dd('successful');
            return redirect($response->json('paymentUrl'));         
        } else {
            dd('not successful');
            return back()->withErrors($response->json('message', 'Failed to create payment link'));
        }
    }

    public function paymentform()
    {
        // $API_KEY = env('PAYSOLUTIONS_API_KEY');
        // $MERCHANT_ID = env('PAYSOLUTIONS_MERCHANT_ID');
        // dd($API_KEY, $MERCHANT_ID);
        return view('payment.form');
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
