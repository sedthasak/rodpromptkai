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
use App\Models\generationsModel;
use App\Models\sub_modelsModel;
use App\Models\carsModel;
use App\Models\categoriesModel;
use App\Models\setFooterModel;
use App\Models\setting_optionModel;
use App\Models\contactsModel;
use App\Models\contacts_backModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;


class FrontendPageController extends Controller
{

    public function contactcaractionPage(Request $request)
    {
        // dd($request);

        if(isset($request->customer_id) && isset($request->cars_id)){
            $contacts = new contacts_backModel;
            $contacts->customer_id = $request->customer_id;
            $contacts->name = $request->name;
            $contacts->tel = $request->tel;
            $contacts->time = $request->time;
            $contacts->remark = $request->remark;
            $contacts->cars_id = $request->cars_id;
            $contacts->status = 'create';
            $contacts->save();
            return redirect()->back()->with('success', 'ส่งข้อมูลสำเร็จ !');
        }else{
            return redirect()->back()->with('error', 'ผิดพลาด !');
        }   
            
    }
    public function helpcaractionPage(Request $request)
    {
        // dd($request);

        $contacts = new contactsModel;
        $contacts->customer_id = $request->customer_id;
        $contacts->name = $request->name;
        $contacts->tel = $request->tel;
        $contacts->line = $request->line;
        $contacts->messages = $request->messages;
        $contacts->save();
        return redirect()->back()->with('success', 'ส่งข้อมูลสำเร็จ !');
    }

    // public function helpcaractionPage(Request $request)
    // {
    //     dd($request)
        // $termcondition = DB::table('setting_option')->where('key_option', 'termcondition')->first();
        // return view('frontend/termcondition', [
        //     'default_pagename' => 'ข้อกำหนดในการให้บริการ',
        //     'termcondition' => $termcondition,
        // ]);
    // }


    public function termconditionPage()
    {
        $termcondition = DB::table('setting_option')->where('key_option', 'termcondition')->first();
        return view('frontend/termcondition', [
            'default_pagename' => 'ข้อกำหนดในการให้บริการ',
            'termcondition' => $termcondition,
        ]);
    }
    public function privacypolicyPage()
    {
        $privacypolicy = DB::table('setting_option')->where('key_option', 'privacypolicy')->first();
        return view('frontend/privacypolicy', [
            'default_pagename' => 'นโยบายความเป็นส่วนตัว',
            'privacypolicy' => $privacypolicy,
        ]);
    }

