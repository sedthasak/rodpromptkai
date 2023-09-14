<?php

namespace App\Http\Controllers\Frontend;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sms;

class SmsController extends Controller
{
    public function store($messages) {
        $data = ['messages' => $messages];
        Sms::create($data);
        return "200";
    }
}