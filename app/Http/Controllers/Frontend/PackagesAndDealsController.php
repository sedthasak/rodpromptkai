<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\PackageDealerModel;
use App\Models\VipPackageModel;
use App\Models\DealModel;
use App\Models\OrderModel;
use App\Models\CouponModel;
use App\Models\CouponUse;
use App\Models\Customer;
use App\Models\carsModel;
use App\Models\MyDeal;

use App\Models\Province;
use App\Models\District;
use App\Models\SubDistrict;

class PackagesAndDealsController extends Controller
{
    public function updateMyDeal(Request $request)
    {
        try {
            // Validate request data
            $request->validate([
                'deal_id' => 'required|integer',
                'car_id' => 'required|integer',
            ]);

            $dealId = $request->input('deal_id');
            $carId = $request->input('car_id');

            // Get the car instance by ID
            $myCar = carsModel::find($carId);

            if ($myCar) {
                // Get the existing myDeal for this car
                $myDeal = $myCar->myDeal;

                if ($myDeal) {
                    // Update the existing myDeal with the new deal_id
                    $myDeal->deals_id = $dealId;
                    $myDeal->save();
                } else {
                    // Create a new myDeal if none exists
                    MyDeal::create([
                        'cars_id' => $carId,
                        'deals_id' => $dealId,
                        // Add other fields as necessary
                    ]);
                }

                return response()->json(['success' => true]);
            } else {
                // Debugging: Log this case
                Log::warning('No car found with ID: ' . $carId);
                return response()->json(['success' => false], 404);
            }
        } catch (\Exception $e) {
            // Log detailed error
            Log::error('Error updating MyDeal: ' . $e->getMessage());
            return response()->json(['success' => false], 500);
        }
    }