    public function indexPage(Request $request)
    {
        $categories = categoriesModel::all();
        $cars = DB::table('cars')
            ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 'customer.province as customer_proveince', 'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            ->orderBy('id', 'desc')
            ->get();

        $allcarcount = DB::table('cars')->count();
        $allcars6 = DB::table('cars')
            ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 
                'customer.province as customer_proveince', 'customer.place as customer_place', 
                'customer.map as customer_map', 'customer.google_map as customer_google_map', 
                'customer.phone as customer_phone', 'customer.line as customer_line', 
                'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();
        $qrybrand = brandsModel::get();

        $setFooterModel = setFooterModel::all();

        $decde = array();
        $slide = DB::table('setting_option')->where('key_option', 'slide')->first();
        if(isset($slide)){$decde = json_decode($slide->value_option);}
        
        $province = provincesModel::orderBy("name_th", "ASC")->get();

        return view('frontend/index-page', [
            'layout' => 'side-menu',
            'categories' => $categories,
            'cars' => $cars,
            'allcarcount' => $allcarcount,
            'allcars6' => $allcars6,
            'brand' => $qrybrand,
            'slide' => $decde,
            'setFooterModel' => $setFooterModel,
            'province' => $province
        ]);
    }
    public function profilePage()
    {
        $customerdata = session('customer');
        $customer_id = $customerdata->id;

        $mycars = DB::table('cars')
            ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->where('customer_id', $customer_id)
            ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 'customer.province as customer_proveince', 'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            ->orderBy('id', 'desc')
            ->get();

        $carfromstatus = array(
            'created' => [],
            'approved' => [],
            'rejected' => [],
            'expired' => [],
        );
        foreach($mycars as $keystatus => $carstatus){
            $carfromstatus[$carstatus->status][] = $carstatus;
        }

        return view('frontend/profile', [
            'customer_id' => $customer_id,
            'mycars' => $mycars,
            'carfromstatus' => $carfromstatus,
        ]);
    }
    public function profilecheckPage()
    {
        $customerdata = session('customer');
        $customer_id = $customerdata->id;

        $mycars = DB::table('cars')
            ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->where('customer_id', $customer_id)
            ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 'customer.province as customer_proveince', 'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            ->orderBy('id', 'desc')
            ->get();

        $carfromstatus = array(
            'created' => [],
            'approved' => [],
            'rejected' => [],
            'expired' => [],
        );
        foreach($mycars as $keystatus => $carstatus){
            $carfromstatus[$carstatus->status][] = $carstatus;
        }

        return view('frontend/profile-check', [
            'customer_id' => $customer_id,
            'mycars' => $mycars,
            'carfromstatus' => $carfromstatus,
        ]);
    }
    public function profileeditcarinfoPage()
    {
        $customerdata = session('customer');
        $customer_id = $customerdata->id;

        $mycars = DB::table('cars')
            ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->where('customer_id', $customer_id)
            ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 'customer.province as customer_proveince', 'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            ->orderBy('id', 'desc')
            ->get();

        $carfromstatus = array(
            'created' => [],
            'approved' => [],
            'rejected' => [],
            'expired' => [],
        );
        foreach($mycars as $keystatus => $carstatus){
            $carfromstatus[$carstatus->status][] = $carstatus;
        }

        return view('frontend/profile-editcarinfo', [
            'customer_id' => $customer_id,
            'mycars' => $mycars,
            'carfromstatus' => $carfromstatus,
        ]);
    }
    public function profileexpirePage()
    {
        $customerdata = session('customer');
        $customer_id = $customerdata->id;

        $mycars = DB::table('cars')
            ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->where('customer_id', $customer_id)
            ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 'customer.province as customer_proveince', 'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            ->orderBy('id', 'desc')
            ->get();

        $carfromstatus = array(
            'created' => [],
            'approved' => [],
            'rejected' => [],
            'expired' => [],
        );
        foreach($mycars as $keystatus => $carstatus){
            $carfromstatus[$carstatus->status][] = $carstatus;
        }

        return view('frontend/profile-expire', [
            'customer_id' => $customer_id,
            'mycars' => $mycars,
            'carfromstatus' => $carfromstatus,
        ]);
    }
    public function customercontactPage()
    {
        $customerdata = session('customer');
        $customer_id = $customerdata->id;

        $mycars = DB::table('cars')
            ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->where('customer_id', $customer_id)
            ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 'customer.province as customer_proveince', 'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            ->orderBy('id', 'desc')
            ->get();

        $carfromstatus = array(
            'created' => [],
            'approved' => [],
            'rejected' => [],
            'expired' => [],
        );
        foreach($mycars as $keystatus => $carstatus){
            $carfromstatus[$carstatus->status][] = $carstatus;
        }

        $contacts_back = contacts_backModel::where("customer_id", $customer_id)->get();

        $mycontacts = DB::table('contacts_back')
            ->leftjoin('cars', 'contacts_back.cars_id', '=', 'cars.id')
            // ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            // ->where('customer_id', $customer_id)
            ->select('contacts_back.*', 'cars.id as car_id', 'cars.modelyear as car_modelyear', 
                'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend/customer-contact', [
            'customer_id' => $customer_id,
            'mycars' => $mycars,
            'carfromstatus' => $carfromstatus,
            'contacts_back' => $mycontacts,
        ]);
    }
    /****************************************************************/
    /****************************************************************/
    /****************************************************************/

