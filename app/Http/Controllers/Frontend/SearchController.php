<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\Artisan;

use App\Models\carsModel;
use App\Models\galleryModel;

use App\Models\categoriesModel;
use App\Models\brandsModel;
use App\Models\modelsModel;
use App\Models\generationsModel;
use App\Models\sub_modelsModel;
use App\Models\Province;
use App\Models\setFooterModel;

use App\Models\temp_carsModel;
use App\Models\temp_galleryModel;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{


    public function testdev(Request $request)
    {
        $tempCars = carsModel::where('convert', '=', 4)->limit(200)->get();
        return view('frontend.testdev');
    }




















    public function convertcar()
    {
        $cars = temp_carsModel::with('galleries')->whereNull('convert')->limit(2)->get();
        $convertedCarIds = [];

        foreach ($cars as $car) {
            $postId = $car->id;

            try {
                // Insert data into carsModel
                $newCar = new carsModel();
                $newCar->fill($car->only($newCar->getFillable()));
                $newCar->slug = $newCar->generateUniqueSlug($car->id);
                $newCar->save();

                $slug = $newCar->slug;

                // Convert and store the feature image
                if ($car->feature) {
                    $this->convertAndStoreImage($car->feature, $newCar->id, 'feature', "{$slug}-feature.webp");
                    $newCar->feature = "uploads/feature/{$newCar->id}/{$slug}-feature.webp";
                }

                // Convert and store the license plate image
                if ($car->licenseplate) {
                    $this->convertAndStoreImage($car->licenseplate, $newCar->id, 'licenseplate', "{$slug}-licenseplate.webp");
                    $newCar->licenseplate = "uploads/licenseplate/{$newCar->id}/{$slug}-licenseplate.webp";
                }

                // Convert and store gallery images
                foreach ($car->galleries as $index => $gallery) {
                    $galleryFilename = "{$slug}-{$gallery->type}-{$newCar->id}-" . ($index + 1) . ".webp";
                    $galleryPath = $this->convertAndStoreImage($gallery->gallery, $newCar->id, $gallery->type, $galleryFilename);

                    // Insert the converted gallery path into the galleryModel
                    galleryModel::create([
                        'cars_id' => $newCar->id,
                        'gallery' => "uploads/{$gallery->type}/{$newCar->id}/{$galleryFilename}",
                        'type' => $gallery->type,
                        'pre_id' => $gallery->pre_id,
                    ]);
                }

                // Update paths in carsModel
                $newCar->save();

                // Mark as converted in temp_carsModel
                $car->convert = 1;
                $car->save();

                // Collect converted car IDs
                $convertedCarIds[] = $newCar->id;

            } catch (\Exception $e) {
                // Log the error message for debugging if needed
                \Log::error("Skipping post ID {$postId} due to error: " . $e->getMessage());

                // Mark the post as failed by setting convert field to 2
                $car->convert = 2;
                $car->save();

                // Skip this post and continue to the next one
                continue;
            }
        }

        return response()->json(['convertedCarIds' => $convertedCarIds]);
    }

    private function convertAndStoreImage($imagePath, $postId, $type, $filename)
    {
        // Full URL of the image
        $imageUrl = 'https://www.rodpromptkai.com/' . $imagePath;

        // Retrieve the image content from the URL without encoding
        $imageContent = @file_get_contents($imageUrl);
        if ($imageContent === false) {
            throw new \Exception("Unable to retrieve the image from the URL: " . $imageUrl);
        }

        // Create an image instance from the content
        $image = Image::make($imageContent);

        // Define the save directory based on type and post ID
        $saveDir = storage_path("app/public/uploads/{$type}/{$postId}/");

        // Ensure the directory exists
        if (!file_exists($saveDir)) {
            mkdir($saveDir, 0777, true);
        }

        // Define the save path
        $savePath = $saveDir . $filename;

        // Save the image as WebP
        $image->save($savePath, 80, 'webp');

        return $savePath;
    }










    
        


















    
    public function carsearchPage(Request $request, $kw1 = null, $kw2 = null, $kw3 = null, $kw4 = null, $kw5 = null)
    {
        $query = carsModel::query();
        $query->where('status', 'approved');
        $brand = $model = $generation = $sub_model = $province = $category = null;
        $parameters = [];
        $parameterstitle = [];
        $searchFailed = false;

        $brandforshow = '';

        // Initial category search
        if ($kw1 && !$searchFailed) {
            $category = categoriesModel::where('name', $kw1)->first();
            if ($category) {
                $query->whereJsonContains('category', (string)$category->id);
                $parameters['category'] = $category->name;
                $parameterstitle['category'] = $category->name;
            }
        }

        // Brand search
        if ($kw1 && !$category && !$searchFailed) {
            $brand = brandsModel::where('title', $kw1)->first();
            if ($brand) {
                $query->where('brand_id', $brand->id);
                $parameters['brand'] = $brand->title;
                $parameterstitle['brand'] = $brand->meta_title ?? $brand->title;
                $brandforshow = $brand->content??'';
            } else {
                $searchFailed = true;
            }
        }

        // Model search
        if ($kw2 && !$searchFailed) {
            if ($brand) {
                $model = modelsModel::where('model', $kw2)->where('brand_id', $brand->id)->first();
            }
            if ($model) {
                $query->where('model_id', $model->id);
                $parameters['model'] = $model->model;
                $parameterstitle['model'] = $model->meta_title ?? $model->model;
            } else {
                $province = Province::where('name_th', $kw2)->orWhere('name_en', $kw2)->first();
                if ($province) {
                    $parameters['province'] = $province->name_th;
                } else {
                    $searchFailed = true;
                }
            }
        }

        // Generation search
        if ($kw3 && !$searchFailed) {
            if ($model) {
                $generation = generationsModel::where('generations', $kw3)->where('models_id', $model->id)->first();
            }
            if ($generation) {
                $query->where('generations_id', $generation->id);
                $parameters['generation'] = $generation->generations;
                $parameterstitle['generation'] = $generation->meta_title ?? $generation->generations;
            } else {
                $province = Province::where('name_th', $kw3)->orWhere('name_en', $kw3)->first();
                if ($province) {
                    $parameters['province'] = $province->name_th;
                } else {
                    $searchFailed = true;
                }
            }
        }

        // Sub-model search
        if ($kw4 && !$searchFailed) {
            if ($generation) {
                $sub_model = sub_modelsModel::where('sub_models', $kw4)->where('generations_id', $generation->id)->first();
            }
            if ($sub_model) {
                $query->where('sub_models_id', $sub_model->id);
                $parameters['sub_model'] = $sub_model->sub_models;
                $parameterstitle['sub_model'] = $sub_model->meta_title ?? $sub_model->sub_models;
            } else {
                $province = Province::where('name_th', $kw4)->orWhere('name_en', $kw4)->first();
                if ($province) {
                    $parameters['province'] = $province->name_th;
                } else {
                    $searchFailed = true;
                }
            }
        }

        // Province search
        if ($kw5 && !$searchFailed) {
            $province = Province::where('name_th', $kw5)->orWhere('name_en', $kw5)->first();
            if ($province) {
                $parameters['province'] = $province->name_th;
            } else {
                $searchFailed = true;
            }
        }

        // Apply province filter
        if ($province && !$searchFailed) {
            $query->where('province', 'like', '%' . $province->name_th . '%');
        }

        // Apply additional filters from query parameters
        // EV filter
        if ($request->has('ev') && $request->query('ev') === 'yes') {
            $query->where('ev', '1');
        }

        // Price filter
        if ($request->has('min_price')) {
            $query->where('price', '>=', (int) $request->query('min_price'));
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', (int) $request->query('max_price'));
        }

        // Year filter
        if ($request->has('min_year')) {
            $query->where('modelyear', '>=', (int) $request->query('min_year'));
        }
        if ($request->has('max_year')) {
            $query->where('modelyear', '<=', (int) $request->query('max_year'));
        }

        // Color filter
        if ($request->has('color')) {
            $query->where('color', $request->query('color'));
        }

        // Gear filter
        if ($request->has('gear')) {
            $query->where('gear', $request->query('gear'));
        }

        // Gas filter with value mapping
        if ($request->has('fuel_type')) {
            $gasValue = $request->query('fuel_type');
            switch ($gasValue) {
                case '1':
                    $gasValue = 'รถน้ำมัน / hybrid';
                    break;
                case '2':
                    $gasValue = 'รถไฟฟ้า EV 100%';
                    break;
                case '3':
                    $gasValue = 'รถติดแก๊ส';
                    break;
                default:
                    $gasValue = null;
            }

            if ($gasValue) {
                $query->where('gas', $gasValue);
            }
        }

        // Fetch cars grouped by modelyear and ordered by updated_at
        $carsQuery = $searchFailed ? collect() : $query->with([
            'brand', 
            'model', 
            'generation', 
            'subModel', 
            'user', 
            'customer', 
            'myDeal.deal', // Eager load the 'deal' relationship within 'myDeal'
            'contacts'
        ]);
        
        $countcar = $searchFailed ? 0 : $carsQuery->count();
        // $cars = $searchFailed ? collect() : $carsQuery->orderBy('modelyear', 'desc')
        //     ->orderBy('updated_at', 'desc')
        //     ->get()
        //     ->groupBy('modelyear');

        // First, paginate the query
        $paginatedCars = $searchFailed ? collect() : $carsQuery->orderBy('modelyear', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(40);

        // Then, group the paginated items by modelyear
        $cars = $paginatedCars->getCollection()->groupBy('modelyear');

        
        // Calculate remaining time for each car
        foreach ($cars as $modelyear => $carsByYear) {
            foreach ($carsByYear as $car) {
                if ($car->myDeal && $car->myDeal->deal) {
                    $car->remaining_time = $this->calculateRemainingTime($car->myDeal->deal_expire);
                } else {
                    $car->remaining_time = null;
                }
            }
        }



        
        // Fetch recommendations
        $recommendations = $this->getRecommendedCars()->load([
            'brand', 'model', 'generation', 'subModel', 'user', 'customer', 'myDeal', 'contacts'
        ]);

        // Generate breadcrumbs
        $breadcrumb = $this->generateBreadcrumbs($parameters);

        // Generate title
        $mytitle = $this->generateTitle($parameterstitle, $province);

        // Generate keywords
        $mykeyword = $this->generateKeywords($brand, $model, $generation, $sub_model, $province);

        // Convert keywords to a comma-separated string
        $formattedKeywords = implode(', ', $mykeyword['keywordall']);

        $slide = DB::table('setting_option')->where('key_option', 'slide_search')->first();
        $decde = isset($slide) ? json_decode($slide->value_option) : [];

        $bnner = DB::table('setting_option')->where('key_option', 'banner_search')->first();
        $decdebnner = isset($bnner) ? json_decode($bnner->value_option) : [];
        $setFooterModel = setFooterModel::all();
        // dd($decdebnner);
        return view('frontend.carsearch', [
            'results' => $cars,
            'recommendations' => $recommendations,
            'breadcrumb' => $breadcrumb,
            'mytitle' => $mytitle,
            'mykeyword' => $formattedKeywords,
            'countcar' => $countcar,
            'searchFailed' => $searchFailed,
            'paginatedCars' => $paginatedCars,
            'slide' => $decde,
            'banner' => $decdebnner,
            'setFooterModel' => $setFooterModel,
            'brandforshow' => $brandforshow??'',
        ]);
        
    }

    private function calculateRemainingTime($dealExpire)
    {
        $now = Carbon::now();
        $expire = Carbon::parse($dealExpire);

        $diffInDays = $expire->diffInDays($now);
        $diffInHours = $expire->copy()->subDays($diffInDays)->diffInHours($now);
        $diffInMinutes = $expire->copy()->subDays($diffInDays)->subHours($diffInHours)->diffInMinutes($now);

        $remainingTime = '';
        if ($diffInDays > 0) {
            $remainingTime .= $diffInDays . ' วัน ';
        }
        if ($diffInHours > 0) {
            $remainingTime .= $diffInHours . ' ชม. ';
        }
        // if ($diffInMinutes > 0) {
        //     $remainingTime .= $diffInMinutes . ' นาที';
        // }

        return trim($remainingTime);
    }

    private function getRemainingTime($dealExpire)
    {
        // Calculate the remaining time until the deal expires
        $now = Carbon::now();
        $expire = Carbon::parse($dealExpire);

        return $expire->diffForHumans($now, true); // returns time difference in a human-readable format
    }



    public function getBrandName($id)
    {
        $brand = brandsModel::find($id);
        return response()->json(['name' => $brand ? $brand->title : 'empty']);
    }
    
    public function getModelName($id)
    {
        $model = modelsModel::find($id);
        return response()->json(['name' => $model ? $model->model : 'empty']);
    }
    
    public function getGenerationName($id)
    {
        $generation = generationsModel::find($id);
        return response()->json(['name' => $generation ? $generation->generations : 'empty']);
    }
    
    public function getSubmodelName($id)
    {
        $submodel = sub_modelsModel::find($id);
        return response()->json(['name' => $submodel ? $submodel->sub_models : 'empty']);
    }
    

    private function generateBreadcrumbs($parameters)
    {
        $breadcrumb = [];
        if (isset($parameters['category'])) {
            $breadcrumb[] = ['title' => $parameters['category'], 'url' => decode_url(route('carsearchPage', ['kw1' => $parameters['category']]))];
        }
        if (isset($parameters['brand'])) {
            $breadcrumb[] = ['title' => $parameters['brand'], 'url' => decode_url(route('carsearchPage', ['kw1' => $parameters['brand']]))];
        }
        if (isset($parameters['model'])) {
            $breadcrumb[] = ['title' => $parameters['model'], 'url' => decode_url(route('carsearchPage', ['kw1' => $parameters['brand'], 'kw2' => $parameters['model']]))];
        }
        if (isset($parameters['generation'])) {
            $breadcrumb[] = ['title' => $parameters['generation'], 'url' => decode_url(route('carsearchPage', ['kw1' => $parameters['brand'], 'kw2' => $parameters['model'], 'kw3' => $parameters['generation']]))];
        }
        if (isset($parameters['sub_model'])) {
            $breadcrumb[] = ['title' => $parameters['sub_model'], 'url' => decode_url(route('carsearchPage', ['kw1' => $parameters['brand'], 'kw2' => $parameters['model'], 'kw3' => $parameters['generation'], 'kw4' => $parameters['sub_model']]))];
        }
        return $breadcrumb;
    }

    private function generateTitle($parameterstitle, $province)
    {
        $parts = [
            $parameterstitle['brand'] ?? '',
            $parameterstitle['model'] ?? '',
            $parameterstitle['generation'] ?? '',
            $parameterstitle['sub_model'] ?? '',
            $province->name_th ?? ''
        ];
        return implode(' ', array_filter($parts));
    }

    private function generateKeywords($brand, $model, $generation, $sub_model, $province)
    {
        $keywords = [
            'keywordfromname' => [],
            'keywordfrommeta' => [],
            'keywordall' => []
        ];

        if ($brand && !$model && !$generation) {
            // Case: Only brand is provided
            $keywords['keywordfromname'][] = $brand->title;
            $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $brand->meta_keyword));

            foreach ($brand->models as $brandModel) {
                $keywords['keywordfromname'][] = $brandModel->model;
                $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $brandModel->meta_keyword));
            }
        } elseif ($brand && $model && !$generation) {
            // Case: Brand and model are provided
            $keywords['keywordfromname'][] = $brand->title;
            $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $brand->meta_keyword));

            $keywords['keywordfromname'][] = $model->model;
            $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $model->meta_keyword));

            foreach ($model->generations as $modelGeneration) {
                $keywords['keywordfromname'][] = $modelGeneration->generations;
                $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $modelGeneration->meta_keyword));
            }
        } elseif ($brand && $model && $generation && !$sub_model) {
            // Case: Brand, model, and generation are provided, but no sub-model
            $keywords['keywordfromname'][] = $brand->title;
            $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $brand->meta_keyword));

            $keywords['keywordfromname'][] = $model->model;
            $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $model->meta_keyword));

            $keywords['keywordfromname'][] = $generation->generations;
            $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $generation->meta_keyword));

            foreach ($generation->subModels as $generationSubModel) {
                $keywords['keywordfromname'][] = $generationSubModel->sub_models;
                $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $generationSubModel->meta_keyword));
            }
        } elseif ($brand && $model && $generation && $sub_model) {
            // Case: Brand, model, generation, and sub-model are provided
            $keywords['keywordfromname'][] = $brand->title;
            $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $brand->meta_keyword));

            $keywords['keywordfromname'][] = $model->model;
            $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $model->meta_keyword));

            $keywords['keywordfromname'][] = $generation->generations;
            $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $generation->meta_keyword));

            $keywords['keywordfromname'][] = $sub_model->sub_models;
            $keywords['keywordfrommeta'] = array_merge($keywords['keywordfrommeta'], explode(' ', $sub_model->meta_keyword));
        }

        if ($province) {
            $keywords['keywordfromname'][] = $province->name_th;
            $keywords['keywordfromname'][] = $province->name_en;
            $keywords['keywordfrommeta'][] = $province->name_th; // Assuming meta_keyword could be province names
            $keywords['keywordfrommeta'][] = $province->name_en; // Assuming meta_keyword could be province names
        }

        // Remove any empty values
        $keywords['keywordfrommeta'] = array_filter($keywords['keywordfrommeta']);

        // Combine keywordfromname and keywordfrommeta, make lowercase, and remove duplicates
        $combinedKeywords = array_merge($keywords['keywordfromname'], $keywords['keywordfrommeta']);
        $keywords['keywordall'] = array_unique($combinedKeywords);

        return $keywords;
    }








    
    




    private function getRecommendedCars()
    {
        return carsModel::latest()->limit(4)->get(); // Example: returning the latest 4 cars
    }





        // public function testdevs(Request $request)
    // {
    //     $tempCars = temp_carsModel::where('convert', '=', 4)->limit(200)->get();
        
    //     foreach ($tempCars as $car) {
    //         $matchingCars = carsModel::where('status', $car->status)
    //             ->where('customer_id', $car->customer_id)
    //             ->where('type', $car->type)
    //             ->where('brand_id', $car->brand_id)
    //             ->where('model_id', $car->model_id)
    //             ->where('generations_id', $car->generations_id)
    //             ->where('sub_models_id', $car->sub_models_id)
    //             ->where('modelyear', $car->modelyear)
    //             ->where('vehicle_code', $car->vehicle_code)
    //             ->where('mileage', $car->mileage)
    //             ->select('id', 'feature', 'licenseplate') // Select only the feature and licenseplate fields
    //             ->limit(100) // Limit to 100 matching records
    //             ->get();

    //         foreach ($matchingCars as $matchingCar) {
    //             $featurePath = storage_path("app/public/uploads/feature/{$car->id}/*");
    //             $exteriorPath = storage_path("app/public/uploads/exterior/{$car->id}/*");
    //             $interiorPath = storage_path("app/public/uploads/interior/{$car->id}/*");
    //             $licenseplatePath = storage_path("app/public/uploads/licenseplate/{$car->id}/*");
    //             $registrationPath = storage_path("app/public/uploads/registration/{$car->id}/*");

    //             $featureFiles = glob($featurePath);
    //             $exteriorFiles = glob($exteriorPath);
    //             $interiorFiles = glob($interiorPath);
    //             $licenseplateFiles = glob($licenseplatePath);
    //             $registrationFiles = glob($registrationPath);
    //             echo "<br>";
    //             echo 'matchingCar '.$matchingCar->id;
    //             echo "<br>";
    //             echo 'featureFiles '.count($featureFiles);
    //             echo "<br>";
    //             echo 'exteriorFiles '.count($exteriorFiles);
    //             echo "<br>";
    //             echo 'interiorFiles '.count($interiorFiles);
    //             echo "<br>";
    //             if (count($featureFiles) >= 1 && count($exteriorFiles) >= 3 && count($interiorFiles) >= 3) {
    //                 $featureFilePath = str_replace(storage_path('app/public/'), '', $featureFiles[0]);
    //                 $matchingCar->feature = $featureFilePath;

    //                 if (count($licenseplateFiles) >= 1) {
    //                     $licenseplateFilePath = str_replace(storage_path('app/public/'), '', $licenseplateFiles[0]);
    //                     $matchingCar->licenseplate = $licenseplateFilePath;
    //                 }

    //                 $matchingCar->save();

    //                 Create entries in galleryModel for interior, exterior, and registration files
    //                 foreach ($interiorFiles as $file) {
    //                     galleryModel::create([
    //                         'cars_id' => $matchingCar->id,
    //                         'gallery' => str_replace(storage_path('app/public/'), '', $file),
    //                         'type' => 'interior',
    //                     ]);
    //                 }

    //                 foreach ($exteriorFiles as $file) {
    //                     galleryModel::create([
    //                         'cars_id' => $matchingCar->id,
    //                         'gallery' => str_replace(storage_path('app/public/'), '', $file),
    //                         'type' => 'exterior',
    //                     ]);
    //                 }

    //                 foreach ($registrationFiles as $file) {
    //                     galleryModel::create([
    //                         'cars_id' => $matchingCar->id,
    //                         'gallery' => str_replace(storage_path('app/public/'), '', $file),
    //                         'type' => 'registration',
    //                     ]);
    //                 }

    //                 $car->convert = 1;
    //                 $car->save();

    //                 echo "Successfully processed Temp Car ID: {$car->id} and updated Car ID: {$matchingCar->id}<br>";
    //                 echo "Feature Path: {$matchingCar->feature}<br>";
    //                 echo "Licenseplate Path: " . ($matchingCar->licenseplate ?? 'No licenseplate file found') . "<br>";

    //                 echo "Interior Files:<br>";
    //                 foreach ($interiorFiles as $file) {
    //                     echo "- " . str_replace(storage_path('app/public/'), '', $file) . "<br>";
    //                 }

    //                 echo "Exterior Files:<br>";
    //                 foreach ($exteriorFiles as $file) {
    //                     echo "- " . str_replace(storage_path('app/public/'), '', $file) . "<br>";
    //                 }

    //                 echo "Registration Files:<br>";
    //                 foreach ($registrationFiles as $file) {
    //                     echo "- " . str_replace(storage_path('app/public/'), '', $file) . "<br>";
    //                 }
    //             } else {
    //                 $car->convert = 4;
    //                 $car->save();
    //                 echo "Required files not found for Temp Car ID: {$car->id}<br>";
    //             }

    //             echo "<br>";
    //         }
    //     }

    //     return view('frontend.testdev');
    // }

    // public function testdev(Request $request)
    // {
    //     // Get the current page or set it to 1 by default
    //     $page = $request->input('page', 5);

    //     // Retrieve temp_carsModel records with pagination (limit 500 per page)
    //     $getcarsModels = temp_carsModel::paginate(500, ['*'], 'page', $page);

    //     $results = [];

    //     foreach ($getcarsModels as $car) {
    //         // Search in carsModel for matching records
    //         $matchingIds = carsModel::where('status', $car->status)
    //             ->where('customer_id', $car->customer_id)
    //             ->where('type', $car->type)
    //             ->where('title', $car->title)
    //             ->where('brand_id', $car->brand_id)
    //             ->where('model_id', $car->model_id)
    //             ->where('generations_id', $car->generations_id)
    //             ->where('sub_models_id', $car->sub_models_id)
    //             ->where('modelyear', $car->modelyear)
    //             ->where('vehicle_code', $car->vehicle_code)
    //             ->where('mileage', $car->mileage)
    //             ->pluck('id'); // Get the IDs of matching rows

    //         // Filter only if the matching IDs count is more than 1 or 0 (no matches)
    //         if ($matchingIds->count() > 1 || $matchingIds->isEmpty()) {
    //             // Store the result with the car ID as the key and matching IDs as the value
    //             $results[$car->id] = $matchingIds->toArray();

    //             // Check if the feature field matches between the source and any of the found records
    //             foreach ($matchingIds as $matchingId) {
    //                 $matchedCar = carsModel::find($matchingId);
    //                 if ($matchedCar && $car->feature == $matchedCar->feature) {
    //                     // Update the mydeals field of the matching record
    //                     $matchedCar->update(['mydeals' => 'abnormal']);
    //                     break; // Stop checking further once a match is found
    //                 }
    //             }
    //         }
    //     }

    //     // Output the results for debugging
    //     dd($results);

    //     return view('frontend.testdev', [
    //         'results' => $results, // Pass results to the view if needed
    //         'getcarsModels' => $getcarsModels, // Pass paginated carsModels to the view if needed
    //     ]);
    // }

    // public function testdev(Request $request)
    // {
    //     // Get the current page or set it to 1 by default
    //     $page = $request->input('page', 22);

    //     // Retrieve carsModel records with pagination
    //     $getcarsModels = carsModel::paginate(200, ['*'], 'page', $page);

    //     $results = [];

    //     foreach ($getcarsModels as $car) {
    //         // Search in temp_carsModel for matching records
    //         $matchingCount = temp_carsModel::where('status', $car->status)
    //             ->where('customer_id', $car->customer_id)
    //             ->where('type', $car->type)
    //             ->where('brand_id', $car->brand_id)
    //             ->where('model_id', $car->model_id)
    //             ->where('generations_id', $car->generations_id)
    //             ->where('sub_models_id', $car->sub_models_id)
    //             ->where('modelyear', $car->modelyear)
    //             ->where('vehicle_code', $car->vehicle_code)
    //             ->where('mileage', $car->mileage)
    //             ->count(); // Get the count of matching rows

    //         // Store the result with the car ID as the key
    //         $results[$car->id] = $matchingCount;
    //     }

    //     // Output the results for debugging
    //     dd($results);

    //     return view('frontend.testdev', [
    //         'results' => $results, // Pass results to the view if needed
    //         'getcarsModels' => $getcarsModels, // Pass paginated carsModels to the view if needed
    //     ]);
    // }




    
}
