<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\OrderModel;
use Illuminate\Support\Facades\{Hash, DB, Log};

class PaySolutionsController extends Controller
{
    public function handlecallback(Request $request)
    {
        // Temporarily disable CSRF protection
        // app()->instance('middleware.disable', true);
    
        // Log the request and respond
        Log::info('Payment Callback Data:', $request->all());
    
        return response()->json([
            'status' => 'success',
            'message' => 'Payment callback received',
            'data' => $request->all()
        ]);
    }
    
    public function handleReturn(Request $request)
    {
        // Optionally, you can log the request for debugging
        Log::info('Return URL request', $request->all());

        // Retrieve the necessary data from the request (if provided by the gateway)
        $status = $request->input('status'); // For example, 'success' or 'fail'
        $referenceNo = $request->input('referenceNo'); // The order reference
        $total = $request->input('total'); // The payment total
        dd($request);
        // Show a message to the user based on the status
        if ($status === 'success') {
            return view('payment.success', ['message' => 'Payment successful', 'referenceNo' => $referenceNo, 'total' => $total]);
        } else {
            return view('payment.fail', ['message' => 'Payment failed, please try again.']);
        }
    }
    public function handlePostBack(Request $request)
    {
        // Log the Post Back request for debugging purposes
        Log::info('Post Back URL request', $request->all());
    
        // Validate the incoming data from the payment gateway (via GET query parameters)
        $validatedData = $request->validate([
            'referenceNo' => 'required|string|max:12', // The order reference number
            'status' => 'required|string', // Payment status: 'success' or 'failed'
            // You can add additional validation for other parameters, e.g., 'amount', 'currency'
        ]);
    
        // Find the order by referenceNo (which maps to the order_number in your database)
        $order = OrderModel::where('order_number', $validatedData['referenceNo'])->first();
    
        if ($order) {
            // Check the payment status and update the order accordingly
            if ($validatedData['status'] === 'success') {
                // Mark the order as paid
                $order->status = 'paid';
            } else {
                // Handle payment failure
                $order->status = 'failed';
            }
    
            // Save the updated order
            $order->save();
    
            // Return a JSON response to acknowledge receipt of the postback
            return response()->json(['message' => 'Order status updated successfully'], 200);
        } else {
            // Log the error if order is not found
            Log::error('Order not found for referenceNo: ' . $validatedData['referenceNo']);
    
            // Return a response indicating the order was not found
            return response()->json(['message' => 'Order not found'], 404);
        }
    }
    
    

    // public function createPayment(Request $request)
    // {
    //     // Validate incoming form data
    //     $validatedData = $request->validate([
    //         'order_id' => 'required|integer|exists:orders,id', // Validate that the order_id exists in the orders table
    //         'paymentChannel' => 'nullable|string', // Payment channel (optional), default will be set to 'PromptPay'
    //     ]);

    //     try {
    //         // Fetch the order and related customer details using Eloquent relationships
    //         $order = OrderModel::with('customer')->findOrFail($validatedData['order_id']);

    //         // Check if the order status is pending before proceeding
    //         if ($order->status !== 'pending') {
    //             return redirect()->route('profilePage')->with('error', 'This order cannot be processed because it is not pending.');
    //         }

    //         // Check if the customer exists for the order
    //         if (!$order->customer) {
    //             return redirect()->route('profilePage')->with('error', 'Customer information not found for this order.');
    //         }

    //         // Use order details and customer details for payment
    //         $total = $order->total;
    //         $referenceNo = $order->order_number; // Use the order number as the reference
    //         $email = $order->customer->email;
    //         $customerName = $order->customer->firstname . ' ' . $order->customer->lastname;

    //         // Set the default payment channel to 'PromptPay' if none is provided
    //         $paymentChannel = $validatedData['paymentChannel'] ?? 'full';

    //         // Load environment variables for the payment API
    //         $MERCHANT_ID = env('PAYSOLUTIONS_MERCHANT_ID');
    //         $AUTH_KEY = env('PAYSOLUTIONS_AUTH_KEY');
    //         $authKey = 'Bearer ' . $AUTH_KEY;

    //         // API URL
    //         // $apiUrl = 'https://apis.paysolutions.asia/tep/api/v2/payment';
    //         $apiUrl = 'https://payments.paysolutions.asia/payment ';

    //         // Payload for the API request
    //         $payload = [
    //             'merchantid' => $MERCHANT_ID,
    //             'refno' => $referenceNo,
    //             'customeremail' => $email,
    //             'productdetail' => 'Payment for Order ' . $referenceNo,
    //             'total' => $total,
    //             'cc' => '00', // For Thai Baht
    //             'channel' => $paymentChannel, // Use default or provided payment channel
                
    //             // 'customerName' => $customerName,
    //             // 'returnURL' => route('payment.callback'), // URL to redirect after successful payment
    //             // 'cancelURL' => route('payment.cancel'),  // URL for payment cancellation
    //         ];

    //         // Log request payload for debugging
    //         Log::info('Payment request payload', $payload);
    //         // dd($payload, $apiUrl, $MERCHANT_ID, $authKey);
    //         // Send API request with headers and payload
    //         $response = Http::withHeaders([
    //             'Authorization' => $authKey,
    //             'Accept' => 'application/json',
    //         ])->post($apiUrl, $payload);

