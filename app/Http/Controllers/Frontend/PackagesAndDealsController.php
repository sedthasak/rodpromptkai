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

use App\Models\LevelModel;

class PackagesAndDealsController extends Controller
{

    public function yourpackagePage(Request $request)
    {
        
        return view('frontend.yourpackage', [
            "page" => 'yourpackage',
        ]);
    }

    public function packagecontactPage(Request $request)
    {
        return view('frontend.package-contact', [
            "page" => 'getcoupon',
        ]);
    }
    public function getcouponPage(Request $request) 
    {
        $customerdata = session('customer');
        $customer_id = $customerdata->id;
        $customer_login = Customer::find($customerdata->id);
        $levels = LevelModel::orderBy('accumulate', 'asc')->get();
        $customerAccumulate = $customer_login->accumulate;
        $customer_level = [
            'accumulate' => $customerAccumulate ? $customerAccumulate : 0,
            'level' => 'member',
            'slug' => 'member',
            'id' => null,
        ];
    
        foreach ($levels as $level) {
            if ($customerAccumulate >= $level->accumulate) {
                $customer_level['level'] = $level->name;
                $customer_level['slug'] = $level->slug;
                $customer_level['id'] = $level->id;
            } else {
                break;
            }
        }
    
        $currentDateTime = now();
    
        $allcoupon = CouponModel::where('status', 'active')
                                ->whereNull('level_member')
                                ->where(function ($query) use ($currentDateTime) {
                                    $query->where(function ($query) use ($currentDateTime) {
                                        $query->where('have_expire', 1)
                                              ->where('expirecoupon', '>=', $currentDateTime);
                                    })->orWhere('have_expire', 0);
                                })
                                ->get();
    
        $levelCoupons = CouponModel::where('status', 'active')
                                   ->where('level_member', $customer_level['id'])
                                   ->where(function ($query) use ($currentDateTime) {
                                       $query->where(function ($query) use ($currentDateTime) {
                                           $query->where('have_expire', 1)
                                                 ->where('expirecoupon', '>=', $currentDateTime);
                                       })->orWhere('have_expire', 0);
                                   })
                                   ->get();
    
        foreach ($allcoupon as $coupon) {
            $coupon->usage = 'normal';
    
            if ($coupon->limit) {
                $couponUsageCount = CouponUse::where('coupons_id', $coupon->id)->count();
                if ($couponUsageCount >= $coupon->limit) {
                    $coupon->usage = 'gone';
                }
            }
    
            $couponUsedByCustomer = CouponUse::where('coupons_id', $coupon->id)
                                             ->whereHas('order', function ($query) use ($customer_id) {
                                                 $query->where('customer_id', $customer_id);
                                             })
                                             ->exists();
            if ($couponUsedByCustomer) {
                $coupon->usage = 'used';
            }
        }
    
        foreach ($levelCoupons as $coupon) {
            $coupon->usage = 'normal';
    
            if ($coupon->limit) {
                $couponUsageCount = CouponUse::where('coupons_id', $coupon->id)->count();
                if ($couponUsageCount >= $coupon->limit) {
                    $coupon->usage = 'gone';
                }
            }
    
            $couponUsedByCustomer = CouponUse::where('coupons_id', $coupon->id)
                                             ->whereHas('order', function ($query) use ($customer_id) {
                                                 $query->where('customer_id', $customer_id);
                                             })
                                             ->exists();
            if ($couponUsedByCustomer) {
                $coupon->usage = 'used';
            }
        }
    
        return view('frontend.getcoupon', [
            "page" => 'getcoupon',
            "allcoupon" => $allcoupon,
            "levelCoupons" => $levelCoupons,
        ]);
    }
    
    
    
    
    





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



    public function adddealgroupaction(Request $request)
    {
        $request->validate([
            'car_ids' => 'required|string'
        ]);
    
        $customerdata = session('customer');
        $customer_id = $customerdata->id;
    
        $carIds = explode(',', $request->car_ids);
    
        if (empty($carIds)) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลรถที่เลือก !');
        }
    