    public function adddealaction(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'promotion_price' => 'required|numeric|lte:' . $request->current_price,
        ]);

        DB::beginTransaction();
        try {
            $car = carsModel::findOrFail($request->car_id);
            $deal = DealModel::latest('id')->firstOrFail();
            $mydeal = MyDeal::whereNull('cars_id')->orderBy('deal_expire', 'asc')->firstOrFail();
            $mydeal->update([
                'deals_id' => $deal->id,
                'cars_id' => $car->id,
            ]);
            $car->update([
                'mydeals' => $mydeal->id,
                'price' => $request->promotion_price,
                'old_price' => $request->current_price,
            ]);
            DB::commit();

            return redirect()->back()->with('success', 'ราคาถูกปรับเรียบร้อยแล้ว');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'ไม่สามารถปรับราคาได้');
        }
    }





    public function specialselectdealPage(Request $request, $car) 
    {
        $car = carsModel::with(['brand', 'model', 'generation', 'subModel', 'user', 'customer', 'myDeal'])
                ->findOrFail($car);
        $alldeals = DealModel::orderBy('id', 'desc')->get();
        // dd($car);
        return view('frontend.specialselectdeal', [
            'page' => 'special-changedeal',
            'alldeals' => $alldeals,
            'car' => $car,
        ]);
    }
    public function specialchangedealPage(Request $request) 
    {
        // dd($pv);
        $customerdata = session('customer');
        $customer_id = $customerdata->id;
        $results = carsModel::where('status', 'approved')
                    ->whereNotNull('mydeals')
                    ->orderBy('id', 'desc')
                    ->get();
        return view('frontend.specialchangedeal', [
            'page' => 'special-changedeal',
            "results" => $results,
        ]);
    }
    public function specialadddealPage(Request $request) 
    {
        $customerdata = session('customer');
        $customer_id = $customerdata->id;
        $results = carsModel::where('status', 'approved')
                    ->whereNull('mydeals')
                    ->orderBy('id', 'desc')
                    ->get();
        // dd($results);    
        return view('frontend.specialadddeal', [
            'page' => 'special-adddeal',
            "results" => $results,
        ]);
    }
    public function specialdealPage(Request $request) 
    {
        // $cars = carsModel::whereNull('slug')->get();

        // foreach ($cars as $car) {
        //     // Generate unique slug with the post ID and save
        //     $car->slug = $car->generateUniqueSlug($car->id);
        //     $car->save();
        // }
        // dd($pv);
        $alldeals = DealModel::orderBy('id', 'desc')->get();
        return view('frontend.specialdeal', [
            'page' => 'special-deal',
            'alldeals' => $alldeals,
        ]);
    }




    public function applyCouponAction(Request $request)
    {
        $code = $request->input('code');
        $coupon = CouponModel::where('code', $code)
            ->where('status', 'active')
            ->first();

        if ($coupon) {
            if ($coupon->expirecoupon->isFuture()) {
                $limit = $coupon->limit;
                $usedCount = CouponUse::where('coupons_id', $coupon->id)
                    ->count();
                if ($limit !== null && $usedCount >= $limit) {
                    return response()->json(['success' => false, 'message' => 'คูปองนี้ใช้เกินจำนวนที่กำหนดแล้ว']);
                }
                return response()->json([
                    'success' => true,
                    'id' => $coupon->id,
                    'rate' => $coupon->rate,
                    'code' => $coupon->code,
                    'name' => $coupon->name,
                    'limit_rate' => $coupon->limit_rate,
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'คูปองนี้หมดอายุแล้ว']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'ไม่พบคูปอง']);
        }
    }
    public function cartPage(Request $request) {
        $pvs = Province::orderBy('name_th', 'asc')->get();
        $packageId = $request->input('package_id');
        $type = $request->input('type');
        $amount = $request->input('amount');
    
        if ($type == 'package') {
            $item = PackageDealerModel::find($packageId);
        } elseif ($type == 'deal') {
            $item = DealModel::find($packageId);
            $amount = $request->input('amount', 1); // Default to 1 if not provided
        } else {
            $item = null;
        }
    
        return view('frontend/cart', [
            "item" => $item,
            "type" => $type,
            "pvs" => $pvs,
            "amount" => $amount,
        ]);
    }
    

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
            'order_number' => 'ORD-' . uniqid(),
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
        if ($request->type === 'package' && $order->package_dealers_id) {
            $thispackage = PackageDealerModel::find($order->package_dealers_id);
            if ($customer && $thispackage) {
                $customer->update([
                    'role' => 'dealer',
                    'dealerpack_quota' => $thispackage->limit,
                    'dealerpack' => $thispackage->id,
                    'dealerpack_regis' => now(),
                    'dealerpack_expire' => now()->addMonths(4),
                    'accumulate' => $customer->accumulate + $thispackage->price
                ]);
            }
        }

        // Handle deal type
        if ($request->type === 'deal' && $request->amount > 0) {
            for ($lp = 1; $lp <= $request->amount; $lp++) {
                $dealData = [
                    'customer_id' => $request->customer_id,
                    'orders_id' => $order->id,
                    'deal_register' => now(),
                    'deal_expire' => now()->addMonths(1), // Correct expiration calculation
                ];
                MyDeal::create($dealData);
            }
            $customer->update([
                'accumulate' => $customer->accumulate + $order->price
            ]);
        }

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

        return redirect()->route('orderpayPage', ['order' => $order->id]);
    }









    public function orderpayaction(Request $request)
    {
        // dd($request);
        $request->validate([
            'order_id' => 'required|exists:orders,id'
        ]);
        $order = OrderModel::findOrFail($request->order_id);
        $order->update([
            'status' => 'success',
            'payment_method' => 'QrCode',
            'payment_date' => now(),
            'payment_status' => 'success',
        ]);
        if($order->type =='package'){
            return redirect()->route('profilePage')->with('success', 'ทำการสั่งซื้อสำเร็จ !');
        }elseif($order->type =='deal'){
            return redirect()->route('specialdealPage')->with('success', 'ทำการสั่งซื้อสำเร็จ !');
        }   
        
    }




    public function orderpayPage(Request $request, $order) {
        // dd($order);
        $myorder = OrderModel::find($order);
        return view('frontend/orderpay', [
            "myorder" => $myorder,
        ]);
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
    public function cartselectdistrict(Request $request) {

        $ech = '';
        $query = DB::table('geo_districts')->where('province_id', $request->province_id)->get();
        if($query){
            $ech .= '<option value="">กรุณาเลือก</option>';
            foreach($query as $key => $res){
                $ech .= '<option value="'.$res->id.'">'.$res->name_th.'</option>';
            }
        }
        return response()->json($ech);
    }
    public function cartselectsubdistrict(Request $request) {

        $ech = '';
        $query = DB::table('geo_subdistricts')->where('district_id', $request->district_id)->get();
        if($query){
            $ech .= '<option value="">กรุณาเลือก</option>';
            foreach($query as $key => $res){
                $ech .= '<option value="'.$res->id.'">'.$res->name_th.'</option>';
            }
        }
        return response()->json($ech);
    }
    
    
}
