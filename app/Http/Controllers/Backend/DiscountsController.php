<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

use App\Models\CouponModel;
use App\Models\LevelModel;

class DiscountsController extends Controller
{
    public function BN_discounts_add(Request $request)
    {
        $Levels = LevelModel::all();  // Use `all()` instead of `get()` for better readability
        return view('backend/discount-add', [ 
            'default_pagename' => 'เพิ่มคูปองส่วนลด',
            'Levels' => $Levels,
        ]);
    }
    
    public function BN_discounts_add_action(Request $request)
    {
        Log::info('Entering BN_discounts_add_action');
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:coupons,code',
            'rate' => 'required|numeric|min:0|max:100',
            'limit_rate' => 'nullable|numeric|min:0',
            'have_expire' => 'required|boolean',
            'expire' => 'nullable|date|required_if:have_expire,1',
            'description' => 'nullable|string',
            'limit' => 'nullable|integer|min:0',
            'level_member' => 'nullable|integer|exists:levels,id',
        ]);
    
        try {
            Log::info('Validation passed');
    
            $coupon = new CouponModel();
            $coupon->fill($validated);
            $coupon->status = 'active';
            $coupon->expirecoupon = $validated['expire'];
            $coupon->save();
    
            Log::info('Coupon saved successfully');
            return redirect(route('BN_discounts'))->with('success', 'สร้างคูปองสำเร็จ !!!');
        } catch (\Exception $e) {
            Log::error('Error saving coupon: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'การบันทึกข้อมูลล้มเหลว !!!');
        }
    }
    
    
    
    
    public function BN_discounts(Request $request)
    {
        $query = CouponModel::with('level') // Eager-load the level relationship
            ->orderBy('id', 'desc');
    
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('code', 'LIKE', '%' . $keyword . '%');
            });
        }
    
        $resultPerPage = 12;
        $coupons = $query->paginate($resultPerPage);
    
        return view('backend/discount', [
            'default_pagename' => 'discount',
            'coupons' => $coupons,
        ]);
    }
    
    


    public function BN_discounts_edit(Request $request, $id)
    {
        $coupon = CouponModel::findOrFail($id);
        $Levels = LevelModel::get();
        return view('backend/discount-edit', [
            'default_pagename' => 'แก้ไขคูปองส่วนลด',
            'coupon' => $coupon,
            'Levels' => $Levels,
        ]);
    }
    
    public function BN_discounts_edit_action(Request $request)
    {
        Log::info('Entering BN_discounts_edit_action');
    
        $validated = $request->validate([
            'id' => 'required|exists:coupons,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:coupons,code,' . $request->id,
            'rate' => 'required|numeric|min:0|max:100',
            'limit_rate' => 'nullable|numeric|min:0',
            'have_expire' => 'required|boolean',
            'expire' => 'nullable|date|required_if:have_expire,1',
            'description' => 'nullable|string',
            'limit' => 'nullable|integer|min:0',
            'level_member' => 'nullable|integer|exists:levels,id',
            'status' => 'required|in:active,inactive',
        ]);
    
        try {
            Log::info('Validation passed');
    
            $coupon = CouponModel::findOrFail($validated['id']);
            $coupon->update([
                'name' => $validated['name'],
                'code' => $validated['code'],
                'rate' => $validated['rate'],
                'limit_rate' => $validated['limit_rate'],
                'expirecoupon' => $validated['expire'],
                'description' => $validated['description'],
                'limit' => $validated['limit'],
                'level_member' => $validated['level_member'],
                'status' => $validated['status'],
            ]);
    
            Log::info('Coupon updated successfully');
            return redirect(route('BN_discounts'))->with('success', 'แก้ไขข้อมูลสำเร็จ !!!');
        } catch (\Exception $e) {
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
