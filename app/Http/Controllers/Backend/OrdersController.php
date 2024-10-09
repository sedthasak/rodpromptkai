<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Mpdf\Mpdf; // Include MPDF
// use Barryvdh\DomPDF\Facade as PDF;
use App\Models\OrderModel; // Include the OrderModel
use App\Models\Customer;   // Include the Customer Model if you need to show customer details
use App\Models\PackageDealerModel;
use App\Models\VipPackageModel;

class OrdersController extends Controller
{
    /**
     * Generate Individual Receipt PDF for an order.
     */
    public function generateIndividualReceipt($id)
    {
        $order = OrderModel::find($id);

        if ($order && $order->full_receipt && $order->person_type === 'individual') {
            // Retrieve product details
            list($productName, $amount) = $this->getProductDetails($order);

            $pdf = PDF::loadView('backend.documents.individual_receipt', compact('order', 'productName', 'amount'));
            return $pdf->setPaper('A4', 'portrait')->stream('Individual_Receipt_' . $order->order_number . '.pdf');
        }

        return back()->with('error', 'Cannot generate Individual Receipt for this order.');
    }

    /**
     * Generate Corporate Tax Invoice PDF for an order.
     */
    public function generateCorporateTaxInvoice($id)
    {
        $order = OrderModel::find($id);

        if ($order && $order->full_receipt && $order->person_type === 'corporation') {
            // Retrieve product details
            list($productName, $amount) = $this->getProductDetails($order);

            $pdf = PDF::loadView('backend.documents.corporate_tax_invoice', compact('order', 'productName', 'amount'));
            return $pdf->setPaper('A4', 'portrait')->stream('Corporate_Tax_Invoice_' . $order->order_number . '.pdf');
        }

        return back()->with('error', 'Cannot generate Corporate Tax Invoice for this order.');
    }

    /**
     * Generate Short Receipt PDF for an order.
     */
    public function generateShortReceipt($id)
    {
        $order = OrderModel::find($id);

        if ($order && $order->short_receipt) {
            // Retrieve product details
            list($productName, $amount) = $this->getProductDetails($order);

            $pdf = PDF::loadView('backend.documents.short_receipt', compact('order', 'productName', 'amount'));
            return $pdf->setPaper('A4', 'portrait')->stream('Short_Receipt_' . $order->order_number . '.pdf');
        }

        return back()->with('error', 'Cannot generate Short Receipt for this order.');
    }

    /**
     * Get product details (name and amount) based on the order type.
     *
     * @param OrderModel $order
     * @return array
     */
    private function getProductDetails($order)
    {
        $productName = 'Unknown';
        $amount = 1;

        if ($order->type == 'deal') {
            $productName = 'Deal';
            $amount = $order->amount;
        } elseif ($order->type == 'package') {
            // Retrieve package name from `PackageDealerModel`
            $customer = Customer::find($order->customer_id);
            $package = PackageDealerModel::find($order->package_dealers_id);
            $productName = $package ? $package->name : 'Unknown Package';
            $amount = $order->amount; // Assuming amount is already defined in the order table
        } elseif ($order->type == 'vip') {
            // Retrieve VIP package name from `VipPackageModel`
            $customer = Customer::find($order->customer_id);
            $vipPackage = VipPackageModel::find($customer->vippack);
            $productName = $vipPackage ? $vipPackage->name : 'Unknown VIP Package';
            $amount = $order->amount; // Assuming amount is already defined in the order table
        }

        return [$productName, $amount];
    }


    














    public function BN_orders(Request $request)
    {
        // dd(class_exists(PDF::class));

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
