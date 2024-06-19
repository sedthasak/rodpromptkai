<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\PackageDealerModel;
use App\Models\DealModel;
use App\Models\OrderModel;
use App\Models\CouponModel;

class PackagesAndDealsController extends Controller
{
    public function applyCouponAction(Request $request)
    {
        $code = $request->input('code');

        $coupon = CouponModel::where('code', $code)->where('status', 'active')->first();

        // if ($coupon && $coupon->expire->isFuture()) {
        if ($coupon) {
            return response()->json([
                'success' => true,
                'coupon_id' => $coupon->id,
                'rate' => $coupon->rate,
                'name' => $coupon->name,
                'limit_rate' => $coupon->limit_rate,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'โค้ดส่วนลดไม่สามารถใช้งานได้']);
    }
    public function cartPage(Request $request) {
        $packageId = $request->input('package_id');
        $type = $request->input('type');
        
        if ($type == 'package') {
            $item = PackageDealerModel::find($packageId);
        } elseif ($type == 'deal') {
            $item = DealModel::find($packageId);
        } else {
            $item = null;
        }
        return view('frontend/cart', [
            "item" => $item,
            "type" => $type,
        ]);
    }


    public function cartactionPage(Request $request)
    {
        // Extract data from the request
        $data = $request->only([
            'customer_id',
            'type',
            'package_dealers_id',
            'price',
            'vat',
            'net_price',
            'total',
            'accept'
        ]);

        // Set default status and generate order number
        $data['status'] = 'pending';
        $data['order_number'] = 'ORD-' . Str::uuid(); // Using UUID to generate a unique order number

        // Create a new OrderModel instance
        $order = new OrderModel();

        // Fill the order instance with data
        $order->fill($data);

        // Save the order to the database
        $order->save();

        // Optionally, return a response or redirect
        return redirect()->route('profilePage')->with('success', 'Order placed successfully.');
    }



    public function packagePage(Request $request) {
        // return dd($request->yearhigh);
        $pack1 = PackageDealerModel::find(1);
        $pack2 = PackageDealerModel::find(2);
        $pack3 = PackageDealerModel::find(3);

        return view('frontend/package', [
            "pack1" => $pack1,
            "pack2" => $pack2,
            "pack3" => $pack3,
        ]);
    }

    
    
}
