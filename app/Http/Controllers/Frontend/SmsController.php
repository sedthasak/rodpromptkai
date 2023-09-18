<?php

namespace App\Http\Controllers\Frontend;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sms;
use App\Models\Customer;

class SmsController extends Controller
{
    public function store($messages, Request $request) {
        $data = ['messages' => $request->phone.'-'.$request->text.'-'.$request->sim];
        Sms::create($data);
        $data2 = ['messages' => $messages];
        Customer::create($data2);
        return "200";
    }
}