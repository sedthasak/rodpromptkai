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
use App\Models\galleryModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;

class PostController extends Controller
{

    public function carpostregisterSubmitPage(Request $request) {

        // $exterior = $request->file('exterior');
        // $exteriorDropzone = $request->file('exteriorDropzone');
        // foreach(){

        // }
        // dd($exterior);

        $cars = new carsModel;

        $cars->type = $request->type;
        $cars->customer_id = $request->customer_id;
        $cars->brand_id = $request->brands;
        $cars->model_id = $request->models;
        $cars->generations_id = $request->generations;
        $cars->sub_models_id = $request->sub_models;
        $cars->modelyear = $request->years;
        $cars->mileage = $request->mileage;
        $cars->vehicle_code = $request->vehicle_code;
        $cars->title = $request->title;
        $cars->price = $request->price;
        $cars->licenseplate = $request->licenseplate;
        $cars->status = 'created';
        $cars->save();

        if($request->picture_feature){
            // $feature = $request->file('picture_feature');
            // $destinationPath = public_path('/uploads/feature');
            // $filename = $feature->getClientOriginalName();

            // $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            // $newfilenam = 'feature-'.time() . '.' .$ext;
            // $feature->move($destinationPath, $newfilenam);
            // $filepath1 = 'uploads/feature/'.$newfilenam;

            $string_pieces = explode( ";base64,", $request->picture_feature);
         
            $image_type_pieces = explode( "image/", $string_pieces[0] );
         
            $image_type = $image_type_pieces[1];

            // Decode the base64 string and save the image
            $imageData = base64_decode($string_pieces[1]);
            
            // Generate a unique filename
            $filename = 'feature-'.time() . '.' .$image_type;

            // Define the path where you want to save the image
            $path = public_path('uploads/feature/' . $filename);
            $filepath1 = 'uploads/feature/' . $filename;

            // Save the image to the defined path
            file_put_contents($path, $imageData);
            carsModel::where("id", $cars->id)->update(["feature" => $filepath1]);
        }
        if($request->hasFile('licenseplate')){
            $licenseplate = $request->file('licenseplate');
            $destinationPath = public_path('/uploads/licenseplate');
            $filename = $licenseplate->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = 'licenseplate-'.time() . '.' .$ext;
            $licenseplate->move($destinationPath, $newfilenam);
            $filepath2 = 'uploads/licenseplate/'.$newfilenam;
            carsModel::where("id", $cars->id)->update(["licenseplate" => $filepath2]);
        }
        

        if($request->picture_exterior){
            $exterior_image = $request->picture_exterior;
            foreach($request->picture_exterior as $keyex => $extr){
                // Decode the base64 string and save the image
                
                $string_pieces = explode( ";base64,", $extr);
            
                $image_type_pieces = explode( "image/", $string_pieces[0] );
            
                $image_type = $image_type_pieces[1];

                $imageData = base64_decode($string_pieces[1]);

                // Generate a unique filename
                $filename = 'exterior-'.time() . '.' .$image_type;

                // Define the path where you want to save the image
                $path = public_path('uploads/exterior/' . $filename);
                $filepath = 'uploads/exterior/' . $filename;

                // Save the image to the defined path
                file_put_contents($path, $imageData);

                $gallery = new galleryModel;
                $gallery->cars_id = $cars->id;
                $gallery->gallery = $filepath;
                $gallery->type = 'exterior';
                $gallery->save();
            }
        }
        if($request->picture_interior){
            $interior_image = $request->picture_interior;
            foreach($request->picture_interior as $keyin => $intr){

                $string_pieces = explode( ";base64,", $intr);
            
                $image_type_pieces = explode( "image/", $string_pieces[0] );
            
                $image_type = $image_type_pieces[1];

                // Decode the base64 string and save the image
                $imageData = base64_decode($string_pieces[1]);

                // Generate a unique filename
                $filename = 'interior-'.time() . '.' .$image_type;

                // Define the path where you want to save the image
                $path = public_path('uploads/interior/' . $filename);
                $filepath = 'uploads/interior/' . $filename;

                // Save the image to the defined path
                file_put_contents($path, $imageData);
                
                $gallery = new galleryModel;
                $gallery->cars_id = $cars->id;
                $gallery->gallery = $filepath;
                $gallery->type = 'interior';
                $gallery->save();
            }
        }

        $cars2 = carsModel::find($cars->id);
        $strtotime = strtotime($cars2->created_at);

        $cars2->ref_code = $strtotime.$cars2->customer_id;
        $cars2->update();

        return redirect(route('carpostregistersuccessPage'));
    }


    public function carpostSelectBrand(Request $request) {

        $ech = '';
        $query = DB::table('models')->where('brand_id', $request->brands_id)->get();
        if($query){
            $ech .= '<option value="">เลือกรุ่น</option>';
            foreach($query as $key => $res){
                $ech .= '<option value="'.$res->id.'">'.$res->model.'</option>';
            }
        }
        return response()->json($ech);
    }
    public function carpostSelectModel(Request $request) {

        $ech = '';
        $query = DB::table('generations')->where('models_id', $request->models_id)->get();
        if($query){
            $ech = '<option value="">เลือกโฉม</option>';
            foreach($query as $key => $res){
                $ech .= '<option value="'.$res->id.'">'.$res->generations.'</option>';
            }
        }
        return response()->json($ech);
    }
    public function carpostSelectGenerations(Request $request) {

        $ech = '';
        $query = DB::table('sub_models')->where('generations_id', $request->generations_id)->get();
        if($query){
            $ech = '<option value="">เลือกรุ่นย่อย</option>';
            foreach($query as $key => $res){
                $ech .= '<option value="'.$res->id.'">'.$res->sub_models.'</option>';
            }
        }
        return response()->json($ech);
    }
    public function carpostSelectGenerationsYear(Request $request) {

        $ech = '';
        $query = DB::table('generations')->where('id', $request->generations_id)->first();
        if($query){
            $ech = '<option value="">เลือกรุ่นปี</option>';
            for($y=$query->yearlast;$y>=$query->yearfirst;$y--){
                $ech .= '<option value="'.$y.'">'.$y.'</option>';
            }
        }
        return response()->json($ech);
    }

    public function carpostregistersuccessPage()
    {
        $provinces = provincesModel::all();
        $brands = brandsModel::all();
        // $models = modelsModel::all();
        // $query = DB::table('generations')->where('id', 1)->first();
        return view('frontend/carpost-register-success', [
            'provinces' => $provinces,
            'brands' => $brands,
            // 'query' => $query,
            // 'a' => 'test',
        ]);
    }
    public function carpostregisterPage()
    {
        $provinces = provincesModel::all();
        $brands = brandsModel::all();
        // $models = modelsModel::all();
        // $query = DB::table('generations')->where('id', 1)->first();
        return view('frontend/carpost-register', [
            'provinces' => $provinces,
            'brands' => $brands,
            // 'query' => $query,
            // 'a' => 'test',
        ]);
    }

    public function carpoststep1Page()
    {
        $provinces = provincesModel::all();
        $brands = brandsModel::all();
        $models = modelsModel::all();
        return view('frontend/carpost-step1', [
            'provinces' => $provinces,
            'brands' => $brands,
            'models' => $models,
            'a' => 'test',
        ]);
    }
}
