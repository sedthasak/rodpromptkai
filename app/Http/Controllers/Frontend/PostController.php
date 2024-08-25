<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
        $request->validate([
            'image_paths' => 'nullable|array',
            'image_paths.*' => 'nullable|string',
            'interior_paths' => 'nullable|array',
            'interior_paths.*' => 'nullable|string',
            'registration_paths' => 'nullable|array',
            'registration_paths.*' => 'nullable|string',
        ]);

        // Retrieve the existing post
        $cars = carsModel::findOrFail($id);

        // Update car attributes from the request
        $cars->customer_id = $request->customer_id;
        $cars->type = $request->type;
        $cars->brand_id = $request->brands;
        $cars->model_id = $request->models;
        $cars->generations_id = $request->generations;
        $cars->sub_models_id = $request->sub_models;
        $cars->modelyear = $request->years;
        $cars->color = ($request->color == '9999999999') ? $request->other_color : $request->color;
        $cars->mileage = $request->mileage;
        $cars->gear = $request->gear == "auto" ? "auto" : "manual";
        $cars->gas = $request->gashas == "1" ? "รถน้ำมัน / hybrid" : ($request->gashas == "2" ? "รถไฟฟ้า EV 100%" : "รถติดแก๊ส");
        $cars->ev = $request->gashas == "2" ? "1" : "0";
        $cars->vehicle_code = $request->vehicle_code;
        $cars->licenseplate = $request->licenseplate;

        if ($request->has('warranty_1')) {
            $cars->warranty_1 = 1;
        } else {
            $cars->warranty_1 = 0;
        }
        if ($request->has('warranty_2')) {
            $cars->warranty_2 = 1;
        } else {
            $cars->warranty_2 = 0;
        }
        if ($request->has('warranty_3')) {
            $cars->warranty_3 = 1;
        } else {
            $cars->warranty_3 = 0;
        }

        $cars->warranty_2_input = $request->warranty_2_input;

        if ($request->status == 'approved') {
            $cars->status = 'approved';
        } elseif ($request->status == 'rejected') {
            $cars->status = 'created';
        }

        $cars->province = $request->province;
        $cars->title = $request->title;
        $cars->detail = $request->detail;
        $cars->price = str_replace(",", "", $request->price);
        $cars->feature = '';
        $cars->licenseplate = '';

        if (!empty($request->image_paths)) {
            $cars->feature = $request->image_paths[0];
        }
        if (!empty($request->registration_paths)) {
            $cars->licenseplate = $request->registration_paths[0];
        }

        $cars->update();

        $cars2 = carsModel::find($cars->id);
        $strtotime = strtotime($cars2->created_at);
        $cars2->ref_code = $strtotime . $cars2->customer_id;
        $cars2->update();

        // Delete old images
        $oldImages = galleryModel::where('cars_id', $id)->get();
        foreach ($oldImages as $oldImage) {
            Storage::delete('public/' . $oldImage->path);
            $oldImage->delete();
        }

        // Process new images
        if ($request->has('image_paths')) {
            $this->processImages($request->image_paths, 'exterior', $cars->id, true);
        }
        if ($request->has('interior_paths')) {
            $this->processImages($request->interior_paths, 'interior', $cars->id);
        }
        if ($request->has('registration_paths')) {
            $this->processImages($request->registration_paths, 'registration', $cars->id);
        }

        return redirect()->route('carpostregistersuccessPage');
    }

    // Process exterior and interior images
    private function processImages($paths, $type, $postId, $copyAsFeature = false)
    {
        foreach ($paths as $index => $path) {
            $sourcePath = storage_path('app/public/' . $path);

            if (!file_exists($sourcePath)) {
                throw new \Exception("Failed to move {$type} image: Source file not found.");
            }

            $destinationDir = storage_path('app/public/uploads/' . $type . '/' . $postId);
            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0777, true);
            }

            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $newFilename = "{$type}-{$postId}-" . ($index + 1) . '-' . uniqid() . ".{$extension}";
            $destinationPath = $destinationDir . '/' . $newFilename;

            if (!rename($sourcePath, $destinationPath)) {
                throw new \Exception("Failed to move {$type} image: File move operation failed.");
            }

            // Update the carsModel based on type and index
            if ($type === 'exterior' && $index === 0) {
                $car = carsModel::find($postId);
                if ($car) {
                    $car->feature = 'uploads/' . $type . '/' . $postId . '/' . $newFilename;
                    $car->save();

                    // Clone the first exterior image to the feature directory
                    if ($copyAsFeature) {
                        $featureDir = storage_path('app/public/uploads/feature/' . $postId);
                        if (!file_exists($featureDir)) {
                            mkdir($featureDir, 0777, true);
                        }
                        $featureFilename = "{$car->slug}-feature-{$postId}.{$extension}";
                        $featurePath = $featureDir . '/' . $featureFilename;

                        if (!copy($destinationPath, $featurePath)) {
                            throw new \Exception('Failed to copy exterior image to feature folder.');
                        }

                        // Update the feature field with the new path
                        $car->feature = 'uploads/feature/' . $postId . '/' . $featureFilename;
                        $car->save();
                    }
                }
            }

            if ($type === 'registration') {
                $car = carsModel::find($postId);
                if ($car) {
                    $car->licenseplate = 'uploads/' . $type . '/' . $postId . '/' . $newFilename;
                    $car->save();
                }
            }

            // Update database with new path
            galleryModel::create([
                'cars_id' => $postId,
                'gallery' => 'uploads/' . $type . '/' . $postId . '/' . $newFilename,
                'type' => $type,
            ]);
        }
    }

    public function carpostbrowseedit($id)
    {
        $provinces = provincesModel::all();
        $brands = brandsModel::orderBy("sort_no", "ASC")->get();
        // Retrieve existing post data and related images
        $mycars = carsModel::with(['brand', 'model', 'generation', 'subModel', 'user', 'customer'])->findOrFail($id);
        $post = carsModel::findOrFail($id);
        $images = galleryModel::where('cars_id', $id)->orderBy('id')->get();
        $registrationImage = galleryModel::where('cars_id', $id)->where('type', 'registration')->first();

        // Copy images to the 'rest' folder and group them by type (exterior or interior)
        $restImages = $this->copyImagesToRest($images, $registrationImage);
        // dd($mycars);
        return view('frontend.regiser-sellcar-edit', [
            'provinces' => $provinces,
            'brands' => $brands,
            'post' => $post,
            'mycars' => $mycars,
            'restImages' => $restImages,
        ]);
    }
    // Copy images to the 'rest' folder without changing their names
    private function copyImagesToRest($images, $registrationImage)
    {
        $exteriorImages = [];
        $interiorImages = [];
        $registrationImagePath = null;

        foreach ($images as $image) {
            $currentPath = 'public/' . $image->gallery;
            $restPath = 'public/uploads/rest/' . basename($image->gallery);

            if (Storage::exists($currentPath)) {
                try {
                    Storage::copy($currentPath, $restPath);
                    if ($image->type === 'exterior') {
                        $exteriorImages[] = 'uploads/rest/' . basename($image->gallery);
                    } elseif ($image->type === 'interior') {
                        $interiorImages[] = 'uploads/rest/' . basename($image->gallery);
                    }
                } catch (\Exception $e) {
                    // Handle errors if needed
                    // return redirect()->back()->with('error', 'Failed to copy one or more images to rest folder.');
                }
            }
        }

        if ($registrationImage) {
            $currentPath = 'public/' . $registrationImage->gallery;
            $restPath = 'public/uploads/rest/' . basename($registrationImage->gallery);

            if (Storage::exists($currentPath)) {
                try {
                    Storage::copy($currentPath, $restPath);
                    $registrationImagePath = 'uploads/rest/' . basename($registrationImage->gallery);
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
            'image' => 'required|image|max:12288',
            'type' => 'required|in:exterior,interior,registration',
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = $request->type . '-' . uniqid() . '.' . $extension;

        $path = $request->file('image')->storeAs('public/uploads/rest', $filename);

        $webpPath = $this->convertToWebP($path);

        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        return response()->json(['path' => str_replace('public/', '', $webpPath)]);
    }


    private function convertToWebP($path)
    {
        $image = Image::make(storage_path('app/' . $path));
        $watermark = Image::make(public_path('frontend/images/watermark.png'));
        $watermarkSize = $image->width() * 0.4;
        $watermark->resize($watermarkSize, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->insert($watermark, 'bottom-right', 100, 50);

        $filenameWithoutExtension = pathinfo($path, PATHINFO_FILENAME);
        $newFilename = $filenameWithoutExtension . '_watermarked.webp';
        $newPath = dirname($path) . '/' . $newFilename;

        $image->save(storage_path('app/' . $newPath), 80, 'webp');

        return $newPath;
    }





    public function carpostbrowsesubmit(Request $request)
    {
        $request->validate([
            'image_paths' => 'required|array',
            'image_paths.*' => 'required|string',
            'interior_paths' => 'sometimes|array',
            'interior_paths.*' => 'sometimes|string',
            'registration_paths' => 'sometimes|array',
            'registration_paths.*' => 'sometimes|string',
        ]);

        $cars = new carsModel;

        $cars->type = $request->type;
        $cars->customer_id = $request->customer_id;
        $cars->brand_id = $request->brands;
        $cars->model_id = $request->models;
        $cars->generations_id = $request->generations;
        $cars->sub_models_id = $request->sub_models;
        $cars->modelyear = $request->years;
        $cars->mileage = $request->mileage;
        $cars->yearregis = $request->yearregis;
        $cars->gear = $request->gear == "auto" ? "auto" : "manual";
        $cars->gas = $request->gashas == "1" ? "รถน้ำมัน / hybrid" : ($request->gashas == "2" ? "รถไฟฟ้า EV 100%" : "รถติดแก๊ส");
        $cars->ev = $request->gashas == "2" ? "1" : "0";
        $cars->vehicle_code = $request->vehicle_code;
        $cars->title = $request->title;
        $cars->detail = $request->detail;
        $cars->price = str_replace(",", "", $request->price);
        $cars->warranty_1 = $request->has('warranty_1') ? 1 : 0;
        $cars->warranty_2 = $request->has('warranty_2') ? 1 : 0;
        $cars->warranty_3 = $request->has('warranty_3') ? 1 : 0;
        $cars->warranty_2_input = $request->warranty_2_input;

        if ($request->customer_type == 'dealer') {
            $cars->status = 'approved';
            $cars->adddate = time();
            $cars->approvedate = time();
            $cars->expiredate = strtotime("+90 days", time());
        } else {
            $cars->status = 'created';
            $cars->adddate = time();
        }

        $cars->color = $request->color == '9999999999' ? $request->other_color : $request->color;
        $cars->province = $request->province;

        $cars->feature = '';
        $cars->licenseplate = '';

        if (!empty($request->image_paths)) {
            $cars->feature = $request->image_paths[0];
        }

        if (!empty($request->registration_paths)) {
            $cars->licenseplate = $request->registration_paths[0];
        }

        $cars->save();

        $cars->slug = $cars->generateUniqueSlug($cars->id);
        $cars->save();

        // Move and rename files, and clone the first exterior image as feature
        $this->moveAndRenameFiles($request->image_paths, $cars->id, 'exterior', true);
        if ($request->has('interior_paths')) {
            $this->moveAndRenameFiles($request->interior_paths, $cars->id, 'interior');
        }
        if ($request->has('registration_paths')) {
            $this->moveAndRenameFiles($request->registration_paths, $cars->id, 'registration');
        }

        return redirect()->route('carpostregistersuccessPage');
    }




    public function moveAndRenameFiles($paths, $postId, $type, $copyAsFeature = false)
    {
        try {
            $car = carsModel::findOrFail($postId);
            $slug = $car->slug;

            foreach ($paths as $key => $path) {
                $sourcePath = storage_path('app/public/' . $path);
                $destinationDir = storage_path('app/public/uploads/' . $type . '/' . $postId);

                if (!file_exists($destinationDir)) {
                    mkdir($destinationDir, 0777, true);
                }

                $extension = pathinfo($path, PATHINFO_EXTENSION);

                $number = $key + 1;
                if (in_array($type, ['interior', 'exterior'])) {
                    $newFilename = "{$slug}-{$type}-{$postId}-{$number}.{$extension}";
                } else {
                    $newFilename = "{$slug}-{$type}-{$postId}.{$extension}";
                }

                $destinationPath = $destinationDir . '/' . $newFilename;

                if (!rename($sourcePath, $destinationPath)) {
                    throw new \Exception('Failed to move one or more images.');
                }

                $paths[$key] = 'uploads/' . $type . '/' . $postId . '/' . $newFilename;

                galleryModel::create([
                    'cars_id' => $postId,
                    'gallery' => $paths[$key],
                    'type' => $type,
                ]);

                // Check if this is the first exterior image
                if ($type === 'exterior' && $key === 0) {
                    $car->feature = $paths[$key];
                    $car->save();

                    // Clone the first exterior image to the feature directory
                    if ($copyAsFeature) {
                        $featureDir = storage_path('app/public/uploads/feature/' . $postId);
                        if (!file_exists($featureDir)) {
                            mkdir($featureDir, 0777, true);
                        }
                        $featureFilename = "{$slug}-feature-{$postId}.{$extension}";
                        $featurePath = $featureDir . '/' . $featureFilename;

                        if (!copy($destinationPath, $featurePath)) {
                            throw new \Exception('Failed to copy exterior image to feature folder.');
                        }

                        // Update the feature field with the new path
                        $car->feature = 'uploads/feature/' . $postId . '/' . $featureFilename;
                        $car->save();
                    }
                }

                if ($type === 'registration') {
                    $car->licenseplate = $paths[$key];
                    $car->save();
                }
            }
        } catch (\Exception $e) {
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
        return view('frontend/regiser-sellcar', [
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












    // private function convertToWebP($path)
    // {
    //     // Generate a new filename with .webp extension
    //     $newPath = str_replace('.' . pathinfo($path, PATHINFO_EXTENSION), '.webp', $path);

    //     // Convert the image to WebP format using Intervention Image
    //     $image = Image::make(storage_path('app/' . $path));
    //     $image->save(storage_path('app/' . $newPath), 80, 'webp');

    //     // Return the path to the converted WebP image
    //     return $newPath;
    // }
    // public function generateUniqueSlug()
    // {
    //     // Get the related brand and model names
    //     $brandName = $this->brand ? $this->brand->title : '';
    //     $modelName = $this->model ? $this->model->model : '';
        
    //     // Create the slug base using year, brand, model, and title
    //     $baseSlug = trim("{$this->yearregis} {$brandName} {$modelName} {$this->title}");
        
    //     // Generate the initial slug
    //     $slug = Str::slug($baseSlug, '-');
        
    //     // Ensure uniqueness
    //     $originalSlug = $slug;
    //     $count = 1;

    //     while (carsModel::where('slug', $slug)->exists()) {
    //         $slug = $originalSlug . '-' . $count++;
    //     }

    //     return $slug;
    // }















































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
        $cars->yearregis = $request->yearregis;
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

        $cars->color = ($request->color=='9999999999')?$request->other_color:$request->color;
        $cars->province = $request->province;
        $cars->update();


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


        // update cars.feature
        $genname = $request->input('genname');
        $qrygallery = galleryModel::where("pre_id", $genname)->orderBy("id", "ASC")->first();
        carsModel::where("id", $cars->id)->update(["feature" => $qrygallery->gallery]);
        // update gallery set cars_id
        galleryModel::where("pre_id", $genname)->update(["cars_id" => $cars->id, "pre_id" => null]);

        $cars2 = carsModel::find($cars->id);
        $strtotime = strtotime($cars2->created_at);

        $cars2->ref_code = $strtotime.$cars2->customer_id;
        $cars2->update();

        return redirect(route('carpostregistersuccessPage'));
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
        return '';
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
    public function exteriorupload(Request $request) 
    {
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
    function exteriorrearrange(Request $request) 
    {
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
    function exteriordelete(Request $request) 
    {
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
    public function interiorupload(Request $request) 
    {
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
    function interiorrearrange(Request $request) 
    {
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
    function interiordelete(Request $request) 
    {
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
    public function licenseplateupload(Request $request) 
    {
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
    function licenseplaterearrange(Request $request) 
    {
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
    function licenseplatedelete(Request $request) 
    {
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
