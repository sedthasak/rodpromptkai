<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\provincesModel;
use App\Models\modelsModel;
use App\Models\brandsModel;
use App\Models\generationsModel;
use App\Models\sub_modelsModel;
use App\Models\carsModel;
use App\Models\Customer;

class PostsController extends Controller
{
    public function BN_posts()
    {
        return view('backend/post', [ 
            'default_pagename' => 'โพสท์ลงขายรถ',
            
        ]);
    }
    public function BN_posts_add(Request $request)
    {
        $provinces = provincesModel::all();
        $brands = brandsModel::all();
        $customer = Customer::all();

        return view('backend/post-add', [ 
            'default_pagename' => 'เพิ่มโพสท์ลงขายรถ',
            'provinces' => $provinces,
            'brands' => $brands,
            'customer' => $customer,
        ]);
    }
    public function BN_posts_add_action(Request $request)
    {
        // dd($request);

        $cars = new carsModel;

        $cars->type = $request->type;
        $cars->customer_id = $request->customer_id;
        $cars->brand_id = $request->brand_id;
        $cars->model_id = $request->model_id;
        $cars->generations_id = $request->generations_id;
        $cars->sub_models_id = $request->sub_models_id;
        $cars->modelyear = $request->modelyear;
        $cars->mileage = $request->mileage;
        $cars->vehicle_code = $request->vehicle_code;
        $cars->title = $request->title;
        $cars->price = $request->price;
        $cars->licenseplate = $request->licenseplate;
        $cars->status = 'created';
        

        if($request->hasFile('feature')){
            $feature = $request->file('feature');
            $destinationPath = public_path('/uploads/feature');
            $filename = $feature->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = 'feature-'.time() . '.' .$ext;
            $feature->move($destinationPath, $newfilenam);
            $filepath = 'uploads/feature/'.$newfilenam;
            $cars->feature = $filepath;
        }
        if($request->hasFile('licenseplate')){
            $licenseplate = $request->file('licenseplate');
            $destinationPath = public_path('/uploads/licenseplate');
            $filename = $licenseplate->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = 'licenseplate-'.time() . '.' .$ext;
            $licenseplate->move($destinationPath, $newfilenam);
            $filepath = 'uploads/licenseplate/'.$newfilenam;
            $cars->licenseplate = $filepath;
        }
        if($request->hasFile('exterior')){
            $exterior_image = $request->file('exterior');
            foreach($exterior_image as $keyex => $extr){
                $exterior = $extr;
                $destinationPath = public_path('/uploads/exterior');
                $filename = $exterior->getClientOriginalName();

                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $newfilenam = 'exterior-'.time().'-'.$keyex.'.' .$ext;
                $exterior->move($destinationPath, $newfilenam);
                $filepath = 'uploads/exterior/'.$newfilenam;
                // $cars->licenseplate = $filepath;
            }
        }
        if($request->hasFile('interior')){
            $interior_image = $request->file('interior');
            foreach($interior_image as $keyex => $extr){
                $interior = $extr;
                $destinationPath = public_path('/uploads/interior');
                $filename = $interior->getClientOriginalName();

                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $newfilenam = 'interior-'.time().'-'.$keyex.'.' .$ext;
                $interior->move($destinationPath, $newfilenam);
                $filepath = 'uploads/interior/'.$newfilenam;
                // $cars->licenseplate = $filepath;
            }
        }

        $cars->save();

        // $cars2 = carsModel::find($cars->id);
        // $cars2->update();
        $carpost_id = $cars->id;
       
        return redirect(route('BN_posts'))->with('success', 'บันทึกสำเร็จ !');
    }
    public function BN_postsFetch()
    {
        $query = carsModel::all()->sortDesc();
        $output = '';
        if($query->count() > 0){
            foreach($query as $key => $res){
                ?>
                <tr class="intro-x">
                    <td>
                        <a href="" class="font-medium whitespace-nowrap"><?php echo date('d/m/Y', strtotime($res->created_at)) ?></a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"><?php echo date('H:i:s', strtotime($res->created_at)) ?> น.</div>
                    </td>
                    <td>
                        <a href="" class="font-medium whitespace-nowrap">ชนะพล สายนิพนธ์</a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">ดีลเลอร์</div>
                    </td>
                    <td>
                        <a href="" class="font-medium whitespace-nowrap">2016 Honda CR-V</a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">CR-V 2.0 E (MY12) (MNC)</div>
                    </td>
                    <td class="text-center"><?php echo $res->price ?> ฿</td>
                    <td class="w-40">
                        <div class="flex items-center justify-center text-success">
                            <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> อนุมัติ
                        </div>
                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="#">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> แก้ไข
                            </a>
                            <a class="flex items-center mr-3" href="#">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> ดูโพสท์
                            </a>
                            
                        </div>
                    </td>
                </tr>
                <?php
            }  
        }else{
            ?>
            <tr class="intro-x">  
                <td colspan="6" class="px-5 py-3 dark:border-darkmode-300 border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">Not Found!!!</td>
            </tr>
            <?php
        }
    }
}
