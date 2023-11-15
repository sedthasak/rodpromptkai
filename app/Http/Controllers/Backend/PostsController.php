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
use App\Models\galleryModel;

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
        $models = modelsModel::all();
        $generations = generationsModel::all();
        $sub_models = sub_modelsModel::all();
        $customer = Customer::all();

        return view('backend/post-add', [ 
            'default_pagename' => 'เพิ่มโพสท์ลงขายรถ',
            'provinces' => $provinces,
            'brands' => $brands,
            'models' => $models,
            'generations' => $generations,
            'sub_models' => $sub_models,
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
        $cars->save();
        $carpost_id = $cars->id;

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

                $gallery = new galleryModel;
                $gallery->cars_id = $carpost_id;
                $gallery->gallery = $filepath;
                $gallery->type = 'exterior';
                $gallery->save();
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
                
                $gallery = new galleryModel;
                $gallery->cars_id = $carpost_id;
                $gallery->gallery = $filepath;
                $gallery->type = 'interior';
                $gallery->save();
            }
        }

        

        // $cars2 = carsModel::find($cars->id);
        // $cars2->update();
        
       
        return redirect(route('BN_posts'))->with('success', 'บันทึกสำเร็จ !');
    }
    public function BN_postsFetch()
    {
        $query = DB::table('cars')
            ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
            ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->leftjoin('models', 'cars.model_id', '=', 'models.id')
            ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
            ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
            ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 'brands.title as brands_title', 'models.model as model_name', 
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
            ->orderBy('id', 'desc')
            ->get();
        $output = '';

        $arrrole = array(
            'home' => 'ลูกค้าทั่วไป',
            'dealer' => 'นายหน้า',
            'lady' => '',
        );

        // echo "<pre>";
        // print_r($query);
        // echo "</pre>";
        if($query->count() > 0){
            foreach($query as $key => $res){
                ?>
                <tr class="intro-x">
                    <td>
                        <a href="" class="font-medium whitespace-nowrap"><?php echo date('d/m/Y', strtotime($res->created_at)) ?></a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"><?php echo date('H:i:s', strtotime($res->created_at)) ?> น.</div>
                    </td>
                    <td>
                        <a href="" class="font-medium whitespace-nowrap"><?php echo $res->firstname." ".$res->lastname ?></a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"><?php echo $arrrole[$res->sp_role] ?></div>
                    </td>
                    <td>
                        <a href="" class="font-medium whitespace-nowrap"><?php echo $res->modelyear." ".$res->brands_title." ".$res->model_name ?></a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"><?php echo $res->generations_name." ".$res->sub_models_name ?></div>
                    </td>
                    <td class="text-center"><?php echo  number_format($res->price, 2, '.', ',') ?> ฿</td>
                    <td class="w-40">
                        <div class="flex items-center justify-center text-default">
                            <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติ
                        </div>
                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <!-- <a class="flex items-center mr-3" href="#">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> แก้ไข
                            </a> -->
                            <a class="flex items-center mr-3" href="<?php echo route('BN_posts_detail', ['id' => $res->id]); ?>">
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

    public function BN_posts_detail(Request $request, $id)
    {
        // $postcar = brandsModel::find($id);
        // $postcar = modelsModel::find($id);
        // $postcar = generationsModel::find($id);
        // $postcar = sub_modelsModel::find($id);
        // $postcar = Customer::find($id);
        // $postcar = galleryModel::find($id);
        $postcar = carsModel::find($id);
        $customer = DB::table('customer')->where('id', $postcar->customer_id)->first();
        $brands = DB::table('brands')->where('id', $postcar->brand_id)->first();
        $models = DB::table('models')->where('id', $postcar->model_id)->first();
        $generations = DB::table('generations')->where('id', $postcar->generations_id)->first();
        $sub_models = DB::table('sub_models')->where('id', $postcar->sub_models_id)->first();
        $users = DB::table('users')->where('id', $postcar->user_id)->first();

            
        return view('backend/post-detail', [ 
            'default_pagename' => 'รายละเอียดโพสท์ลงขายรถ',
            'postcar' => $postcar,
            'customer' => $customer,
            'brands' => $brands,
            'models' => $models,
            'generations' => $generations,
            'sub_models' => $sub_models,
            'users' => $users,
        ]);
    }





    public function BN_posts_edit(Request $request, $id)
    {
        // $categories = categoriesModel::find($id);
        // return view('backend/categories-edit', [ 
        //     'default_pagename' => 'แก้ไขหมวดหมู่',
        //     'categories' => $categories,
        // ]);
    }
    public function BN_posts_edit_action(Request $request)
    {
        // $categories = categoriesModel::find($request->id);
        // if($request->hasFile('feature')){

        //     $oldPath = public_path($categories->feature);
        //     if(File::exists($oldPath)){
        //         File::delete($oldPath);
        //     }

        //     $file = $request->file('feature');
        //     $destinationPath = public_path('/uploads');
        //     $filename = $file->getClientOriginalName();

        //     $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        //     $newfilenam = time() . '.' .$ext;
        //     $file->move($destinationPath, $newfilenam);
        //     $filepath = 'uploads/'.$newfilenam;

        //     $categories->feature = $filepath;
        // }
        
        // $categories->name = $request->name;
        // $categories->description = $request->description;
        
        // $categories->update();

        // if(isset($categories->id)){
        //     $usersavelog = auth()->user();
        //     $idsavelog = auth()->user()->id; 
        //     $emailsavelog = auth()->user()->email;
        //     $para = array(
        //         'part' => 'backend',
        //         'user' => $idsavelog,
        //         'ref' => $categories->id,
        //         'remark' => 'User '.$idsavelog.' Update Category!',
        //         'event' => 'update category',
        //     );
        //     $result = (new LogsSaveController)->create_log($para);
        // }

        // return redirect(route('BN_categories', ['id' => $categories->id]));

    }
}
