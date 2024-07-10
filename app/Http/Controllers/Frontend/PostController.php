<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str; // Import Str class here
use App\Models\Customer;
use App\Models\Sms_session;
use App\Models\provincesModel;
use App\Models\brandsModel;
use App\Models\modelsModel;
use App\Models\carsModel;
use App\Models\galleryModel;
use App\Models\noticeModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;
use Image;
use App\Models\TestCreate;
use App\Models\TestCreateUpload;
use App\Jobs\ProcessFileUpload;

use App\Jobs\ProcessCarImages;

class PostController extends Controller
{
    public function carpostbrowseeditsubmit(Request $request, $id)
    {
        // Validate incoming image paths
        $request->validate([
            'image_paths' => 'nullable|array',
            'image_paths.*' => 'nullable|string',
            'interior_paths' => 'nullable|array',
            'interior_paths.*' => 'nullable|string',
            'registration_paths' => 'nullable|array',
            'registration_paths.*' => 'nullable|string',
        ]);

        // Retrieve the existing post
        $post = TestCreate::findOrFail($id);

        // Get old images associated with the post
        $oldImages = TestCreateUpload::where('test_create_id', $id)->get();

        // Delete old images from storage and database
        foreach ($oldImages as $oldImage) {
            Storage::delete('public/' . $oldImage->path);
            $oldImage->delete();
        }

        // Process exterior images
        if ($request->has('image_paths')) {
            $this->processImages($request->image_paths, 'exterior', $post->id);
        }

        // Process interior images
        if ($request->has('interior_paths')) {
            $this->processImages($request->interior_paths, 'interior', $post->id);
        }

        // Process registration image
        if ($request->has('registration_paths')) {
            $this->processImages($request->registration_paths, 'registration', $post->id);
        }

        // Redirect back to the car post browse page with success message
        return redirect()->route('carpostbrowse')->with('success', 'Post updated successfully.');
    }

    // Process exterior and interior images
    private function processImages($paths, $type, $postId)
    {
        foreach ($paths as $index => $path) {
            // Source file path
            $sourcePath = storage_path('app/public/' . $path);

            // Verify if source file exists
            if (!file_exists($sourcePath)) {
                throw new \Exception("Failed to move {$type} image: Source file not found.");
            }

            // Destination directory
            $destinationDir = storage_path('app/public/uploads/' . $type . '/' . $postId);
            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0777, true);
            }

            // Generate a unique filename with post ID, type, and sequence number
            $newFilename = $type . '-' . $postId . '-' . ($index + 1) . '-' . uniqid() . '.' . pathinfo($path, PATHINFO_EXTENSION);
            $destinationPath = $destinationDir . '/' . $newFilename;

            // Move file
            if (!rename($sourcePath, $destinationPath)) {
                throw new \Exception("Failed to move {$type} image: File move operation failed.");
            }