    public function cardetailPage(Request $request, $post)
    {
        $allcars = DB::table('cars')
            ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 'customer.province as customer_proveince', 'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            // ->orderBy('id', 'desc')
            ->take(12)
            ->get();

        $allcars2 = DB::table('cars')
            ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 'customer.province as customer_proveince', 'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            ->orderBy('id', 'desc')
            // ->random()
            ->take(4)
            ->get();

        $mycars = DB::table('cars')
            ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->where('cars.id', $post)
            ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 
                'customer.province as customer_proveince', 'customer.place as customer_place', 
                'customer.map as customer_map', 'customer.google_map as customer_google_map', 
                'customer.phone as customer_phone', 'customer.line as customer_line', 
                'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            ->orderBy('id', 'desc')
            ->first();

        $gallery = DB::table('gallery')->where('cars_id', $post)->get();
        $interior = [];
        $exterior = [];
        foreach($gallery as $gal){
            if($gal->type=='interior'){
                $interior[] = $gal;
            }
            if($gal->type=='exterior'){
                $exterior[] = $gal;
            }
        }
        $history = [];
        $customerdata = session('customer');
        if(isset($customerdata)){
            $Customer = Customer::find($customerdata->id);
            $history = $Customer->history;

            if($history){
                $jdecd = json_decode($history);
                if(is_array($jdecd)){
                    if(in_array($post, $jdecd)){
                        // if (($key = array_search($post, $jdecd)) !== false) {
                        //     unset($jdecd[$key]);
                        // }
                        $createloop = [];
                        foreach($jdecd as $keyloop => $loop){
                            if($loop != $post){
                                $createloop[] = $loop;
                            }
                        }
                        array_unshift($createloop,$post);

                        $jencd = json_encode($createloop, true);
                        $Customer->history = $jencd;
                        $Customer->update();
                        // $rrr = 'ccc';
                    }else{
                        array_unshift($jdecd,$post);

                        $jencd = json_encode($jdecd, true);
                        $Customer->history = $jencd;
                        $Customer->update();
                        // $rrr = 'dddd';
                    }
                    // $histry = '';
                    

                    
                    
                }
                    
            }else{
                $val_history = [];
                $val_history[] = $post;
                // $rrr = 'bbb';

                $jencd = json_encode($val_history, true);
                $Customer->history = $jencd;
                $Customer->update();
            }
        }
            
        
        
        

        $carcountget = carsModel::find($post);
        $oldcount = $carcountget->viewcount??0;
        $newcount = $oldcount+1;
        $carcountget->viewcount = $newcount;
        $carcountget->update();

        return view('frontend/car-detail', [
            'cars' => $mycars,
            'allcars' => $allcars,
            'allcars2' => $allcars2,
            'interior' => $interior,
            'exterior' => $exterior,
            'gallery' => $gallery,
            'gallery' => $gallery,
            // 'customerdata' => $rrr,
        ]);
    }

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
        $data = session('customer');
        $provinces = provincesModel::all();
        $Customer = Customer::find($data->id);
        
