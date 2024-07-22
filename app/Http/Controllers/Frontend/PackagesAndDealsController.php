<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\PackageDealerModel;
use App\Models\VipPackageModel;
use App\Models\DealModel;
use App\Models\OrderModel;
use App\Models\CouponModel;
use App\Models\CouponUse;
use App\Models\Customer;

use App\Models\Province;
use App\Models\District;
use App\Models\SubDistrict;

class PackagesAndDealsController extends Controller
{
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
        
        if ($type == 'package') {
            $item = PackageDealerModel::find($packageId);
        } elseif ($type == 'deal') {
            $item = DealModel::find($packageId);
        } else {
            $item = null;
        }
        // dd($pv);
        return view('frontend/cart', [
            "item" => $item,
            "type" => $type,
            "pvs" => $pvs,
        ]);
    }

    public function cartactionPage(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        // Validate coupon if provided
        if ($request->coupons_id) {
            $coupon = CouponModel::find($request->coupons_id);
            if ($coupon) {
                if ($coupon->limit) {
                    $totalUses = CouponUse::where('coupons_id', $coupon->id)->count();
                    if ($totalUses >= $coupon->limit) {
                        // return redirect()->back()->withErrors(['coupon' => 'Coupon use limit exceeded.']);
                        return redirect()->route('profilePage')->with('error', 'Coupon use limit exceeded !');
                    }
                }
            }
        }
        // Proceed with creating the order
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
            'invoiceform' => $request->invoiceform
        ];

        if ($request->type == 'package') {
            $data['package_dealers_id'] = $request->package_dealers_id;
        }

        switch ($request->invoiceform) {
            case 'full_receipt':
                $data['full_receipt'] = true;
                $data['person_type'] = $request->person_type ?? 'individual';
                $data = array_merge($data, $request->person_type === 'individual'
                    ? $request->only([
                        'individual_name',
                        'individual_taxidno',
                        'individual_telephone',
                        'individual_email',
                        'individual_address',
                        'individual_province',
                        'individual_district',
                        'individual_subdistrict',
                        'individual_zipcode'
                    ])
                    : $request->only([
                        'corporation_name',
                        'corporation_taxidno',
                        'corporation_branchid',
                        'corporation_telephone',
                        'corporation_email',
                        'corporation_address',
                        'corporation_province',
                        'corporation_district',
                        'corporation_subdistrict',
                        'corporation_zipcode'
                    ])
                );
                break;

            case 'short_receipt':
                $data['short_receipt'] = true;
                $data = array_merge($data, $request->only([
                    'short_name',
                    'short_telephone',
                    'short_email',
                    'short_address',
                    'short_province',
                    'short_district',
                    'short_subdistrict',
                    'short_zipcode'
                ]));
                break;

            case 'no_receipt':
                $data['no_receipt'] = true;
                break;
        }

        $order = OrderModel::create($data);

        if ($request->type == 'package' && $order->package_dealers_id) {
            $thispackage = PackageDealerModel::find($order->package_dealers_id);
            if ($customer && $thispackage) {
                $customer->update([
                    'role' => 'dealer',
                    'customer_quota' => $thispackage->limit,
                    'dealerpack' => $thispackage->id,
                    'dealerpack_regis' => now(),
                    'dealerpack_expire' => now()->addMonths(4),
                    'accumulate' => $customer->accumulate + $thispackage->price
                ]);
            }
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
        return redirect()->route('profilePage')->with('success', 'ทำการสั่งซื้อสำเร็จ !');
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