    //         dd($response);
    //         // Handle successful response
    //         if ($response->successful()) {
    //             $responseData = $response->json();
    //             Log::info('Payment response', $responseData);

    //             // Check for necessary keys in the response
    //             if (isset($responseData['data']['orderNo']) && isset($responseData['data']['image'])) {
    //                 // Pass data to the result view and show the QR code image for payment
    //                 return view('payment.result', [
    //                     'orderNo' => $responseData['data']['orderNo'],
    //                     'qrCodeImage' => $responseData['data']['image'], // QR code image for payment (if using PromptPay)
    //                     'total' => $total,
    //                     'referenceNo' => $referenceNo,
    //                 ]);
    //             } else {
    //                 // If response is incomplete, show failure message in result view
    //                 return view('payment.result', [
    //                     'message' => 'Incomplete payment data in response.',
    //                     'orderNo' => $referenceNo,
    //                     'total' => $total,
    //                     'referenceNo' => $referenceNo,
    //                     'qrCodeImage' => null,
    //                 ]);
    //             }
    //         } else {
    //             Log::error('Payment creation failed', [
    //                 'response' => $response->json(),
    //             ]);

    //             // Handle failure in the result view
    //             return view('payment.result', [
    //                 'message' => 'Failed to create payment link. Please try again.',
    //                 'orderNo' => $referenceNo,
    //                 'total' => $total,
    //                 'referenceNo' => $referenceNo,
    //                 'qrCodeImage' => null,
    //             ]);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Payment creation error', [
    //             'error' => $e->getMessage(),
    //         ]);

    //         // Return failure in the result view with error message
    //         return view('payment.result', [
    //             'message' => 'An error occurred while creating the payment. Please try again later.',
    //             'orderNo' => $order->order_number,
    //             'total' => $order->total,
    //             'referenceNo' => $order->order_number,
    //             'qrCodeImage' => null,
    //         ]);
    //     }
    // }





    public function createPayment(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|integer|exists:orders,id', // Validate that the order_id exists in the orders table
        ]);
    
        try {
            $order = OrderModel::with('customer')->findOrFail($validatedData['order_id']);
            if ($order->status !== 'pending') {
                return redirect()->route('profilePage')->with('error', 'This order cannot be processed because it is not pending.');
            }
            if (!$order->customer) {
                return redirect()->route('profilePage')->with('error', 'Customer information not found for this order.');
            }
            $total = $order->total;
            $referenceNo = $order->order_number; // Use the order number as the reference
            $email = $order->customer->email;
            $customerName = $order->customer->firstname . ' ' . $order->customer->lastname;
            $MERCHANT_ID = env('PAYSOLUTIONS_MERCHANT_ID');
            $AUTH_KEY = env('PAYSOLUTIONS_AUTH_KEY');
            $authKey = 'Bearer ' . $AUTH_KEY;
            $apiUrl = 'https://apis.paysolutions.asia/tep/api/v2/promptpaynew';
            $payload = [
                'merchantID' => $MERCHANT_ID,
                'productDetail' => 'Order ' . $referenceNo,
                'customerEmail' => $email,
                'customerName' => $customerName,
                'referenceNo' => $referenceNo,
                'total' => $total,
            ];
            Log::info('Payment request payload', $payload);
            $response = Http::withHeaders([
                'Authorization' => $authKey,
                'Accept' => 'application/json',
            ])->post($apiUrl, $payload);
            if ($response->successful()) {
                $responseData = $response->json();
                Log::info('Payment response', $responseData);
                if (isset($responseData['data']['orderNo']) && isset($responseData['data']['image'])) {
                    return view('payment.result', [
                        'orderNo' => $responseData['data']['orderNo'],
                        'qrCodeImage' => $responseData['data']['image'],
                        'total' => $total,
                        'referenceNo' => $referenceNo,
                    ]);
                } else {
                    return view('payment.result', [
                        'message' => 'Incomplete payment data in response.',
                        'orderNo' => $referenceNo, // Show the order ID for tracking
                        'total' => $total,
                        'referenceNo' => $referenceNo,
                        'qrCodeImage' => null,
                    ]);
                }
            } else {
                Log::error('Payment creation failed', [
                    'response' => $response->json(),
                ]);
                return view('payment.result', [
                    'message' => 'Failed to create payment link. Please try again.',
                    'orderNo' => $referenceNo,
                    'total' => $total,
                    'referenceNo' => $referenceNo,
                    'qrCodeImage' => null,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Payment creation error', [
                'error' => $e->getMessage(),
            ]);
            return view('payment.result', [
                'message' => 'An error occurred while creating the payment. Please try again later.',
                'orderNo' => $order->order_number,
                'total' => $order->total,
                'referenceNo' => $order->order_number,
                'qrCodeImage' => null,
            ]);
        }
    }
    
    
    
    
    
    public function paymentform(Request $request, $order)
    {
        $myorder = OrderModel::with('customer')->find($order);
        if (!$myorder) {
            return redirect()->route('profilePage')->with('error', 'Order not found.');
        }
        return view('payment.form', [
            "myorder" => $myorder,
        ]);
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
