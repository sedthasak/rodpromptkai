<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\OrderModel;
use App\Models\Customer;
use App\Models\CouponModel;
use App\Models\CouponUse;
use App\Models\DealModel;
use App\Models\MyDeal;

use App\Models\PackageDealerModel;
use App\Models\VipPackageModel;
use App\Models\ContactsVipModel;
use App\Models\LevelModel;
use Illuminate\Support\Facades\{Hash, DB, Log};

class PaySolutionsController extends Controller
{
    public function cartactionPage(Request $request)
    {
        // Find customer
        $customer = Customer::find($request->customer_id);

        // Validate coupon if provided
        if ($request->coupons_id) {
            $coupon = CouponModel::find($request->coupons_id);
            if ($coupon) {
                if ($coupon->limit) {
                    $totalUses = CouponUse::where('coupons_id', $coupon->id)->count();
                    if ($totalUses >= $coupon->limit) {
                        return redirect()->route('profilePage')->with('error', 'Coupon use limit exceeded!');
                    }
                }
            }
        }

        // Prepare order data
        $data = [
            'status' => 'pending',
            'order_number' => 'DLR-' . uniqid(),
            'customer_id' => $request->customer_id,
            'type' => $request->type,
            'price' => $request->price,
            'vat' => $request->vat,
            'coupons_id' => $request->coupons_id,
            'coupons_rate' => $request->coupons_rate,
            'coupons' => $request->coupons,
            'discount' => $request->discount,
            'net_price' => $request->total_result,
            'donate' => $request->donate_input > 0,
            'donation' => $request->donate_input,
            'total' => $request->total,
            'accept' => $request->accept,
            'invoiceform' => $request->invoiceform,
            'amount' => $request->type === 'deal' ? $request->amount : null, // Only include if type is 'deal'
        ];

        // Handle type-specific data
        if ($request->type === 'package') {
            $data['package_dealers_id'] = $request->package_dealers_id;
        }

        // Handle invoice form
        switch ($request->invoiceform) {
            case 'full_receipt':
                $data['full_receipt'] = true;
                $data = array_merge($data, $request->person_type === 'individual'
                    ? $request->only([
                        'individual_name', 'individual_taxidno', 'individual_telephone', 'individual_email',
                        'individual_address', 'individual_province', 'individual_district', 'individual_subdistrict', 'individual_zipcode'
                    ])
                    : $request->only([
                        'corporation_name', 'corporation_taxidno', 'corporation_branchid', 'corporation_telephone',
                        'corporation_email', 'corporation_address', 'corporation_province', 'corporation_district', 'corporation_subdistrict', 'corporation_zipcode'
                    ])
                );
                $data['person_type'] = $request->person_type ?? 'individual';
                break;

            case 'short_receipt':
                $data['short_receipt'] = true;
                $data = array_merge($data, $request->only([
                    'short_name', 'short_telephone', 'short_email', 'short_address', 'short_province',
                    'short_district', 'short_subdistrict', 'short_zipcode'
                ]));
                break;

            case 'no_receipt':
                $data['no_receipt'] = true;
                break;
        }

        // Create order
        $order = OrderModel::create($data);

        // Handle package type
        // if ($request->type === 'package' && $order->package_dealers_id) {
        //     $thispackage = PackageDealerModel::find($order->package_dealers_id);
        //     if ($customer && $thispackage) {
        //         $customer->update([
        //             'role' => 'dealer',
        //             'dealerpack_quota' => $thispackage->limit,
        //             'dealerpack' => $thispackage->id,
        //             'dealerpack_regis' => now(),
        //             'dealerpack_expire' => now()->addMonths(4),
        //             'accumulate' => $customer->accumulate + $thispackage->price,
        //             'order_id' => $order->id,
        //         ]);
        //     }
        // }

        // Handle deal type
        // if ($request->type === 'deal' && $request->amount > 0) {
        //     for ($lp = 1; $lp <= $request->amount; $lp++) {
        //         $dealData = [
        //             'customer_id' => $request->customer_id,
        //             'orders_id' => $order->id,
        //             'deal_register' => now(),
        //             'deal_expire' => now()->addMonths(1), // Correct expiration calculation
        //         ];
        //         MyDeal::create($dealData);
        //     }
        //     $customer->update([
        //         'accumulate' => $customer->accumulate + $order->price
        //     ]);
        // }

        // Save coupon usage history
        if ($request->coupons_id) {
            $coupon = CouponModel::find($request->coupons_id);
            if ($coupon) {
                CouponUse::create([
                    'coupons_id' => $coupon->id,
                    'name' => $coupon->name,
                    'code' => $coupon->code,
                    'rate' => $coupon->rate,
                    'limit_rate' => $coupon->limit_rate,
                    'orders_id' => $order->id,
                    'total' => $request->total,
                    'discount' => $request->discount,
                ]);
            }
        }

        return redirect()->route('payment.form', ['order' => $order->id]);
        // return redirect()->route('paymentform', ['order' => $order->id]);
    }






















    // public function handlePostBack(Request $request)
    // {

    //     // Log::info('Request method: ' . $request->method());
    //     // Log::info('Request data: ', $request->all());
        
    //     // return response()->json([
    //     //     'message' => 'Payment processed successfully',
    //     //     'data' => $request->all()
    //     // ]);

    //     // Log the Post Back request for debugging purposes
    //     Log::info('Post Back request received', ['data' => $request->all()]);
    
