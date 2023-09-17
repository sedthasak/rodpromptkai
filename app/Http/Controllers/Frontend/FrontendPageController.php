<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class FrontendPageController extends Controller
{

    public function profilePage()
    {
        return view('frontend/profile', [

        ]);
    }
    public function carpoststep4Page()
    {
        return view('frontend/carpost-step4', [

        ]);
    }
    public function carpoststep3Page()
    {
        return view('frontend/carpost-step3', [

        ]);
    }
    public function carpoststep2Page()
    {
        return view('frontend/carpost-step2', [

        ]);
    }
    public function carpoststep1Page()
    {
        return view('frontend/carpost-step1', [

        ]);
    }
    public function postcarwelcomeladyPage()
    {
        return view('frontend/postcar-welcome-lady', [

        ]);
    }
    public function postcarwelcomedealerPage()
    {
        return view('frontend/postcar-welcome-dealer', [

        ]);
    }
    public function postcarwelcomePage()
    {
        return view('frontend/postcar-welcome', [

        ]);
    }
    public function cardetailPage()
    {
        return view('frontend/car-detail', [

        ]);
    }
    public function carPage()
    {
        return view('frontend/car', [

        ]);
    }
    public function postcarPage()
    {
        return view('frontend/postcar', [

        ]);
    }
    public function newsdetailPage()
    {
        return view('frontend/news-detail', [

        ]);
    }
    public function newsPage()
    {
        return view('frontend/news', [

        ]);
    }

    public function notificationPage()
    {
        return view('frontend/notification', [

        ]);
    }
    public function loginPage()
    {
        return view('frontend/login', [

        ]);
    }
    public function indexPage(Request $request)
    {
        // $browserFingerprint = $request->session()->get('browser_fingerprint');
        // if ($browserFingerprint == "") {
        //     // สร้างตัวเลขสุ่ม 6 หลัก
        //     $randomNumber = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

        //     // สร้าง Browser Fingerprint
        //     $browserFingerprint = "RD$randomNumber";

        //     // เก็บลงใน Session
        //     $request->session()->put('browser_fingerprint', $browserFingerprint);
        // }
        // $browserFingerprint = $request->session()->get('browser_fingerprint');
        // $qry = Customer::where("browserFingerprint", $browserFingerprint)->first();
        // if (isset($qry)) {

        // }
        // else {
        //     $data = ['browserFingerprint' => $browserFingerprint];
        //     Customer::create($data);
        // }
        
        return view('frontend/index-page', [
             // Specify the base layout.
             // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
             // The default value is 'side-menu'
 
            //  'layout' => 'side-menu'

            // 'browserFingerprint' => $browserFingerprint
        ]);
    }
    public function loopidentity(Request $request) {
        $browserFingerprint = $request->session()->get('browser_fingerprint');
        $qry = Customer::where("browserFingerprint", $browserFingerprint)->first();
        if (isset($qry))
            $data = ["text" => "success"];
        else
            $data = ["text" => "failed"];
        return response()->json($data);
    }
}