            // Update database with new path
            TestCreateUpload::create([
                'test_create_id' => $postId,
                'path' => 'uploads/' . $type . '/' . $postId . '/' . $newFilename,
                'type' => $type,
            ]);
        }
    }
    public function carpostbrowseedit($id)
    {
        // Retrieve existing post data and related images
        $post = TestCreate::findOrFail($id);
        $images = TestCreateUpload::where('test_create_id', $id)->orderBy('id')->get();
        $registrationImage = TestCreateUpload::where('test_create_id', $id)->where('type', 'registration')->first();

        // Copy images to the 'rest' folder and group them by type (exterior or interior)
        $restImages = $this->copyImagesToRest($images, $registrationImage);

        return view('frontend.carpost-browse-edit', compact('post', 'restImages'));
    }

    // Copy images to the 'rest' folder without changing their names
    private function copyImagesToRest($images, $registrationImage)
    {
        $exteriorImages = [];
        $interiorImages = [];
        $registrationImagePath = null;

        foreach ($images as $image) {
            $currentPath = 'public/' . $image->path;
            $restPath = 'public/uploads/rest/' . basename($image->path);

            if (Storage::exists($currentPath)) {
                try {
                    Storage::copy($currentPath, $restPath);
                    if ($image->type === 'exterior') {
                        $exteriorImages[] = 'uploads/rest/' . basename($image->path);
                    } elseif ($image->type === 'interior') {
                        $interiorImages[] = 'uploads/rest/' . basename($image->path);
                    }
                } catch (\Exception $e) {
                    // Handle errors if needed
                    // return redirect()->back()->with('error', 'Failed to copy one or more images to rest folder.');
                }
            }
        }

        if ($registrationImage) {
            $currentPath = 'public/' . $registrationImage->path;
            $restPath = 'public/uploads/rest/' . basename($registrationImage->path);

            if (Storage::exists($currentPath)) {
                try {
                    Storage::copy($currentPath, $restPath);
                    $registrationImagePath = 'uploads/rest/' . basename($registrationImage->path);
                } catch (\Exception $e) {
                    // Handle errors if needed
                }
            }
        }

        return ['exterior' => $exteriorImages, 'interior' => $interiorImages, 'registration' => $registrationImagePath ? [$registrationImagePath] : []];
    }

    public function carpostuploadimage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:12288', // Max 12MB
            'type' => 'required|in:exterior,interior,registration', // Validate type: exterior or interior
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = $request->type . '-' . uniqid() . '.' . $extension;

        // Save original image to temporary 'rest' directory
        $path = $request->file('image')->storeAs('public/uploads/rest', $filename);

        // Check if the uploaded file is not already in WebP format
        if ($extension !== 'webp') {
            // Convert the image to WebP format
            $webpPath = $this->convertToWebP($path);

            // Delete the original file after conversion to WebP
            Storage::delete($path);

            // Return the path to the WebP image
            return response()->json(['path' => str_replace('public/', '', $webpPath)]);
        }

        return response()->json(['path' => str_replace('public/', '', $path)]);
    }
    private function convertToWebP($path)
    {
        // Generate a new filename with .webp extension
        $newPath = str_replace('.' . pathinfo($path, PATHINFO_EXTENSION), '.webp', $path);

        // Convert the image to WebP format using Intervention Image
        $image = Image::make(storage_path('app/' . $path));
        $image->save(storage_path('app/' . $newPath), 80, 'webp');

        // Return the path to the converted WebP image
        return $newPath;
    }
    public function carpostbrowsesubmit(Request $request)
    {
        // Validate image paths
        $request->validate([
            'image_paths' => 'required|array',
            'image_paths.*' => 'required|string',
            'interior_paths' => 'sometimes|array',
            'interior_paths.*' => 'sometimes|string',
            'registration_paths' => 'sometimes|array',
            'registration_paths.*' => 'sometimes|string',
        ]);

        // Create the post
        $testCreate = TestCreate::create([
            'number' => uniqid(),
        ]);

        
        // Move and rename exterior images
        $this->moveAndRenameFiles($request->image_paths, $testCreate->id, 'exterior');

        // Move and rename interior images
        if ($request->has('interior_paths')) {
            $this->moveAndRenameFiles($request->interior_paths, $testCreate->id, 'interior');
        }

        // Move and rename registration image (only one image)
        if ($request->has('registration_paths')) {
            $this->moveAndRenameFiles($request->registration_paths, $testCreate->id, 'registration');
        }

        return redirect()->route('carpostbrowse')->with('success', 'Post '.$testCreate->id.' created successfully.');
    }
    public function moveAndRenameFiles($paths, $postId, $type)
    {
        try {
            foreach ($paths as $key => $path) {
                // Source file path
                $sourcePath = storage_path('app/public/' . $path);
                Log::info("Source path: " . $sourcePath);

                // Destination directory
                $destinationDir = storage_path('app/public/uploads/' . $type . '/' . $postId);
                if (!file_exists($destinationDir)) {
                    mkdir($destinationDir, 0777, true);
                }
                Log::info("Destination directory: " . $destinationDir);

                // Generate a unique filename with post ID, type, and sequence number
                $newFilename = $type . '-' . $postId . '-' . ($key + 1) . '-' . uniqid() . '.' . pathinfo($path, PATHINFO_EXTENSION);
                $destinationPath = $destinationDir . '/' . $newFilename;
                Log::info("Destination path: " . $destinationPath);

                // Move file
                if (!rename($sourcePath, $destinationPath)) {
                    Log::error("Failed to move file from $sourcePath to $destinationPath");
                    throw new \Exception('Failed to move one or more images.');
                }

                // Update the path in the array to the new location
                $paths[$key] = 'uploads/' . $type . '/' . $postId . '/' . $newFilename;

                // Update database with new path
                TestCreateUpload::create([
                    'test_create_id' => $postId,
                    'path' => $paths[$key],
                    'type' => $type,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error in moveAndRenameFiles: ' . $e->getMessage());
            throw new \Exception('Failed to move one or more images.');
        }

        return $paths;
    }
    public function carpostdeleteimage(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        // Ensure the path matches the storage location
        $filePath = str_replace('/storage', 'public', $request->path); // Adjust the path if necessary

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'File not found']);
        }
    }
    
    public function carpostbrowse(Request $request)
    {
        $provinces = provincesModel::all();
        $brands = brandsModel::orderBy("sort_no", "ASC")->get();
        return view('frontend/carpost-browse', [
            'provinces' => $provinces,
            'brands' => $brands,
        ]);
    }



    public function carpostregisterPage()
    {
        $provinces = provincesModel::all();
        $brands = brandsModel::orderBy("sort_no", "ASC")->get();
        // $models = modelsModel::all();
        // $query = DB::table('generations')->where('id', 1)->first();


        return view('frontend/carpost-register', [
            'provinces' => $provinces,
            'brands' => $brands,
            // 'query' => $query,
            // 'a' => 'test',
        ]);
    }





















    public function carpostregistertestuploadsubmitPage(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'exterior.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:12288',
            'interior.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:12288',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new TestCreate instance
        $testCreate = TestCreate::create([
            'number' => uniqid(), // Generate a unique identifier or use your own method
        ]);

        // Process exterior images
        $exteriorPaths = $this->storeImages($request->file('exterior'), 'exterior', $testCreate);

        // Process interior images
        $interiorPaths = $this->storeImages($request->file('interior'), 'interior', $testCreate);

        // Redirect with success message
        return redirect()->back()->with('success', 'Car post registered successfully!');
    }

        // Function to store images and return paths
        protected function storeImages($files, $type, $testCreate)
    {
        $paths = [];

        foreach ($files as $index => $file) {
            // Generate filename
            $filename = time() . '_' . $type . '_' . ($index + 1) . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Store the image in the appropriate folder (interior or exterior)
            $path = $file->storeAs('uploads/' . $type, $filename);

            // Save to TestCreateUpload model
            $upload = new TestCreateUpload([
                'test_create_id' => $testCreate->id,
                'path' => $path,
                'type' => $type,
                'sort_order' => $index + 1,
            ]);
            $upload->save();

            $paths[] = $path;
        }

        return $paths;
    }















    public function carpostregistertestuploadPage()
    {
        return view('frontend/carpost-register-upload');
    }















    public function carpostregistertestuploadeditPage()
    {
        return view('frontend/carpost-register-upload-edit');
    }
    public function carpostregistertestuploadeditsubmitPage()
    {
        
    }




























    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $imageName = time().'.'.$request->file->extension();
        $request->file->move(public_path('images'), $imageName);

        return response()->json(['url' => '/images/'.$imageName]);
    }

    
    public function carpostregisterdragdropPage(Request $request)
    {
        // return view('frontend/carpost-register-dragdrop', [

        // ]);

        $provinces = provincesModel::all();
        $brands = brandsModel::orderBy("sort_no", "ASC")->get();

        return view('frontend/carpost-register-dragdrop', [
            'provinces' => $provinces,
            'brands' => $brands,
        ]);
    }
    public function carpostregisterdragdropactionPage(Request $request)
    {
        dd($request);
    }


    

    

    public function updateClickCount(Request $request, CarsModel $car)
    {
        $car->clickcount += 1;
        $car->save();

        return response()->json(['success' => true]);
    }


    public function carpostdeleteactionPage(Request $request)
    {
        $postId = $request->input('id');

        // Assuming you have a 'carsModel' model
        $car = carsModel::find($postId);

        if (!$car) {
            // Car not found
            return response()->json(['error' => 'Car not found'], 404);
        }

        // Delete the car
        $car->status = 'deleted';
        $car->update();

        // Return a success response
        return response()->json(['message' => 'ลบสำเร็จ']);
    }

    public function carpostregistereditubmitPage(Request $request) {
        ini_set('post_max_size', '500M');
        ini_set('upload_max_filesize', '500M');
        ini_set('memory_limit', '500M');

        // dd($request);

        $cars = carsModel::find($request->post_id);

        $cars->type = $request->type;
        $cars->customer_id = $request->customer_id;
        $cars->brand_id = $request->brands;
        $cars->model_id = $request->models;
        $cars->generations_id = $request->generations;
        $cars->sub_models_id = $request->sub_models;
        $cars->modelyear = $request->years;
        $cars->mileage = $request->mileage;
        if ($request->gear == "auto") {
            $cars->gear = "auto";
        }
        else {
            $cars->gear = "manual";
        }
        if ($request->gashas == "1") {
            $cars->gas = "รถน้ำมัน / hybrid";
            $cars->ev = "0";
        }
        else if ($request->gashas == "2") {
            $cars->gas = "รถไฟฟ้า EV 100%";
            $cars->ev = "1";
        }
        else {
            $cars->gas = "รถติดแก๊ส";
            $cars->ev = "0";
        }
        $cars->vehicle_code = $request->vehicle_code;
        $cars->title = $request->title;
        $cars->detail = $request->detail;
        $cars->price = str_replace(",", "", $request->price);
        $cars->licenseplate = $request->licenseplate;
        if ($request->has('warranty_1')) {
            $cars->warranty_1 = 1;
        }
        else {
            $cars->warranty_1 = 0;
        }
        if ($request->has('warranty_2')) {
            $cars->warranty_2 = 1;
        }
        else {
            $cars->warranty_2 = 0;
        }
        if ($request->has('warranty_3')) {
            $cars->warranty_3 = 1;
        }
        else {
            $cars->warranty_3 = 0;
        }
        $cars->warranty_2_input = $request->warranty_2_input;

        if($request->status == 'approved'){
            $cars->status = 'approved';
        }elseif($request->status == 'rejected'){
            $cars->status = 'created';
        }

        // if($request->customer_type == 'dealer'){
        //     $cars->status = 'approved';
        // }else{
        //     $cars->status = 'created';
        // }
        $cars->color = ($request->color=='9999999999')?$request->other_color:$request->color;
        $cars->province = $request->province;
        $cars->update();

        // if($request->picture_feature){

        //     $string_pieces = explode( ";base64,", $request->picture_feature);
         
        //     $image_type_pieces = explode( "image/", $string_pieces[0] );
         
        //     $image_type = $image_type_pieces[1];

        //     // Decode the base64 string and save the image
        //     $imageData = base64_decode($string_pieces[1]);
            
        //     // Generate a unique filename
        //     $filename = 'feature-'.time() . '.' .$image_type;

        //     // Define the path where you want to save the image
        //     $path = public_path('uploads/feature/' . $filename);
        //     $filepath1 = 'uploads/feature/' . $filename;

        //     // Save the image to the defined path
        //     file_put_contents($path, $imageData);
        //     carsModel::where("id", $cars->id)->update(["feature" => $filepath1]);
        // }
        // if($request->hasFile('licenseplate')){
        //     $licenseplate = $request->file('licenseplate');
        //     $destinationPath = public_path('/uploads/licenseplate');
        //     $filename = $licenseplate->getClientOriginalName();

        //     $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        //     $newfilenam = 'licenseplate-'.time() . '.' .$ext;
        //     $licenseplate->move($destinationPath, $newfilenam);
        //     $filepath2 = 'uploads/licenseplate/'.$newfilenam;
        //     carsModel::where("id", $cars->id)->update(["licenseplate" => $filepath2]);
        // }
        

        // if($request->picture_exterior){
        //     $exterior_image = $request->picture_exterior;
        //     foreach($request->picture_exterior as $keyex => $extr){
        //         // Decode the base64 string and save the image
                
        //         $string_pieces = explode( ";base64,", $extr);
            
        //         $image_type_pieces = explode( "image/", $string_pieces[0] );
            
        //         $image_type = $image_type_pieces[1];

        //         $imageData = base64_decode($string_pieces[1]);

        //         // Generate a unique filename
        //         $filename = 'exterior-'.$keyex.'-'.time() . '.' .$image_type;

        //         // Define the path where you want to save the image
        //         $path = public_path('uploads/exterior/' . $filename);
        //         $filepath = 'uploads/exterior/' . $filename;

        //         // Save the image to the defined path
        //         file_put_contents($path, $imageData);

        //         $gallery = new galleryModel;
        //         $gallery->cars_id = $cars->id;
        //         $gallery->gallery = $filepath;
        //         $gallery->type = 'exterior';
        //         $gallery->save();
        //     }
        // }
        // if($request->picture_interior){
        //     $interior_image = $request->picture_interior;
        //     foreach($request->picture_interior as $keyin => $intr){

        //         $string_pieces = explode( ";base64,", $intr);
            
        //         $image_type_pieces = explode( "image/", $string_pieces[0] );
            
        //         $image_type = $image_type_pieces[1];

        //         // Decode the base64 string and save the image
        //         $imageData = base64_decode($string_pieces[1]);

        //         // Generate a unique filename
        //         $filename = 'interior-'.$keyin.'-'.time() . '.' .$image_type;

        //         // Define the path where you want to save the image
        //         $path = public_path('uploads/interior/' . $filename);
        //         $filepath = 'uploads/interior/' . $filename;

        //         // Save the image to the defined path
        //         file_put_contents($path, $imageData);
                
        //         $gallery = new galleryModel;
        //         $gallery->cars_id = $cars->id;
        //         $gallery->gallery = $filepath;
        //         $gallery->type = 'interior';
        //         $gallery->save();
        //     }
        // }

        $cars2 = carsModel::find($cars->id);
        $strtotime = strtotime($cars2->created_at);

        $cars2->ref_code = $strtotime.$cars2->customer_id;
        $cars2->update();

        $resourceId = $request->post_id;
        NoticeModel::where('resource', 'cars')
            ->where('resource_id', $resourceId)
            ->update(['status' => 'read']);

        // update cars.feature
        $genname = $request->input('genname');
        $qrygallery = galleryModel::where("pre_id", $genname)->orderBy("id", "ASC")->first();
        carsModel::where("id", $cars->id)->update(["feature" => $qrygallery->gallery]);
        // update gallery set cars_id
        galleryModel::where("pre_id", $genname)->update(["cars_id" => $cars->id, "pre_id" => null]);

        return redirect(route('carpostregistersuccessPage'));

    }  
    public function carpostregisterSubmitPage(Request $request) {
        ini_set('post_max_size', '500M');
        ini_set('upload_max_filesize', '500M');
        ini_set('memory_limit', '500M');
        // dd($request);
        // $validatedData = $request->validate([
        //     'title' => ['required', 'unique:posts', 'max:255'],
        //     'body' => ['required'],
        // ]);

        // dd($request);
        $cars = new carsModel;

        $cars->type = $request->type;
        $cars->customer_id = $request->customer_id;
        $cars->brand_id = $request->brands;
        $cars->model_id = $request->models;
        $cars->generations_id = $request->generations;
        $cars->sub_models_id = $request->sub_models;
        $cars->modelyear = $request->years;
        $cars->mileage = $request->mileage;
        if ($request->gear == "auto") {
            $cars->gear = "auto";
        }
        else {
            $cars->gear = "manual";
        }
        if ($request->gashas == "1") {
            $cars->gas = "รถน้ำมัน / hybrid";
            $cars->ev = "0";
        }
        else if ($request->gashas == "2") {
            $cars->gas = "รถไฟฟ้า EV 100%";
            $cars->ev = "1";
        }
        else {
            $cars->gas = "รถติดแก๊ส";
            $cars->ev = "0";
        }
        $cars->vehicle_code = $request->vehicle_code;
        $cars->title = $request->title;
        $cars->detail = $request->detail;
        $cars->price = str_replace(",", "", $request->price);
        // $cars->licenseplate = $request->licenseplate;
        
        if ($request->has('warranty_1')) {
            $cars->warranty_1 = 1;
        }
        else {
            $cars->warranty_1 = 0;
        }
        if ($request->has('warranty_2')) {
            $cars->warranty_2 = 1;
        }
        else {
            $cars->warranty_2 = 0;
        }
        if ($request->has('warranty_3')) {
            $cars->warranty_3 = 1;
        }
        else {
            $cars->warranty_3 = 0;
        }
        $cars->warranty_2_input = $request->warranty_2_input;

        if($request->customer_type == 'dealer'){
            $cars->status = 'approved';
            $cars->adddate = time();
            $cars->approvedate = time();
            $cars->expiredate = strtotime("+90 days", time());
        }else{
            $cars->status = 'created';
            $cars->adddate = time();
        }
        $cars->color = ($request->color=='9999999999')?$request->other_color:$request->color;
        $cars->province = $request->province;
        $cars->save();

        // if($request->picture_feature){

        //     $string_pieces = explode( ";base64,", $request->picture_feature);
         
        //     $image_type_pieces = explode( "image/", $string_pieces[0] );
         
        //     $image_type = $image_type_pieces[1];

        //     // Decode the base64 string and save the image
        //     $imageData = base64_decode($string_pieces[1]);
            
        //     // Generate a unique filename
        //     $filename = 'feature-'.time() . '.' .$image_type;

        //     // Define the path where you want to save the image
        //     $path = public_path('uploads/feature/' . $filename);
        //     $filepath1 = 'uploads/feature/' . $filename;

        //     // Save the image to the defined path
        //     file_put_contents($path, $imageData);


        //     // ทำ ลายน้ำ
        //     $watermarkPath = public_path('frontend/images/watermark.png');
        //     $imagePath = public_path('uploads/feature'.'/'.$filename);

        //     $img = Image::make($imagePath);

        //     // ปรับขนาดของ watermark เท่ากับ ค่าความกว้างของภาพ imageName หาร 10
        //     $watermark = Image::make($watermarkPath);
        //     $watermarkWidth = $img->width() / 3;
        //     $watermark->resize($watermarkWidth, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     });

        //     // เพิ่ม watermark ลงในรูป
        //     $img->insert($watermark, 'top-left', 40, 60);

        //     // บันทึกรูปที่มี watermark
        //     $img->save(public_path('uploads/feature'.'/'.$filename));







        //     carsModel::where("id", $cars->id)->update(["feature" => $filepath1]);
        // }





        // // ใส่ลายน้ำ
        // $qrygallery = galleryModel::where("pre_id", $request->customer_id)->orderBy("id")->get();
        // if (!empty($qrygallery)) {
        //     foreach ($qrygallery as $rows) {
        //         // ทำ ลายน้ำ feature
        //         $watermarkPath = public_path('frontend/images/watermark.png');
        //         $imagePath = public_path($rows->gallery);

        //         $img = Image::make($imagePath);

        //         // ปรับขนาดของ watermark เท่ากับ ค่าความกว้างของภาพ imageName หาร 10
        //         $watermark = Image::make($watermarkPath);
        //         $watermarkWidth = $img->width() / 3;
        //         $watermark->resize($watermarkWidth, null, function ($constraint) {
        //             $constraint->aspectRatio();
        //         });

        //         // เพิ่ม watermark ลงในรูป
        //         $img->insert($watermark, 'top-left', ceil($img->width()*0.10), ceil($img->height()*0.20));

        //         // บันทึกรูปที่มี watermark
        //         $img->save(public_path($rows->gallery));
        //     }
            
        // }


        // update cars.feature
        $genname = $request->input('genname');
        $qrygallery = galleryModel::where("pre_id", $genname)->orderBy("id", "ASC")->first();
        carsModel::where("id", $cars->id)->update(["feature" => $qrygallery->gallery]);
        // update gallery set cars_id
        galleryModel::where("pre_id", $genname)->update(["cars_id" => $cars->id, "pre_id" => null]);
        
        
        



        // if($request->hasFile('licenseplate')){
        //     $licenseplate = $request->file('licenseplate');
        //     $destinationPath = public_path('/uploads/licenseplate');
        //     $filename = $licenseplate->getClientOriginalName();

        //     $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        //     $newfilenam = 'licenseplate-'.time() . '.' .$ext;
        //     $licenseplate->move($destinationPath, $newfilenam);
        //     $filepath2 = 'uploads/licenseplate/'.$newfilenam;


        //     // ทำ ลายน้ำ
        //     $watermarkPath = public_path('frontend/images/watermark.png');
        //     $imagePath = public_path('uploads/licenseplate'.'/'.$newfilenam);

        //     $img = Image::make($imagePath);

        //     // ปรับขนาดของ watermark เท่ากับ ค่าความกว้างของภาพ imageName หาร 10
        //     $watermark = Image::make($watermarkPath);
        //     $watermarkWidth = $img->width() / 3;
        //     $watermark->resize($watermarkWidth, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     });

        //     // เพิ่ม watermark ลงในรูป
        //     $img->insert($watermark, 'top-left', 40, 60);

        //     // บันทึกรูปที่มี watermark
        //     $img->save(public_path('uploads/feature'.'/'.$newfilenam));



        //     carsModel::where("id", $cars->id)->update(["licenseplate" => $filepath2]);
        // }
        

        // if($request->picture_exterior){
        //     $exterior_image = $request->picture_exterior;
        //     foreach($request->picture_exterior as $keyex => $extr){
        //         // Decode the base64 string and save the image
                
        //         $string_pieces = explode( ";base64,", $extr);
            
        //         $image_type_pieces = explode( "image/", $string_pieces[0] );
            
        //         $image_type = $image_type_pieces[1];

        //         $imageData = base64_decode($string_pieces[1]);

        //         // Generate a unique filename
        //         $filename = 'exterior-'.$keyex.'-'.time() . '.' .$image_type;

        //         // Define the path where you want to save the image
        //         $path = public_path('uploads/exterior/' . $filename);
        //         $filepath = 'uploads/exterior/' . $filename;

        //         // Save the image to the defined path
        //         file_put_contents($path, $imageData);



        //         // ทำ ลายน้ำ
        //         $watermarkPath = public_path('frontend/images/watermark.png');
        //         $imagePath = public_path('uploads/exterior'.'/'.$filename);

        //         $img = Image::make($imagePath);

        //         // ปรับขนาดของ watermark เท่ากับ ค่าความกว้างของภาพ imageName หาร 10
        //         $watermark = Image::make($watermarkPath);
        //         $watermarkWidth = $img->width() / 3;
        //         $watermark->resize($watermarkWidth, null, function ($constraint) {
        //             $constraint->aspectRatio();
        //         });

        //         // เพิ่ม watermark ลงในรูป
        //         $img->insert($watermark, 'top-left', 40, 60);

        //         // บันทึกรูปที่มี watermark
        //         $img->save(public_path('uploads/exterior'.'/'.$filename));





        //         $gallery = new galleryModel;
        //         $gallery->cars_id = $cars->id;
        //         $gallery->gallery = $filepath;
        //         $gallery->type = 'exterior';
        //         $gallery->save();
        //     }
        // }
        // if($request->hasFile('interior_pictures')){

        //     // version 2
        //     foreach ($request->file('interior_pictures') as $keyin => $image) {
        //         // บันทึกไฟล์
        //         $imageName = 'interior-'.$keyin.'-'.time() . '_' . $image->getClientOriginalName();
        //         $image->move(public_path('uploads/interior'), $imageName);


        //         // ทำ ลายน้ำ
        //         $watermarkPath = public_path('frontend/images/watermark.png');
        //         $imagePath = public_path('uploads/interior'.'/'.$imageName);

        //         $img = Image::make($imagePath);

        //         // ปรับขนาดของ watermark เท่ากับ ค่าความกว้างของภาพ imageName หาร 10
        //         $watermark = Image::make($watermarkPath);
        //         $watermarkWidth = $img->width() / 3;
        //         $watermark->resize($watermarkWidth, null, function ($constraint) {
        //             $constraint->aspectRatio();
        //         });

        //         // เพิ่ม watermark ลงในรูป
        //         $img->insert($watermark, 'top-left', 40, 60);

        //         // บันทึกรูปที่มี watermark
        //         $img->save(public_path('uploads/interior'.'/'.$imageName));


        //         $gallery = new galleryModel;
        //         $gallery->cars_id = $cars->id;
        //         $gallery->gallery = 'uploads/interior/' . $imageName;
        //         $gallery->type = 'interior';
        //         $gallery->save();
        //     }
        // }

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
        $brands = brandsModel::orderBy("sort_no", "ASC")->get();
        // $models = modelsModel::all();
        // $query = DB::table('generations')->where('id', 1)->first();
        return view('frontend/carpost-register-success', [
            'provinces' => $provinces,
            'brands' => $brands,
            // 'query' => $query,
            // 'a' => 'test',
        ]);
    }
    

    public function carpostregistereditPage(Request $request, $post)
    {
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
                'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name',
                'brands.feature as brands_feature')
            ->orderBy('id', 'desc')
            ->first();

        $provinces = provincesModel::all();
        $brands = brandsModel::orderBy("sort_no", "ASC")->get();
        // $models = modelsModel::all();
        // $query = DB::table('generations')->where('id', 1)->first();
        $exterior = galleryModel::where("cars_id", $post)->where("type", "exterior")->get();
        return view('frontend/carpost-register-edit', [
            'mycars' => $mycars,
            'provinces' => $provinces,
            'brands' => $brands,
            'exterior' => $exterior,
            // 'a' => 'test',
        ]);
    }


    public function carpoststep1Page()
    {
        $provinces = provincesModel::all();
        $brands = brandsModel::orderBy("sort_no", "ASC")->get();
        $models = modelsModel::all();
        return view('frontend/carpost-step1', [
            'provinces' => $provinces,
            'brands' => $brands,
            'models' => $models,
            'a' => 'test',
        ]);
    }

    public function exteriorupload(Request $request) {
        $file = $request->file('file');
        $genname = $request->input('genname');

        // $licenseplate = $request->file('licenseplate');
        $destinationPath = public_path('/uploads/exterior');
        $filename = $file->getClientOriginalName();

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $newfilenam = 'exterior-'.$genname.'-'.$file->getClientOriginalName();
        $file->move($destinationPath, $newfilenam);
        $filepath2 = 'uploads/exterior/'.$newfilenam;

        if (isset($genname)) {
            $data = [
                "cars_id" => 0,
                "gallery" => $filepath2,
                "type" => "exterior",
                "pre_id" => $genname,
            ];
            galleryModel::create($data);
        }

        // ใส่ลายน้ำ
        $watermarkPath = public_path('frontend/images/watermark.png');
        $imagePath = public_path($filepath2);

        $img = Image::make($imagePath);

        // ปรับขนาดของ watermark เท่ากับ ค่าความกว้างของภาพ imageName หาร 10
        $watermark = Image::make($watermarkPath);
        $watermarkWidth = $img->width() / 3;
        $watermark->resize($watermarkWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // เพิ่ม watermark ลงในรูป
        $img->insert($watermark, 'top-left', ceil($img->width()*0.09), ceil($img->height()*0.17));

        // บันทึกรูปที่มี watermark
        $img->save(public_path($filepath2));

        return response()->json(['path' => 'create exterior']);
    }

    function exteriorrearrange(Request $request) {
        $fileNames = $request->input('files');
        $genname = $request->input('genname');
        if (isset($genname)) {
            $qrygallery = galleryModel::where("type", "exterior")->where("pre_id", $genname)->get();
            foreach ($qrygallery as $index => $rows) {
                $newfilenam = 'uploads/exterior/'.'exterior-'.$genname.'-'.$fileNames[$index];
                galleryModel::where('id', $rows->id)->update(['gallery' => $newfilenam]);
            }
        }

        return response()->json(['message' => 'Updated updated_at for selected files.']);
    }

    function exteriordelete(Request $request) {
        // $fileName = $request->input('filename');
        // $customerid = $request->input('customerid');
        // $filePath = 'uploads/exterior/'.'exterior-'.time().'-'.$fileName;
        // if (File::exists($filePath)) {
        //     File::delete($filePath);
        //     galleryModel::where('gallery', 'like', '%'. $filePath)->where("pre_id", $customerid)->delete();
        //     echo "File deleted successfully.";
        // }
        // return response()->json();

        $fileName = $request->input('filename');
        $genname = $request->input('genname');
        $qrygallery = galleryModel::where('gallery', 'like', '%'.$genname.'-'.$fileName.'%')->where("pre_id", $genname)->get();
        foreach ($qrygallery as $rows) {
            galleryModel::where('id', $rows->id)->delete();
            if (File::exists($rows->gallery)) {
                File::delete($rows->gallery);
                
                echo "File deleted successfully.";
            }
        }
        return response()->json();
    }

    public function interiorupload(Request $request) {
        $file = $request->file('file');
        $genname = $request->input('genname');

        // $licenseplate = $request->file('licenseplate');
        $destinationPath = public_path('/uploads/interior');
        $filename = $file->getClientOriginalName();

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $newfilenam = 'interior-'.$genname.'-'.$file->getClientOriginalName();
        $file->move($destinationPath, $newfilenam);
        $filepath2 = 'uploads/interior/'.$newfilenam;

        if (isset($genname)) {
            $data = [
                "cars_id" => 0,
                "gallery" => $filepath2,
                "type" => "interior",
                "pre_id" => $genname,
            ];
            galleryModel::create($data);
        }

        // ใส่ลายน้ำ
        $watermarkPath = public_path('frontend/images/watermark.png');
        $imagePath = public_path($filepath2);

        $img = Image::make($imagePath);

        // ปรับขนาดของ watermark เท่ากับ ค่าความกว้างของภาพ imageName หาร 10
        $watermark = Image::make($watermarkPath);
        $watermarkWidth = $img->width() / 3;
        $watermark->resize($watermarkWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // เพิ่ม watermark ลงในรูป
        $img->insert($watermark, 'top-left', ceil($img->width()*0.09), ceil($img->height()*0.17));

        // บันทึกรูปที่มี watermark
        $img->save(public_path($filepath2));

        return response()->json(['path' => 'create interior']);
    }

    function interiorrearrange(Request $request) {
        $fileNames = $request->input('files');
        $genname = $request->input('genname');
        if (isset($genname)) {
            $qrygallery = galleryModel::where("type", "interior")->where("pre_id", $genname)->get();
            foreach ($qrygallery as $index => $rows) {
                $newfilenam = 'uploads/interior/'.'interior-'.$genname.'-'.$fileNames[$index];
                galleryModel::where('id', $rows->id)->update(['gallery' => $newfilenam]);
            }
        }

        return response()->json(['message' => 'Updated updated_at for selected files.']);
    }

    function interiordelete(Request $request) {
        // $fileName = $request->input('filename');
        // $customerid = $request->input('customerid');
        // $filePath = 'uploads/interior/'.'interior-'.time().'-'.$fileName;
        // if (File::exists($filePath)) {
        //     File::delete($filePath);
        //     galleryModel::where('gallery', 'like', '%'. $filePath)->where("pre_id", $customerid)->delete();
        //     echo "File deleted successfully.";
        // }
        // return response()->json();

        $fileName = $request->input('filename');
        $genname = $request->input('genname');
        $qrygallery = galleryModel::where('gallery', 'like', '%'.$genname.'-'.$fileName.'%')->where("pre_id", $genname)->get();
        foreach ($qrygallery as $rows) {
            galleryModel::where('id', $rows->id)->delete();
            if (File::exists($rows->gallery)) {
                File::delete($rows->gallery);
                
                echo "File deleted successfully.";
            }
        }
        return response()->json();
    }

    public function licenseplateupload(Request $request) {
        $file = $request->file('file');
        $genname = $request->input('genname');

        // $licenseplate = $request->file('licenseplate');
        $destinationPath = public_path('/uploads/licenseplate');
        $filename = $file->getClientOriginalName();

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $newfilenam = 'licenseplate-'.$genname.'-'.$file->getClientOriginalName();
        $file->move($destinationPath, $newfilenam);
        $filepath2 = 'uploads/licenseplate/'.$newfilenam;

        if (isset($genname)) {
            $data = [
                "cars_id" => 0,
                "gallery" => $filepath2,
                "type" => "licenseplate",
                "pre_id" => $genname,
            ];
            galleryModel::create($data);
        }

        // ใส่ลายน้ำ
        $watermarkPath = public_path('frontend/images/watermark.png');
        $imagePath = public_path($filepath2);

        $img = Image::make($imagePath);

        // ปรับขนาดของ watermark เท่ากับ ค่าความกว้างของภาพ imageName หาร 10
        $watermark = Image::make($watermarkPath);
        $watermarkWidth = $img->width() / 3;
        $watermark->resize($watermarkWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // เพิ่ม watermark ลงในรูป
        $img->insert($watermark, 'top-left', ceil($img->width()*0.09), ceil($img->height()*0.17));

        // บันทึกรูปที่มี watermark
        $img->save(public_path($filepath2));

        return response()->json(['path' => 'create licenseplate']);
    }

    function licenseplaterearrange(Request $request) {
        $fileNames = $request->input('files');
        $genname = $request->input('genname');
        if (isset($genname)) {
            $qrygallery = galleryModel::where("type", "licenseplate")->where("pre_id", $genname)->get();
            foreach ($qrygallery as $index => $rows) {
                $newfilenam = 'uploads/licenseplate/'.'licenseplate-'.$genname.'-'.$fileNames[$index];
                galleryModel::where('id', $rows->id)->update(['gallery' => $newfilenam]);
            }
        }

        return response()->json(['message' => 'Updated updated_at for selected files.']);
    }

    function licenseplatedelete(Request $request) {
        $fileName = $request->input('filename');
        $genname = $request->input('genname');
        $qrygallery = galleryModel::where('gallery', 'like', '%'.$genname.'-'.$fileName.'%')->where("pre_id", $genname)->get();
        foreach ($qrygallery as $rows) {
            galleryModel::where('id', $rows->id)->delete();
            if (File::exists($rows->gallery)) {
                File::delete($rows->gallery);
                
                echo "File deleted successfully.";
            }
        }
        return response()->json();
    }
}