    //     // Ensure that the request is a POST request
    //     if (!$request->isMethod('post')) {
    //         Log::warning('Invalid request method. Expected POST but received ' . $request->method());
    //         return response()->json(['message' => 'Invalid request method, POST expected'], 405); // Method Not Allowed
    //     }
    
    //     // Log the request method and all incoming data for debugging
    //     // Log::info('Request method: ' . $request->method());
    //     // Log::info('Request data: ', $request->all());
    
    //     // Validate incoming data from the payment gateway
    //     $validatedData = $request->validate([
    //         'refno' => 'required|string|max:12', // Validate the 12-digit reference number
    //         'status' => 'required|string',       // Validate the status
    //     ]);
    
    //     // Extract the order ID from the 12-digit reference number (remove leading zeros)
    //     $orderId = ltrim($validatedData['refno'], '0'); // Remove leading zeros to get the actual order ID
    
    //     // Find the order by the order ID
    //     $order = OrderModel::find($orderId);
    
    //     if ($order) {
    //         // Map the payment status to your system's order statuses
    //         switch ($validatedData['status']) {
    //             case 'success': 
    //             case 'CP': // Assuming 'CP' means 'Completed Payment'
    //                 $order->status = 'paid'; // Update the order status to 'paid'
    //                 $order->save();
    //                 break;
    //             case 'failed':
    //             case 'FL': // Assuming 'FL' means 'Failed Payment'
    //                 $order->status = 'failed'; // Update the order status to 'failed'
    //                 $order->save();
    //                 break;
    //             default:
    //                 Log::warning('Unknown payment status received', ['status' => $validatedData['status']]);
    //                 return response()->json(['message' => 'Unknown payment status'], 400); // Bad Request
    //         }
    
    //         // Save the updated order status
    //         // $order->save();
    
    //         // Log the successful order update
    //         Log::info('Order updated successfully', ['order_id' => $order->id, 'status' => $order->status]);
    
    //         // Return a success response
    //         // return response()->json(['message' => 'Order status updated successfully'], 200); // OK
    //         return redirect()->route('profilePage')->with('success', 'ทำการสั่งซื้อสำเร็จ !');
    //     } else {
    //         // Log an error if the order was not found
    //         Log::error('Order not found for referenceNo: ' . $validatedData['refno']);
    //         // return response()->json(['message' => 'Order not found'], 404); // Not Found
    //         return redirect()->route('profilePage')->with('error', 'ชำระเงินล้มเหลว !');
    //     }
    // }


    public function handlePostBack(Request $request)
    {
        Log::info('Post Back request received', ['data' => $request->all()]);
    
        if (!$request->isMethod('post')) {
            Log::warning('Invalid request method. Expected POST but received ' . $request->method());
            return response()->json(['message' => 'Invalid request method, POST expected'], 405);
        }
    
        $validatedData = $request->validate([
            'refno' => 'required|string|max:12',
            'status' => 'required|string',
        ]);
    
        $orderId = ltrim($validatedData['refno'], '0');
        $order = OrderModel::find($orderId);
    
        if ($order) {
            switch ($validatedData['status']) {
                case 'success': 
                case 'CP':
                    $order->status = 'paid';
                    $order->save();
    
                    // Handle package type
                    if ($order->type === 'package' && $order->package_dealers_id) {
                        $thispackage = PackageDealerModel::find($order->package_dealers_id);
                        $customer = $order->customer;
                        if ($customer && $thispackage) {
                            $customer->update([
                                'role' => 'dealer',
                                'dealerpack_quota' => $thispackage->limit,
                                'dealerpack' => $thispackage->id,
                                'dealerpack_regis' => now(),
                                'dealerpack_expire' => now()->addMonths(4),
                                'accumulate' => $customer->accumulate + $thispackage->price,
                                'order_id' => $order->id,
                            ]);
                        }
                    }
    
                    // Handle deal type
                    if ($order->type === 'deal' && $order->amount > 0) {
                        for ($lp = 1; $lp <= $order->amount; $lp++) {
                            MyDeal::create([
                                'customer_id' => $order->customer_id,
                                'orders_id' => $order->id,
                                'deal_register' => now(),
                                'deal_expire' => now()->addMonths(1),
                            ]);
                        }
                        $order->customer->update([
                            'accumulate' => $order->customer->accumulate + $order->price,
                        ]);
                    }
    
                    return redirect()->route('profilePage')->with('success', 'ทำการสั่งซื้อสำเร็จ !');
    
                case 'failed':
                case 'FL':
                    $order->status = 'failed';
                    $order->save();
                    break;
    
                default:
                    Log::warning('Unknown payment status received', ['status' => $validatedData['status']]);
                    return response()->json(['message' => 'Unknown payment status'], 400);
            }
    
            return redirect()->route('profilePage')->with('error', 'ชำระเงินล้มเหลว !');
        } else {
            Log::error('Order not found for referenceNo: ' . $validatedData['refno']);
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

    
    public function handleReturn(Request $request)
    {
        // Optionally, you can log the request for debugging
        Log::info('Return URL request', $request->all());

        // Retrieve the necessary data from the request (if provided by the gateway)
        $status = $request->input('status'); // For example, 'success' or 'fail'
        $referenceNo = $request->input('referenceNo'); // The order reference
        $total = $request->input('total'); // The payment total
        // dd($request);
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
