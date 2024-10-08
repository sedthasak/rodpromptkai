<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel; // Include the OrderModel
use App\Models\Customer;   // Include the Customer Model if you need to show customer details

class OrdersController extends Controller
{
    public function BN_orders(Request $request)
    {
        // Retrieve filter parameters
        $keyword = $request->input('keyword');
        $status = $request->input('status');
        $type = $request->input('type');
    
        // Fetch distinct types and statuses for dropdown filters
        $statuses = OrderModel::select('status')->distinct()->get();
        $types = OrderModel::select('type')->distinct()->get();
    
        // Filter orders based on search and select filters
        $orders = OrderModel::query();
    
        if ($keyword) {
            $orders->where(function ($query) use ($keyword) {
                $query->where('individual_name', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('individual_taxidno', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('order_number', 'LIKE', '%' . $keyword . '%');
            });
        }
    
        if ($status) {
            $orders->where('status', $status);
        }
    
        if ($type) {
            $orders->where('type', $type);
        }
    
        $orders = $orders->orderBy('created_at', 'desc')->paginate(20);
    
        return view('backend.orders', [
            'orders' => $orders,
            'default_pagename' => 'Order List',
            'statuses' => $statuses,
            'types' => $types,
        ]);
    }
    

    // Method to show the order detail page
    public function BN_order_detail($id)
    {
        // Retrieve the order details by ID
        $order = OrderModel::with('customer')->find($id); // Load related customer data

        // Check if order exists
        if (!$order) {
            return redirect()->route('BN_orders')->with('error', 'Order not found.');
        }

        // Return the view with the order details
        return view('backend.order-detail', [
            'order' => $order,
            'default_pagename' => 'Order Detail',
        ]);
    }
}