        $deal = DealModel::latest('id')->firstOrFail();
        $mydealcount = MyDeal::whereNull('cars_id')
                              ->where('customer_id', $customer_id) // Added condition for customer_id
                              ->count();
    
        if ($mydealcount < count($carIds)) {
            return redirect()->back()->with('error', 'จำนวนดีลไม่เพียงพอสำหรับรถที่เลือก !');
        }
    
        foreach ($carIds as $carId) {
            $car = carsModel::findOrFail($carId);
            $mydeal = MyDeal::whereNull('cars_id')
                            ->where('customer_id', $customer_id) // Added condition for customer_id
                            ->orderBy('deal_expire', 'asc')
                            ->firstOrFail();
    
            // dd($car->customer_id, $mydeal->customer_id);
            if ($car->customer_id !== $mydeal->customer_id) {
                return redirect()->back()->with('error', 'ไม่สามารถทำรายการได้: ข้อมูลไม่ถูกต้อง !');
            }
    
            $mydeal->update([
                'deals_id' => $deal->id,
                'cars_id' => $car->id,
            ]);
    
            $car->update([
                'mydeals' => $mydeal->id,
                'updated_at' => now(),
            ]);
        }
    
        return redirect()->route('specialchangedealPage')->with('success', 'ใส่รูปแบบดีลสำเร็จ !');
    }
    
    
    



    public function adddealaction(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'promotion_price' => 'nullable|numeric|lte:' . $request->current_price,
        ]);

        DB::beginTransaction();
        try {
            $car = carsModel::findOrFail($request->car_id);
            $deal = DealModel::latest('id')->firstOrFail();
            $mydeal = MyDeal::whereNull('cars_id')->orderBy('deal_expire', 'asc')->firstOrFail();

            if ($request->filled('promotion_price')) {
                $promotionPrice = $request->promotion_price;
                $oldPrice = $request->current_price;
            } else {
                $promotionPrice = $car->price;
                $oldPrice = null;
            }

            $mydeal->update([
                'deals_id' => $deal->id,
                'cars_id' => $car->id,
            ]);

            $car->update([
                'mydeals' => $mydeal->id,
                'price' => $promotionPrice,
                'old_price' => $oldPrice,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'ใส่กล่องเพิ่มการมองเห็นเรียบร้อย! คุณสามารถเปลี่่ยนรูปแบบได้ที่หน้า เปลี่ยนรูปแบบโปรโมชั่น');
            //เปลี่ยน ไป specialchangedealPage
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'ไม่สามารถใส่กล่องเพิ่มการมองเห็นได้');
        }
    }
    public function editpriceaction(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'promotion_price' => 'required',
        ]);

        $promotionPrice = str_replace(',', '', $request->promotion_price);
        $currentPrice = str_replace(',', '', $request->current_price);

        $promotionPrice = (float)$promotionPrice;
        $currentPrice = (float)$currentPrice;

        DB::beginTransaction();
        try {
            $car = carsModel::findOrFail($request->car_id);

            $newOldPrice = $promotionPrice > $currentPrice ? null : $currentPrice;

            $car->update([
                'price' => $promotionPrice,
                'old_price' => $newOldPrice,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'ปรับราคาสำเร็จ!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'ไม่สามารถปรับราคาได้');
        }
    }


    
    public function specialchangedealPage(Request $request) 
    {
        $customerdata = session('customer');
        $customer_id = $customerdata->id;

        // Retrieve parameters from the request
        $brandId = $request->input('brand_id');
        $modelId = $request->input('model_id');
        $keyword = $request->input('keyword');

        // Initialize the query
        $query = carsModel::with([
            'brand', 
            'model', 
            'generation', 
            'subModel', 
            'user', 
            'customer', 
            'myDeal.deal', // Eager load the nested 'deal' relationship
            'contacts'
        ])
        ->where('status', 'approved')
        ->where('customer_id', $customer_id)
        ->whereNotNull('mydeals')
        ->orderBy('id', 'desc');

        // Add conditions based on the presence of brand_id and model_id
        if ($brandId) {
            $query->where('brand_id', $brandId);
        }

        if ($modelId) {
            $query->where('model_id', $modelId);
        }

        // Add keyword search if present
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('modelyear', 'like', '%' . $keyword . '%')
                ->orWhere('yearregis', 'like', '%' . $keyword . '%')
                ->orWhere('vehicle_code', 'like', '%' . $keyword . '%');
            });
        }

        // Execute the query to get the results
        $results = $query->get();
        // Calculate remaining time for each car
        foreach ($results as $car) {
            if ($car->myDeal && $car->myDeal->deal) {
                $car->remaining_time = $this->getRemainingTime($car->myDeal->deal_expire);
            } else {
                $car->remaining_time = null;
            }
        }
        // dd($results);
        // Return the view with the results
        return view('frontend.specialchangedeal', [
            'page' => 'special-changedeal',
            'results' => $results,
        ]);
    }
    public function specialadddealPage(Request $request) 
    {
        $customerdata = session('customer');
        $customer_id = $customerdata->id;

        // Retrieve parameters from the request
        $brandId = $request->input('brand_id');
        $modelId = $request->input('model_id');
        $keyword = $request->input('keyword');

        // Initialize the query
        $query = carsModel::with(['brand', 'model', 'generation', 'subModel', 'user', 'customer', 'myDeal', 'contacts'])
                    ->where('status', 'approved')
                    ->where('customer_id', $customer_id)
                    ->whereNull('mydeals')
                    ->orderBy('id', 'desc');

        // Add conditions based on the presence of brand_id and model_id
        if ($brandId) {
            $query->where('brand_id', $brandId);
        }

        if ($modelId) {
            $query->where('model_id', $modelId);
        }

        // Add keyword search if present
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('modelyear', 'like', '%' . $keyword . '%')
                ->orWhere('yearregis', 'like', '%' . $keyword . '%')
                ->orWhere('vehicle_code', 'like', '%' . $keyword . '%');
            });
        }

        // Execute the query to get the results
        $results = $query->get();
        // dd($results);
        // Return the view with the results
        return view('frontend.specialadddeal', [
            'page' => 'special-adddeal',
            'results' => $results,
        ]);
    }

    public function specialselectdealPage(Request $request, $carId) 
    {
        // Fetch the car with its related data
        $car = carsModel::with([
            'brand', 
            'model', 
            'generation', 
            'subModel', 
            'user', 
            'customer', 
            'myDeal.deal' // Load nested deal relationship
        ])->findOrFail($carId);

        // Get all deals
        $alldeals = DealModel::orderBy('id', 'desc')->get();

        // Calculate remaining time if car has a myDeal and the associated deal
        $remaining_time = null;
        if ($car->myDeal && $car->myDeal->deal) {
            $remaining_time = $this->getRemainingTime($car->myDeal->deal_expire);
        }

        // Add remaining_time as a custom attribute to the car object
        $car->remaining_time = $remaining_time;

        // Return the view with the results
        return view('frontend.specialselectdeal', [
            'page' => 'special-changedeal',
            'alldeals' => $alldeals,
            'car' => $car,
        ]);
    }



    private function getRemainingTime($expireDate)
    {
        $expire = Carbon::parse($expireDate);
        $now = Carbon::now();
        $diffInDays = $expire->diffInDays($now);
        $diffInHours = $expire->diffInHours($now) % 24;

        return "{$diffInDays} วัน {$diffInHours} ชม.";
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
    public function cartPage(Request $request) 
    {
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
                    'accumulate' => $customer->accumulate + $thispackage->price,
                    'order_id' => $order->id,
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
            return redirect()->route('specialadddealPage')->with('success', 'ทำการสั่งซื้อสำเร็จ !');
        }   
        
    }
    public function orderpayPage(Request $request, $order) 
    {
        // dd($order);
        $myorder = OrderModel::find($order);
        return view('frontend/orderpay', [
            "myorder" => $myorder,
        ]);
    }

    public function packagePage(Request $request) 
    {
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
    public function cartselectdistrict(Request $request) 
    {

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
    public function cartselectsubdistrict(Request $request) 
    {

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
