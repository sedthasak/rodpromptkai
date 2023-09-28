<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sms_session;

class FrontendPageController extends Controller
{

    public function editdealercarpoststep4Page()
    {
        return view('frontend/edit-dealer-carpost-step4', [

        ]);
    }
    public function editdealercarpoststep3Page()
    {
        return view('frontend/edit-dealer-carpost-step3', [

        ]);
    }
    public function editdealercarpoststep2Page()
    {
        return view('frontend/edit-dealer-carpost-step2', [

        ]);
    }
    public function editdealercarpoststep1Page()
    {
        return view('frontend/edit-dealer-carpost-step1', [

        ]);
    }
    public function editcarpoststep4Page()
    {
        return view('frontend/edit-carpost-step4', [

        ]);
    }
    public function editcarpoststep3Page()
    {
        return view('frontend/edit-carpost-step3', [

        ]);
    }
    public function editcarpoststep2Page()
    {
        return view('frontend/edit-carpost-step2', [

        ]);
    }
    public function editcarpoststep1Page()
    {
        return view('frontend/edit-carpost-step1', [

        ]);
    }
    public function dealercarpoststep4Page()
    {
        return view('frontend/dealer-carpost-step4', [

        ]);
    }
    public function dealercarpoststep3Page()
    {
        return view('frontend/dealer-carpost-step3', [

        ]);
    }
    public function dealercarpoststep2Page()
    {
        return view('frontend/dealer-carpost-step2', [

        ]);
    }
    public function dealercarpoststep1Page()
    {
        return view('frontend/dealer-carpost-step1', [

        ]);
    }
    public function editprofile2Page()
    {
        return view('frontend/edit-profile2', [

        ]);
    }
    public function editprofilePage()
    {
        return view('frontend/edit-profile', [

        ]);
    }
    public function loginwelcomePage()
    {
        return view('frontend/login-welcome', [

        ]);
    }
    public function updatecarpricePage()
    {
        return view('frontend/update-carprice', [

        ]);
    }
    public function customercontactPage()
    {
        return view('frontend/customer-contact', [

        ]);
    }
    public function checkpricePage()
    {
        return view('frontend/check-price', [

        ]);
    }
    public function performanceviewPage()
    {
        return view('frontend/performance-view', [

        ]);
    }
    public function performanceviewpostPage()
    {
        return view('frontend/performance-viewpost', [

        ]);
    }
    public function performancePage()
    {
        return view('frontend/performance', [

        ]);
    }
    public function profileexpirePage()
    {
        return view('frontend/profile-expire', [

        ]);
    }
    public function profileeditcarinfoPage()
    {
        return view('frontend/profile-editcarinfo', [

        ]);
    }
    public function profilecheckPage()
    {
        return view('frontend/profile-check', [

        ]);
    }
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
        $browserFingerprint = $request->session()->get('browser_fingerprint');
        if ($browserFingerprint == "") {

            $currentDateTime = now()->format('YmdHis'); // ดึงวันที่และเวลาปัจจุบันในรูปแบบ YmdHis
            $browserFingerprint = strtotime($currentDateTime) % 1000000; // เข้ารหัสเป็นตัวเลข 6 หลัก

            // เก็บลงใน Session
            $request->session()->put('browser_fingerprint', $browserFingerprint);

            $browserFingerprint = $request->session()->get('browser_fingerprint');
        }
        
        // $qry = Customer::where("browserFingerprint", $browserFingerprint)->first();
        // if (isset($qry)) {

        // }
        // else {
        //     $data = ['browserFingerprint' => $browserFingerprint];
        //     Customer::create($data);
        // }

        $customer = Customer::join("sms_session", "customer.id", "sms_session.customer_id")
        ->where('sms_session.browserFingerprint', $browserFingerprint)->where('sms_session.messages', $browserFingerprint)->first();
        
        return view('frontend/index-page', [
             // Specify the base layout.
             // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
             // The default value is 'side-menu'
 
            'layout' => 'side-menu',

            'browserFingerprint' => $browserFingerprint,
            'customer' => $customer
        ]);
    }
    public function loopidentity(Request $request) {
        $browserFingerprint = $request->session()->get('browser_fingerprint');
        $qry = Sms_session::where("browserFingerprint", $browserFingerprint)->where("messages", $browserFingerprint)->first();
        if (isset($qry))
            $data = ["text" => "success"];
        else
            $data = ["text" => "failed"];
        return response()->json($data);
    }
}
