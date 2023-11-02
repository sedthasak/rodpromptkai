<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sms_session;
use App\Models\provincesModel;
use App\Models\brandsModel;
use App\Models\modelsModel;
use App\Models\carsModel;
use Illuminate\Support\Facades\Storage;
use File;


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
    public function editprofilePage()
    {
        // $provinces = provincesModel::all()->sort();
        $provinces = provincesModel::all();

        return view('frontend/edit-profile', [
            'provinces' => $provinces,
        ]);
    }
    public function editprofileactionPage(Request $request)
    {
        $Customer = Customer::find($request->id);
        
        if($request->hasFile('image')){

            $oldPath = public_path($Customer->image);
            if(File::exists($oldPath)){
                File::delete($oldPath);
            }

            $file = $request->file('image');
            $destinationPath = public_path('/uploads');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = 'profile'.time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/'.$newfilenam;

            $Customer->image = $filepath;
        }
        if($request->hasFile('map')){

            $oldPath = public_path($Customer->map);
            if(File::exists($oldPath)){
                File::delete($oldPath);
            }

            $file = $request->file('map');
            $destinationPath = public_path('/uploads');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = 'map'.time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/'.$newfilenam;

            $Customer->map = $filepath;
        }

        $Customer->email = $request->email;
        $Customer->firstname = $request->firstname;
        $Customer->lastname = $request->lastname;
        $Customer->facebook = $request->facebook;
        $Customer->line = $request->line;
        $Customer->place = $request->place;
        $Customer->province = $request->province;
        $Customer->google_map = $request->google_map;
        $Customer->update();

        // dd($request);
        if(isset($Customer->id)){
            // $usersavelog = auth()->user();
            $idsavelog = $request->id; 
            $phonesavelog = $request->phone; 
            $para = array(
                'part' => 'frontend',
                'user' => $idsavelog,
                'ref' => $phonesavelog,
                'remark' => 'User '.$idsavelog.' Update Profile!',
                'event' => 'update profile',
            );
            $result = (new LogsSaveController)->create_log($para);
        }
        return redirect(route('editprofilePage'))->with('success', 'แก้ไขข้อมูลสำเร็จ !');
    }
    public function editprofilePage_afterregis()
    {
        $provinces = provincesModel::all();
        return view('frontend/edit-profile-first', [
            'provinces' => $provinces,
        ]);
    }
    public function loginwelcomePage()
    {
        $data = session()->all();
        $customerdata = session('customer');
        return view('frontend/login-welcome', [
            'customerdata' => $customerdata,
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
        $carsModel = carsModel::all();
        return view('frontend/profile', [
            'carsModel' => $carsModel,
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
    public function DevelopPage()
    {
        // Session::put('customer_session', '2413320998887778');
        // dd('fd');
        function ranInt(){
            $codetosend = random_int(0,9);
            return $codetosend;
        }
        // $codetosend = ranInt();

        do {
            $codetosend = ranInt();
            $exists = Sms_session::where("customer_session", $codetosend)->exists();

        } while ($exists);

        return view('frontend/develop', [
            'test' => $codetosend,
        ]);
    }
    public function indexPage(Request $request)
    {
        // $browserFingerprint = $request->session()->get('browser_fingerprint');
        // if ($browserFingerprint == "") {

        //     $currentDateTime = now()->format('YmdHis'); // ดึงวันที่และเวลาปัจจุบันในรูปแบบ YmdHis
        //     $browserFingerprint = strtotime($currentDateTime) % 1000000; // เข้ารหัสเป็นตัวเลข 6 หลัก

        //     // เก็บลงใน Session
        //     $request->session()->put('browser_fingerprint', $browserFingerprint);

        //     $browserFingerprint = $request->session()->get('browser_fingerprint');
        // }

        // $customer = Customer::join("sms_session", "customer.id", "sms_session.customer_id")
        // ->where('sms_session.browserFingerprint', $browserFingerprint)->where('sms_session.messages', $browserFingerprint)->first();
        

        // $currentDateTimess = now()->format('YmdHis'); // ดึงวันที่และเวลาปัจจุบันในรูปแบบ YmdHis
        // $tel = '0998741070';
        // $codetosend = rand(100000,999999);
        // $message = $SixDigitRandomNumber.$tel;
        // $para1 = '892001';
        // $getsmssession = Sms_session::where("messages", $para1)->first();
        // $getsmssession = Sms_session::where([
        //     ['messages', '=', $para1],
        // ])->first();

        return view('frontend/index-page', [
             // Specify the base layout.
             // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
             // The default value is 'side-menu'
 
            'layout' => 'side-menu',

            // 'browserFingerprint' => $browserFingerprint,
            // 'getsmssession' => $getsmssession,
            // 'customer' => $customer
        ]);
    }
    public function loopidentity(Request $request) {
        $browserFingerprint = $request->session()->get('browserFingerprint');
        $qry_session = Sms_session::where("browserFingerprint", $browserFingerprint)->where("messages", $browserFingerprint)->first();
        if(isset($qry_session)){
            $qry_customer = Customer::where("id", $qry_session->customer_id)->first();
            $permanent_session = $browserFingerprint.$qry_customer->phone;

            $session = Sms_session::find($qry_session->id);
            $session->customer_session = $permanent_session;
            $session->browserFingerprint = '';
            $session->messages = '';

            $session->update();

            $request->session()->put('customer_session', $permanent_session);

            $data = ["text" => "success"];
        }else{
            $data = ["text" => "failed"];
        }
            
        return response()->json($data);
    }

    public function TheBooGeyManEncodeIdx($string,$key='PKMONEY'){
        $j=0;$hash=null;$key=sha1($key);$strLen=strlen($string);$keyLen=strlen($key);
        for($i=0;$i<$strLen;++$i){
            $ordStr=ord(substr($string,$i,1));
            if($j==$keyLen){$j=0;}
            $ordKey=ord(substr($key,$j,1));
            ++$j;
            $hash.=strrev(base_convert(dechex($ordStr+$ordKey),16,36));
        }return $hash;
    }
    public function TheBooGeyManDecodeIdx($string,$key='PKMONEY'){
        $j=0;$hash=null;$key=sha1($key);$strLen=strlen($string);$keyLen=strlen($key);
        for($i=0;$i<$strLen;$i+=2){
            $ordStr=hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
            if($j==$keyLen){$j=0;}
            $ordKey=ord(substr($key,$j,1));
            ++$j;
            $hash.=chr($ordStr-$ordKey);
        }return $hash;
    }
}
