<?php

namespace App\Http\Backend\Controllers;

use Illuminate\Http\Request;
use App\Models\Sms;

class SmsController extends Controller
{
    public function store($messages) {
        $data = ['messages' => $messages];
        Sms::create($data);
        return "200";
    }
}