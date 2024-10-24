<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\OrderModel;
use Illuminate\Support\Facades\{Hash, DB, Log};

class PaySolutionsController extends Controller
{

    public function handlePostBack(Request $request)
    {

        // Log::info('Request method: ' . $request->method());
        // Log::info('Request data: ', $request->all());
        
        // return response()->json([
        //     'message' => 'Payment processed successfully',
        //     'data' => $request->all()
        // ]);

        // Log the Post Back request for debugging purposes
        Log::info('Post Back request received', ['data' => $request->all()]);
    
        // Ensure that the request is a POST request
        if (!$request->isMethod('post')) {
            Log::warning('Invalid request method. Expected POST but received ' . $request->method());
            return response()->json(['message' => 'Invalid request method, POST expected'], 405); // Method Not Allowed
        }
    
        // Log the request method and all incoming data for debugging
        Log::info('Request method: ' . $request->method());
        Log::info('Request data: ', $request->all());
    
        // Validate incoming data from the payment gateway
        $validatedData = $request->validate([
            'refno' => 'required|string|max:12', // Validate the 12-digit reference number
            'status' => 'required|string',       // Validate the status
        ]);
    
        // Extract the order ID from the 12-digit reference number (remove leading zeros)
        $orderId = ltrim($validatedData['refno'], '0'); // Remove leading zeros to get the actual order ID
    
        // Find the order by the order ID
        $order = OrderModel::find($orderId);
    
        if ($order) {
            // Map the payment status to your system's order statuses
            switch ($validatedData['status']) {
                case 'success': 
                case 'CP': // Assuming 'CP' means 'Completed Payment'
                    $order->status = 'paid'; // Update the order status to 'paid'
                    break;
                case 'failed':
                case 'FL': // Assuming 'FL' means 'Failed Payment'
                    $order->status = 'failed'; // Update the order status to 'failed'
                    break;
                default:
                    Log::warning('Unknown payment status received', ['status' => $validatedData['status']]);
                    return response()->json(['message' => 'Unknown payment status'], 400); // Bad Request
            }
    
            // Save the updated order status
            $order->save();
    
            // Log the successful order update
            Log::info('Order updated successfully', ['order_id' => $order->id, 'status' => $order->status]);
    
            // Return a success response
            // return response()->json(['message' => 'Order status updated successfully'], 200); // OK
            return redirect()->route('profilePage')->with('success', 'ทำการสั่งซื้อสำเร็จ !');
        } else {
            // Log an error if the order was not found
            Log::error('Order not found for referenceNo: ' . $validatedData['refno']);
            // return response()->json(['message' => 'Order not found'], 404); // Not Found
            return redirect()->route('profilePage')->with('error', 'ชำระเงินล้มเหลว !');
        }
    }
    
    

    public function handleBack(Request $request)
    {
        Log::info('Request method: ' . $request->method());
        Log::info('Request data: ', $request->all());
        
        return response()->json([
            'message' => 'Payment processed successfully',
            'data' => $request->all()
        ]);
    }

    public function handlePostBacktest(Request $request)
    {
        // Log the request data for debugging
        Log::info('Postback request received', $request->query());
    
        // Check if the required query parameters are present
        if ($request->has(['order_id', 'amount', 'status', 'transaction_id'])) {
            return response()->json([
                'success' => true,
                'message' => 'Postback received successfully',
                'data' => $request->query()
            ]);
        }
    
        // Return an error response if required fields are missing
        return response()->json([
            'success' => false,
            'message' => 'Invalid postback data',
        ], 400);
    }



    // public function handlePostBack(Request $request)
    // {
    //     // Log the Post Back request for debugging purposes
    //     Log::info('Post Back URL request', $request->all());
    
    //     // Validate the incoming data from the payment gateway (via GET query parameters)
    //     $validatedData = $request->validate([
    //         'referenceNo' => 'required|string|max:12', // The order reference number
    //         'status' => 'required|string', // Payment status: 'success' or 'failed'
    //         // You can add additional validation for other parameters, e.g., 'amount', 'currency'
    //     ]);
    
