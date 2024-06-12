<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CouponModel;

class DiscountsController extends Controller
{
    public function BN_discounts(Request $request)
    {
        // $Customer = Customer::query()
        // ->orderBy('id', 'desc')
        // ->paginate(16);

        $query = CouponModel::query()
            ->orderBy('id', 'desc');

        // if ($request->filled('keyword')) {
        //     $keyword = $request->input('keyword');
        //     $query->where(function ($query) use ($keyword) {
        //         $query->where('firstname', 'LIKE', '%' . $keyword . '%')
        //             ->orWhere('lastname', 'LIKE', '%' . $keyword . '%')
        //             ->orWhere('phone', 'LIKE', '%' . $keyword . '%');
        //     });
        // }

        $resultPerPage = 24;
        $query = $query->paginate($resultPerPage);


        return view('backend/discount', [ 
            'default_pagename' => 'discount',
            'query' => $query,
        ]);
    }
}
