<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

use App\Models\CouponModel;

class DiscountsController extends Controller
{
    public function BN_discounts_add(Request $request)
    {
        return view('backend/discount-add', [ 
            'default_pagename' => 'เพิ่มคูปองส่วนลด',
        ]);
    }
    public function BN_discounts_add_action(Request $request)
    {
        // dd($request);
        Log::info('Entering BN_discounts_add_action');

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:coupons,code',
            'rate' => 'required|numeric|min:0|max:100',
            'limit_rate' => 'nullable|numeric|min:0',
            'expire' => 'nullable|date',
            'description' => 'nullable|string',
            'limit' => 'nullable|integer|min:0',
            'level_member' => 'nullable|string',
        ]);
        try {
            Log::info('Validation passed');

            // Create and save the new coupon
            $coupon = new CouponModel($validated);
            $coupon->status = 'active';  // Set default status to 'active'
            $coupon->save();

            Log::info('Coupon saved successfully');
            return redirect(route('BN_discounts'))->with('success', 'สร้างคูปองสำเร็จ !!!');
        } catch (QueryException $e) {
            Log::error('Error saving coupon: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'การบันทึกข้อมูลล้มเหลว !!!');
            // return redirect()->back()->withInput()->with('error', 'การบันทึกข้อมูลล้มเหลว: ' . $e->getMessage());
        }

    }
    public function BN_discounts(Request $request)
    {
        $query = CouponModel::query()
            ->orderBy('id', 'desc');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('code', 'LIKE', '%' . $keyword . '%');
            });
        }
        $resultPerPage = 24;
        $query = $query->paginate($resultPerPage);
        return view('backend/discount', [ 
            'default_pagename' => 'discount',
            'query' => $query,
        ]);
    }


    public function BN_discounts_edit(Request $request, $id)
    {
        $coupon = CouponModel::findOrFail($id); // Retrieve the coupon by ID
        return view('backend/discount-edit', [
            'default_pagename' => 'แก้ไขคูปองส่วนลด',
            'coupon' => $coupon,
        ]);
    }
    public function BN_discounts_edit_action(Request $request)
    {
        Log::info('Entering BN_discounts_edit_action');

        // Validate the incoming request
        $validated = $request->validate([
            'id' => 'required|exists:coupons,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:coupons,code,' . $request->id,
            'rate' => 'required|numeric|min:0|max:100',
            'limit_rate' => 'nullable|numeric|min:0',
            'expire' => 'nullable|date',
            'description' => 'nullable|string',
            'limit' => 'nullable|integer|min:0',
            'level_member' => 'nullable|string',
            'status' => 'required|in:active,expire,หมด', // Ensure status is one of these values
        ]);

        try {
            Log::info('Validation passed');

            // Find the coupon by ID
            $coupon = CouponModel::findOrFail($validated['id']);

            // Update coupon attributes
            $coupon->name = $validated['name'];
            $coupon->code = $validated['code'];
            $coupon->rate = $validated['rate'];
            $coupon->limit_rate = $validated['limit_rate'];
            $coupon->expire = $validated['expire'];
            $coupon->description = $validated['description'];
            $coupon->limit = $validated['limit'];
            $coupon->level_member = $validated['level_member'];
            $coupon->status = $validated['status'];

            // Save the updated coupon
            $coupon->save();

            Log::info('Coupon updated successfully');
            return redirect(route('BN_discounts'))->with('success', 'แก้ไขข้อมูลสำเร็จ !!!');
        } catch (\Exception $e) {
            // Handle exceptions or errors
            Log::error('Error updating coupon: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage());
        }
    }
    public function BN_discounts_detail(Request $request, $id)
    {
        $coupon = CouponModel::findOrFail($id); // Retrieve the coupon by ID
        return view('backend/discount-detail', [
            'default_pagename' => 'คูปองส่วนลด',
            'coupon' => $coupon,
        ]);
    }
}