    //     // Find the order by referenceNo (which maps to the order_number in your database)
    //     $order = OrderModel::where('order_number', $validatedData['referenceNo'])->first();
    
    //     if ($order) {
    //         // Check the payment status and update the order accordingly
    //         if ($validatedData['status'] === 'success') {
    //             // Mark the order as paid
    //             $order->status = 'paid';
    //         } else {
    //             // Handle payment failure
    //             $order->status = 'failed';
    //         }
    
    //         // Save the updated order
    //         $order->save();
    
    //         // Return a JSON response to acknowledge receipt of the postback
    //         return response()->json(['message' => 'Order status updated successfully'], 200);
    //     } else {
    //         // Log the error if order is not found
    //         Log::error('Order not found for referenceNo: ' . $validatedData['referenceNo']);
    
    //         // Return a response indicating the order was not found
    //         return response()->json(['message' => 'Order not found'], 404);
    //     }
    // }
    
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
    


    public function createPayment(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'channel' => 'required|string',
        ]);
    
        try {
            // Retrieve order details
            $order = OrderModel::with('customer')->findOrFail($validatedData['order_id']);
            
            if ($order->status !== 'pending') {
                return redirect()->route('profilePage')->with('error', 'This order cannot be processed because it is not pending.');
            }
    
            if (!$order->customer) {
                return redirect()->route('profilePage')->with('error', 'Customer information not found for this order.');
            }
    
            // Prepare data for the Paysolutions API request
            $total = $order->total;
            $referenceNo = str_pad($order->id, 12, '0', STR_PAD_LEFT); // Generate 12-digit reference number
            // $referenceNo = $order->order_number; // Use the order number as the reference
            $customerEmail = $order->customer->email;
            $customerName = $order->customer->firstname . ' ' . $order->customer->lastname;
            $merchantID = env('PAYSOLUTIONS_MERCHANT_ID');
            $currencyCode = '00';  // Default currency code for THB (Baht)
            $lang = 'TH';           // Default language
            $channel = $validatedData['channel']; // Payment channel selected by user
    
            // Redirect to a view with auto-submit form
            return view('payment.auto_submit', compact('customerEmail', 'customerName', 'referenceNo', 'merchantID', 'currencyCode', 'total', 'lang', 'channel'));
        } catch (\Exception $e) {
            Log::error('Payment creation error', [
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('profilePage')->with('error', 'An error occurred while creating the payment. Please try again later.');
        }
    }
    
    






    // public function createPayment(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'order_id' => 'required|integer|exists:orders,id', // Validate that the order_id exists in the orders table
    //     ]);

    //     try {
    //         $order = OrderModel::with('customer')->findOrFail($validatedData['order_id']);
            
    //         if ($order->status !== 'pending') {
    //             return redirect()->route('profilePage')->with('error', 'This order cannot be processed because it is not pending.');
    //         }

    //         if (!$order->customer) {
    //             return redirect()->route('profilePage')->with('error', 'Customer information not found for this order.');
    //         }

    //         // Prepare data for the Paysolutions API request
    //         $total = $order->total;
    //         $referenceNo = $order->order_number; // Use the order number as the reference
    //         $customerEmail = $order->customer->email;
    //         $customerName = $order->customer->firstname . ' ' . $order->customer->lastname;
    //         $merchantID = env('PAYSOLUTIONS_MERCHANT_ID');
    //         $currencyCode = '00';  // Default currency code for THB (Baht)
    //         $lang = 'TH';           // Default language
    //         $channel = 'promptpay';  // Default payment channel

    //         // Build payload to send to Paysolutions API
    //         $payload = [
    //             'customeremail'  => $customerEmail,
    //             'productdetail'  => 'Order ' . $referenceNo,
    //             'refno'          => $referenceNo,
    //             'merchantid'     => $merchantID,
    //             'cc'             => $currencyCode,
    //             'total'          => $total,
    //             'lang'           => $lang,
    //             'channel'        => $channel,
    //         ];

    //         // dd($response, $payload);
    //         // Send the request to Paysolutions API
    //         $response = Http::post('https://payments.paysolutions.asia/payment', $payload);

    //         // dd($response);

    //         if ($response->successful()) {
    //             // Handle successful response
    //             return redirect()->route('profilePage')->with('success', 'Payment request sent successfully.');
    //         } else {
    //             // Log error response and handle failure
    //             Log::error('Payment request failed', ['response' => $response->json()]);
    //             return redirect()->route('profilePage')->with('error', 'Failed to create payment link. Please try again.');
    //         }

    //     } catch (\Exception $e) {
    //         Log::error('Payment creation error', [
    //             'error' => $e->getMessage(),
    //         ]);
    //         return redirect()->route('profilePage')->with('error', 'An error occurred while creating the payment. Please try again later.');
    //     }
    // }






    // public function createPayment(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'order_id' => 'required|integer|exists:orders,id', // Validate that the order_id exists in the orders table
    //     ]);
    
    //     try {
    //         $order = OrderModel::with('customer')->findOrFail($validatedData['order_id']);
    //         if ($order->status !== 'pending') {
    //             return redirect()->route('profilePage')->with('error', 'This order cannot be processed because it is not pending.');
    //         }
    //         if (!$order->customer) {
    //             return redirect()->route('profilePage')->with('error', 'Customer information not found for this order.');
    //         }
    //         $total = $order->total;
    //         $referenceNo = $order->order_number; // Use the order number as the reference
    //         $email = $order->customer->email;
    //         $customerName = $order->customer->firstname . ' ' . $order->customer->lastname;
    //         $MERCHANT_ID = env('PAYSOLUTIONS_MERCHANT_ID');
    //         $AUTH_KEY = env('PAYSOLUTIONS_AUTH_KEY');
    //         $authKey = 'Bearer ' . $AUTH_KEY;
    //         $apiUrl = 'https://apis.paysolutions.asia/tep/api/v2/promptpaynew';
    //         $payload = [
    //             'merchantID' => $MERCHANT_ID,
    //             'productDetail' => 'Order ' . $referenceNo,
    //             'customerEmail' => $email,
    //             'customerName' => $customerName,
    //             'referenceNo' => $referenceNo,
    //             'total' => $total,
    //         ];
    //         Log::info('Payment request payload', $payload);
    //         $response = Http::withHeaders([
    //             'Authorization' => $authKey,
    //             'Accept' => 'application/json',
    //         ])->post($apiUrl, $payload);
    //         if ($response->successful()) {
    //             $responseData = $response->json();
    //             Log::info('Payment response', $responseData);
    //             if (isset($responseData['data']['orderNo']) && isset($responseData['data']['image'])) {
    //                 return view('payment.result', [
    //                     'orderNo' => $responseData['data']['orderNo'],
    //                     'qrCodeImage' => $responseData['data']['image'],
    //                     'total' => $total,
    //                     'referenceNo' => $referenceNo,
    //                 ]);
    //             } else {
    //                 return view('payment.result', [
    //                     'message' => 'Incomplete payment data in response.',
    //                     'orderNo' => $referenceNo, // Show the order ID for tracking
    //                     'total' => $total,
    //                     'referenceNo' => $referenceNo,
    //                     'qrCodeImage' => null,
    //                 ]);
    //             }
    //         } else {
    //             Log::error('Payment creation failed', [
    //                 'response' => $response->json(),
    //             ]);
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
    //         return view('payment.result', [
    //             'message' => 'An error occurred while creating the payment. Please try again later.',
    //             'orderNo' => $order->order_number,
    //             'total' => $order->total,
    //             'referenceNo' => $order->order_number,
    //             'qrCodeImage' => null,
    //         ]);
    //     }
    // }
    
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
