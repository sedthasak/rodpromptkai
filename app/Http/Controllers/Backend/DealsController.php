<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use App\Models\DealModel;

class DealsController extends Controller
{
    public function BN_deals_edit(Request $request, $id)
    {
        $deal = DealModel::findOrFail($id); // Retrieve the coupon by ID
        return view('backend.deals-edit', [
            'default_pagename' => 'แก้ไข deals',
            'query' => $deal,
        ]);
    }

    
    public function BN_deals_edit_action(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'border' => 'required|string|max:7',
            'background' => 'required|string|max:7',
            'font1' => 'required|string|max:7',
            'font2' => 'required|string|max:7',
            'font3' => 'required|string|max:7',
            'font4' => 'nullable|string|max:7',
            'image_background' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'topleft' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'bottomright' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'expire' => 'nullable|date',
            'topleft_position' => 'nullable|in:1,2,3', // Validation for topleft_position
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput()
                             ->with('error', implode(' ', $errors));
        }
    
        // Find the existing deal
        $deal = DealModel::findOrFail($request->input('id'));
    
        $uploadPath = 'uploads/deal'; // This path is relative to 'storage/app/public'
    
        // Handle image removal
        if ($request->has('remove_background_image') && $deal->image_background) {
            Storage::disk('public')->delete($deal->image_background);
            $deal->image_background = null;
        }
    
        if ($request->has('remove_topleft_image') && $deal->topleft) {
            Storage::disk('public')->delete($deal->topleft);
            $deal->topleft = null;
        }
    
        if ($request->has('remove_bottomright_image') && $deal->bottomright) {
            Storage::disk('public')->delete($deal->bottomright);
            $deal->bottomright = null;
        }
    
        // Handle new image uploads
        if ($request->hasFile('image_background')) {
            if ($deal->image_background) {
                Storage::disk('public')->delete($deal->image_background);
            }
            $imageName = 'image_background_' . Str::random(10) . '.' . $request->file('image_background')->getClientOriginalExtension();
            $deal->image_background = $request->file('image_background')->storeAs($uploadPath, $imageName, 'public');
        }
    
        if ($request->hasFile('topleft')) {
            if ($deal->topleft) {
                Storage::disk('public')->delete($deal->topleft);
            }
            $imageName = 'topleft_' . Str::random(10) . '.' . $request->file('topleft')->getClientOriginalExtension();
            $deal->topleft = $request->file('topleft')->storeAs($uploadPath, $imageName, 'public');
        }
    
        if ($request->hasFile('bottomright')) {
            if ($deal->bottomright) {
                Storage::disk('public')->delete($deal->bottomright);
            }
            $imageName = 'bottomright_' . Str::random(10) . '.' . $request->file('bottomright')->getClientOriginalExtension();
            $deal->bottomright = $request->file('bottomright')->storeAs($uploadPath, $imageName, 'public');
        }
    
        // Set the default value for topleft_position if not provided, default to 1
        $deal->topleft_position = $request->input('topleft_position', 1);
    
        // Exclude the image fields from the fill method to avoid overwriting them with the uploaded file objects
        $deal->fill($request->except([
            '_token',
            'remove_background_image',
            'remove_topleft_image',
            'remove_bottomright_image',
            'image_background',  // Exclude image fields
            'topleft',
            'bottomright'
        ]));
    
        // Save the updated deal
        $deal->save();
    
        return redirect()->route('BN_deals')->with('success', 'Deal updated successfully!');
    }
    
    
    
    
    
    



    public function BN_deals_add(Request $request)
    {
        return view('backend.deals-add', [ 
            'default_pagename' => 'เพิ่ม deals',
        ]);
    }
    public function BN_deals_add_action(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'border' => 'required|string|max:7',
            'background' => 'required|string|max:7',
            'font1' => 'required|string|max:7',
            'font2' => 'required|string|max:7',
            'font3' => 'required|string|max:7',
            'font4' => 'nullable|string|max:7',
            'image_background' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'topleft' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'bottomright' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'expire' => 'nullable|date',
            'topleft_position' => 'nullable|in:1,2,3', // Validation for topleft_position
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput()
                             ->with('error', implode(' ', $errors));
        }
    
        $data = $request->all();
        $uploadPath = 'uploads/deal'; // Path relative to 'storage/app/public'
    
        // Handle image uploads and save to 'public' disk
        if ($request->hasFile('image_background')) {
            $imageName = 'image_background_' . Str::random(10) . '.' . $request->file('image_background')->getClientOriginalExtension();
            $data['image_background'] = $request->file('image_background')->storeAs($uploadPath, $imageName, 'public');
        }
    
        if ($request->hasFile('topleft')) {
            $imageName = 'topleft_' . Str::random(10) . '.' . $request->file('topleft')->getClientOriginalExtension();
            $data['topleft'] = $request->file('topleft')->storeAs($uploadPath, $imageName, 'public');
        }
    
        if ($request->hasFile('bottomright')) {
            $imageName = 'bottomright_' . Str::random(10) . '.' . $request->file('bottomright')->getClientOriginalExtension();
            $data['bottomright'] = $request->file('bottomright')->storeAs($uploadPath, $imageName, 'public');
        }
    
        // Set the default value for topleft_position if not provided, default to 1
        $data['topleft_position'] = $request->input('topleft_position', 1);
    
        // Create a new deal
        DealModel::create($data);
    
        return redirect()->route('BN_deals')->with('success', 'Deal created successfully!');
    }
    
    
    



    public function BN_deals(Request $request)
    {
        $deals = DealModel::get();
        return view('backend/deals', [ 
            'default_pagename' => 'deals',
            'query' => $deals,
        ]);
    }
}