        return view('frontend/edit-profile', [
            'provinces' => $provinces,
            'Customer' => $Customer,
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
            $destinationPath = public_path('/uploads/profile/');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = 'profile-'.time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/profile/'.$newfilenam;

            $Customer->image = $filepath;
        }
        if($request->hasFile('map')){

            $oldPath = public_path($Customer->map);
            if(File::exists($oldPath)){
                File::delete($oldPath);
            }

            $file = $request->file('map');
            $destinationPath = public_path('/uploads/map/');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = 'map-'.time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/map/'.$newfilenam;

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
    
    public function carPage()
    {
        $brand = brandsModel::orderBy("sort_no", "ASC")->get();

        $qrycar = carsModel::rightJoin('brands', 'cars.brand_id', 'brands.id')
        ->rightJoin('models', 'cars.model_id', 'models.id')
        ->rightJoin('sub_models', 'cars.sub_models_id', 'sub_models.id')
        ->rightJoin('generations', 'cars.generations_id', 'generations.id')
        ->select("cars.*", "brands.title as brand_name", "models.model as model_name", "sub_models.sub_models as submodel_name", "generations.generations as generation_name")
        ->orderBy("cars.modelyear", "DESC")
        ->orderBy("cars.created_at", "DESC")
        ->paginate(10);

        $province = provincesModel::orderBy("name_th", "ASC")->get();

        return view('frontend/car', [
            "brand" => $brand,
            "cars" => $qrycar,
            "province" => $province
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
    public function loginPage(Request $request)
    {
        function ranInt(){
            $codetosend = random_int(100000,999999);
            return $codetosend;
        }

        $browserFingerprint = $request->session()->get('browserFingerprint');
        // $request->session()->put('customer', 'Error');
        if (!$browserFingerprint) {
            do {
                $codetosend = ranInt();
                $exists = Sms_session::where("browserFingerprint", $codetosend)->exists();
            } while ($exists);
            $request->session()->put('browserFingerprint', $codetosend);
            // $request->session()->put('customer', 'empty');
        }
        // else{
            // $getcustomersession = Sms_session::where([
            //     ['browserFingerprint', '=', $browserFingerprint],
            // ])->first();
            // if(isset($getcustomersession->id)){
            //     $customer = Customer::where("id", $getcustomersession->customer_id)->first();
            //     $request->session()->put('customer', $customer);
            // }
            
        // }
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

    public function popupcarsearchmodel(Request $request, $id) {
        $qrymodel = modelsModel::where("brand_id", $id)->get();
        return response()->json($qrymodel);
    }

    public function popupcarsearchgeneration(Request $request, $id) {
        $qrygenertion = generationsModel::where("models_id", $request->models_id)->get();
        return response()->json($qrygenertion);
    }

    public function popupcarsearchsubmodel(Request $request, $id) {
        $qrysubmodel = sub_modelsModel::where("generations_id", $request->generations_id)->get();
        return response()->json($qrysubmodel);
    }

    public function clearsessioncustomer() {
        session()->forget('customer_session');
        session()->flush();
        return redirect("/");
    }

    public function searchbrandtext($brand_name) {
        if ($brand_name != "all") {
            $qrybrand = brandsModel::select("brands.title", "brands.id")
            ->where("brands.title", "like", "%".$brand_name."%")
            ->orderBy("sort_no", "ASC")
            ->get();
        }
        else {
            $qrybrand = brandsModel::select("brands.title", "brands.id")
            ->orderBy("sort_no", "ASC")
            ->get();
        }
        return response()->json($qrybrand);
    }

    public function searchmodeltext($brand_id, $model_name) {
        if ($model_name != "all") {
            $qrymodel = modelsModel::select("model", "id")
            ->where("brand_id", $brand_id)
            ->where("model", "like", "%".$model_name."%")
            ->get();
        }
        else {
            $qrymodel = modelsModel::select("model", "id")
            ->where("brand_id", $brand_id)
            ->get();
        }
        return response()->json($qrymodel);
    }

    public function searchgenerationtext($model_id, $generation_name) {
        if ($generation_name != "all") {
            $qrygeneration = generationsModel::select("generations", "id")
            ->where("models_id", $model_id)
            ->where("generations", "like", "%".$generation_name."%")
            ->get();
        }
        else {
            $qrygeneration = generationsModel::select("generations", "id")
            ->where("models_id", $model_id)
            ->get();
        }
        return response()->json($qrygeneration);
    }

    public function searchsubmodeltext($generation_id, $submodel_name) {
        if ($submodel_name != "all") {
            $qrysubmodel = sub_modelsModel::select("sub_models", "id")
            ->where("generations_id", $generation_id)
            ->where("sub_models", "like", "%".$submodel_name."%")
            ->get();
        }
        else {
            $qrysubmodel = sub_modelsModel::select("sub_models", "id")
            ->where("generations_id", $generation_id)
            ->get();
        }
        return response()->json($qrysubmodel);
    }

    // public function search($brand_id, $model_id, $generation_id, $submodel_id, $evtype, $payment, $pricelow, $pricehigh, $color, $gear, $power, $province_id) {
    //     // return "brand = ".$brand_id;
    //     // $brand_id = 1; // BMW
    //     // $model_id = 25; // X1
    //     $qrycar = carsModel::rightJoin('brands', 'cars.brand_id', 'brands.id')
    //     ->rightJoin('models', 'cars.model_id', 'models.id')
    //     ->rightJoin('sub_models', 'cars.sub_models_id', 'sub_models.id')
    //     ->rightJoin('generations', 'cars.generations_id', 'generations.id')
    //     ->when($model_id, function ($query, $model_id) {
    //         return $query->where('cars.model_id', $model_id);
    //     })
    //     ->when($brand_id, function ($query, $brand_id) {
    //         return $query->where('cars.brand_id', $brand_id);
    //     })
    //     ->select("cars.*", "brands.title as brand_name", "models.model as model_name", "sub_models.sub_models as submodel_name", "generations.generations as generation_name")
    //     ->orderBy("cars.modelyear", "DESC")
    //     ->orderBy("cars.created_at", "DESC")
    //     ->get();

    //     return response()->json($qrycar);
    // }

    public function search(Request $request, $brand_id, $model_id, $generation_id, $submodel_id, $evtype, $payment, $pricelow, $pricehigh, $color, $gear, $power, $province_id, $yearlow, $yearhigh) {
        // return "brand = ".$brand_id." model = ".$model_id." generation = ".$generation_id." submodel = ".$submodel_id." payment = ".$payment." pricelow = ".$pricelow." pricehigh = ".$pricehigh;
        if ($pricelow == "ต่ำสุด") {
            $pricelow = null;
        }
        if ($pricehigh == "สูงสุด") {
            $pricehigh = null;
        }

        if($request->ajax()){
            $cars = carsModel::rightJoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->rightJoin('models', 'cars.model_id', '=', 'models.id')
            ->rightJoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->rightJoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->when($brand_id !== null, function ($query) use ($brand_id) {
                return $query->where('brands.brand_id', $brand_id);
            })
            ->when($model_id !== null, function ($query) use ($model_id) {
                return $query->where('models.model_id', $model_id);
            })
            ->when($generation_id !== null, function ($query) use ($generation_id) {
                return $query->where('generations.generation_id', $generation_id);
            })
            ->when($submodel_id !== null, function ($query) use ($submodel_id) {
                return $query->where('sub_models.submodel_id', $submodel_id);
            })
            ->when($pricelow && $pricehigh, function ($query) use ($pricelow, $pricehigh) {
                return $query->whereBetween('cars.price', [$pricelow, $pricehigh]);
            })
            ->select(
                'cars.*',
                'brands.title as brand_name',
                'models.model as model_name',
                'sub_models.sub_models as submodel_name',
                'generations.generations as generation_name'
            )
            ->orderBy('cars.modelyear', 'DESC')
            ->orderBy('cars.created_at', 'DESC')
            ->paginate(10);


            // ->toSql();

            // return dd($cars);

            $brand = brandsModel::orderBy("sort_no", "ASC")->get();

            $province = provincesModel::orderBy("name_th", "ASC")->get();
            return view('frontend/car-child', compact("cars", "brand", "province"))->render();
        }


        $cars = carsModel::rightJoin('brands', 'cars.brand_id', '=', 'brands.id')
        ->rightJoin('models', 'cars.model_id', '=', 'models.id')
        ->rightJoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
        ->rightJoin('generations', 'cars.generations_id', '=', 'generations.id')
        ->when($brand_id !== null, function ($query) use ($brand_id) {
            return $query->where('brands.brand_id', $brand_id);
        })
        ->when($model_id !== null, function ($query) use ($model_id) {
            return $query->where('models.model_id', $model_id);
        })
        ->when($generation_id !== null, function ($query) use ($generation_id) {
            return $query->where('generations.generation_id', $generation_id);
        })
        ->when($submodel_id !== null, function ($query) use ($submodel_id) {
            return $query->where('sub_models.submodel_id', $submodel_id);
        })
        ->when($pricelow && $pricehigh, function ($query) use ($pricelow, $pricehigh) {
            return $query->whereBetween('cars.price', [$pricelow, $pricehigh]);
        })
        ->select(
            'cars.*',
            'brands.title as brand_name',
            'models.model as model_name',
            'sub_models.sub_models as submodel_name',
            'generations.generations as generation_name'
        )
        ->orderBy('cars.modelyear', 'DESC')
        ->orderBy('cars.created_at', 'DESC')
        ->paginate(10);

    


        $brand = brandsModel::orderBy("sort_no", "ASC")->get();

        $province = provincesModel::orderBy("name_th", "ASC")->get();

        return view('frontend/car', [
            "brand" => $brand,
            "cars" => $qrycar,
            "province" => $province
        ]);
    }

    public function brandev() {
        $qrybrandev = brandsModel::leftJoin('models', 'brands.id', 'models.brand_id')
        ->select("brands.id", "brands.title")
        ->where("models.evtype", 1)
        ->groupBy("brands.id", "brands.title")
        ->orderBy("brands.sort_no", "ASC")
        ->get();
        return response()->json($qrybrandev);
    }

    public function brandnotev() {
        $qrybrandnotev = brandsModel::leftJoin('models', 'brands.id', 'models.brand_id')
        ->select("brands.id", "brands.title")
        ->where("models.evtype", 0)
        ->groupBy("brands.id", "brands.title")
        ->orderBy("brands.sort_no", "ASC")
        ->get();
        return response()->json($qrybrandnotev);
    }
    
}
