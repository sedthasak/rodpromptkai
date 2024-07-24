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
            'image_background' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'topleft' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'bottomright' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'expire' => 'required|date',
            'bigbrand' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            // Log the validation errors
            \Log::error('Validation failed', $validator->errors()->toArray());

            // Retrieve error messages
            $errors = $validator->errors()->all();

            // Return back with validation errors and old input
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error', implode(' ', $errors)); // Show all errors as a single string
        }

        // Find the existing deal
        $deal = DealModel::findOrFail($request->input('id'));

        // Prepare the data for update
        $data = $request->except('_token', 'id'); // Exclude the token and ID from data

        $uploadPath = 'public/uploads/deal';

        // Handle image uploads
        if ($request->hasFile('image_background')) {
            // Delete old image if it exists
            if ($deal->image_background) {
                Storage::delete($uploadPath . '/' . $deal->image_background);
            }
            $imageName = 'image_background_' . Str::random(10) . '.' . $request->file('image_background')->getClientOriginalExtension();
            $data['image_background'] = $request->file('image_background')->storeAs($uploadPath, $imageName);
        }

        if ($request->hasFile('topleft')) {
            // Delete old image if it exists
            if ($deal->topleft) {
                Storage::delete($uploadPath . '/' . $deal->topleft);
            }
            $imageName = 'topleft_' . Str::random(10) . '.' . $request->file('topleft')->getClientOriginalExtension();
            $data['topleft'] = $request->file('topleft')->storeAs($uploadPath, $imageName);
        }

        if ($request->hasFile('bottomright')) {
            // Delete old image if it exists
            if ($deal->bottomright) {
                Storage::delete($uploadPath . '/' . $deal->bottomright);
            }
            $imageName = 'bottomright_' . Str::random(10) . '.' . $request->file('bottomright')->getClientOriginalExtension();
            $data['bottomright'] = $request->file('bottomright')->storeAs($uploadPath, $imageName);
        }

        // Update the deal
        $deal->update($data);

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'border' => 'required|string|max:7',
            'background' => 'required|string|max:7',
            'font1' => 'required|string|max:7',
            'font2' => 'required|string|max:7',
            'font3' => 'required|string|max:7',
            'image_background' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'topleft' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'bottomright' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'expire' => 'required|date',
            'bigbrand' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            // Log the validation errors
    
            // Retrieve error messages
            $errors = $validator->errors()->all();
    
            // Return back with validation errors and old input
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error', implode(' ', $errors)); // Show all errors as a single string
        }
        $data = $request->all();
        $uploadPath = 'public/uploads/deal';

        if ($request->hasFile('image_background')) {
            $imageName = 'image_background_' . Str::random(10) . '.' . $request->file('image_background')->getClientOriginalExtension();
            $data['image_background'] = $request->file('image_background')->storeAs($uploadPath, $imageName);
        }
        if ($request->hasFile('topleft')) {
            $imageName = 'topleft_' . Str::random(10) . '.' . $request->file('topleft')->getClientOriginalExtension();
            $data['topleft'] = $request->file('topleft')->storeAs($uploadPath, $imageName);
        }
        if ($request->hasFile('bottomright')) {
            $imageName = 'bottomright_' . Str::random(10) . '.' . $request->file('bottomright')->getClientOriginalExtension();
            $data['bottomright'] = $request->file('bottomright')->storeAs($uploadPath, $imageName);
        }
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
