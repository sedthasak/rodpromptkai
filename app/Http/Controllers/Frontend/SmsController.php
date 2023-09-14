<?php

namespace App\Http\Controllers\Frontend;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sms;
use App\Models\Customer;

class SmsController extends Controller
{
    public function store($messages) {
        $data = ['messages' => $messages];
        Sms::create($data);
        $data2 = ['messages' => $messages];
        Customer::create($data2);
        return "200";
    }
}