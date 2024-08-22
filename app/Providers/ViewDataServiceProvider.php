<?php
// app/Providers/ViewDataServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use voku\helper\ASCII;

use App\Models\Customer;
use App\Models\brandsModel;
use App\Models\modelsModel;
use App\Models\generationsModel;
use App\Models\sub_modelsModel;
use App\Models\contacts_backModel;
use App\Models\noticeModel;
use App\Models\carsModel;
use App\Models\provincesModel;
use App\Models\LevelModel;
use App\Models\PackageDealerModel;
use App\Models\VipPackageModel;
use App\Models\MyDeal;
use App\Models\categoriesModel;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;

class ViewDataServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            // Retrieve $customerdata from the session
            $priceOptions = [
                ['value' => 25000, 'label' => '25,000 บาท'],
                ['value' => 50000, 'label' => '50,000 บาท'],
                ['value' => 75000, 'label' => '75,000 บาท'],
                ['value' => 100000, 'label' => '1 แสนบาท'],
                ['value' => 200000, 'label' => '2 แสนบาท'],
                ['value' => 300000, 'label' => '3 แสนบาท'],
                ['value' => 400000, 'label' => '4 แสนบาท'],
                ['value' => 500000, 'label' => '5 แสนบาท'],
                ['value' => 600000, 'label' => '6 แสนบาท'],
                ['value' => 700000, 'label' => '7 แสนบาท'],
                ['value' => 800000, 'label' => '8 แสนบาท'],
                ['value' => 900000, 'label' => '9 แสนบาท'],
                ['value' => 1000000, 'label' => '1 ล้านบาท'],
                ['value' => 1500000, 'label' => '1.5 ล้านบาท'],
                ['value' => 2000000, 'label' => '2 ล้านบาท'],
                ['value' => 2500000, 'label' => '2.5 ล้านบาท'],
                ['value' => 3000000, 'label' => '3 ล้านบาท'],
                ['value' => 3500000, 'label' => '3.5 ล้านบาท'],
                ['value' => 4000000, 'label' => '4 ล้านบาท'],
                ['value' => 4500000, 'label' => '4.5 ล้านบาท'],
                ['value' => 5000000, 'label' => '5 ล้านบาท'],
                ['value' => 6000000, 'label' => '6 ล้านบาท'],
                ['value' => 7000000, 'label' => '7 ล้านบาท'],
                ['value' => 8000000, 'label' => '8 ล้านบาท'],
                ['value' => 9000000, 'label' => '9 ล้านบาท'],
                ['value' => 10000000, 'label' => '10 ล้านบาท'],
                ['value' => 20000000, 'label' => '20 ล้านบาท'],
                ['value' => 30000000, 'label' => '30 ล้านบาท'],
                ['value' => 40000000, 'label' => '40 ล้านบาท'],
                ['value' => 50000000, 'label' => '50 ล้านบาท'],
            ];
            $allprovince = provincesModel::all();
            $view->with('allprovince', $allprovince);
            $view->with('priceOptions', $priceOptions);


            $customerdata = session('customer');

            if ($customerdata && isset($customerdata->id)) {
                $contacts_back = DB::table('contacts_back')
                    ->select('contacts_back.*', 'cars.id', 'cars.status', 'cars.customer_id', 'cars.user_id', 
                    'cars.type', 'cars.brand_id', 'cars.model_id', 'cars.modelyear', 'brands.title as brand_title', 
                    'models.model as model_name', 'customer.*', 'contacts_back.created_at')
                    ->join('cars', 'contacts_back.cars_id', '=', 'cars.id')
                    ->join('brands', 'cars.brand_id', '=', 'brands.id')
                    ->join('models', 'cars.model_id', '=', 'models.id')
                    ->join('customer', 'cars.customer_id', '=', 'customer.id')
                    ->where('cars.customer_id', '=', $customerdata->id)
                    ->where('contacts_back.status', '=', 'create')
                    ->orderBy('contacts_back.id', 'desc')
                    ->get();

                $notice = noticeModel::orderBy('id', 'desc')
                    ->where([
                        ["customer_id", $customerdata->id],
                        ["status", 'create'],
                    ])
                    ->get();
                $mycars = DB::table('cars')
                    ->leftjoin('customer', 'cars.customer_id', '=', 'customer.id')
                    ->leftjoin('brands', 'cars.brand_id', '=', 'brands.id')
                    ->leftjoin('models', 'cars.model_id', '=', 'models.id')
                    ->leftjoin('generations', 'cars.generations_id', '=', 'generations.id')
                    ->leftjoin('sub_models', 'cars.sub_models_id', '=', 'sub_models.id')
                    ->where('customer_id', $customerdata->id)
                    ->select('cars.*', 'customer.firstname', 'customer.lastname', 'customer.sp_role', 'customer.province as customer_proveince', 'brands.title as brands_title', 'models.model as model_name', 
                        'generations.generations as generations_name', 'sub_models.sub_models as sub_models_name')
                    ->orderBy('id', 'desc')
                    ->get();
        
                $carfromstatus = array(
                    'created' => [],
                    'approved' => [],
                    'rejected' => [],
                    'expired' => [],
                    'soldout' => [],
                );
                foreach($mycars as $keystatus => $carstatus){
                    $carfromstatus[$carstatus->status][] = $carstatus;
                }   
                

                // Share the variables with all views
                $view->with('carfromstatus', $carfromstatus);
                $view->with('contacts_back', $contacts_back);
                $view->with('notice', $notice);
                $view->with('customer_id', $customerdata->id);
                

                /**************************************************************/
                /******************************KONG****************************/
                /**************************************************************/

                

                $customer_login = Customer::find($customerdata->id);
                $customerId = $customer_login->id;
                $customer_role = $customer_login->role;
                $customer_role = [
                    'role' => $customer_login->role,
                    'customer_quota' => $customer_login->customer_quota,
                    'dealerpack' => $customer_login->dealerpack,
                    'dealerpack_quota' => $customer_login->dealerpack_quota,
                    'dealerpack_regis' => $customer_login->dealerpack_regis,
                    'dealerpack_expire' => $customer_login->dealerpack_expire,
                    'vippack' => $customer_login->vippack,
                    'vippack_quota' => $customer_login->vippack_quota,
                    'vippack_regis' => $customer_login->vippack_regis,
                    'vippack_expire' => $customer_login->vippack_expire,
                    'pack' => '',
                ];
                
                // Determine the package ID to fetch
                $packageId = $customer_login->dealerpack ?: $customer_login->vippack;

                if ($packageId) {
                    // Fetch the appropriate package model
                    $package = $customer_login->dealerpack 
                        ? PackageDealerModel::find($packageId) 
                        : VipPackageModel::find($packageId);
                    
                    // Update customer_role with the package name if found
                    if ($package) {
                        $customer_role['pack'] = strtoupper($package->name);
                    }
                }

                $levels = LevelModel::orderBy('accumulate', 'asc')->get();
                $customerAccumulate = $customer_login->accumulate;
                $customer_level = [
                    'accumulate' => $customerAccumulate ?$customerAccumulate: 0,
                    'level' => 'member', // Default to member if accumulate is below all thresholds
                    'slug' => 'member', // Default to member if accumulate is below all thresholds
                ];
                foreach ($levels as $level) {
                    if ($customerAccumulate >= $level->accumulate) {
                        $customer_level['level'] = $level->name;
                        $customer_level['slug'] = $level->slug;

                    } else {
                        break; // Exit loop as soon as we find the correct level
                    }
                }
                $customer_post = carsModel::where('customer_id', $customer_login->id)
                    ->select(DB::raw("
                        SUM(CASE WHEN type IN ('home', 'lady') THEN 1 ELSE 0 END) as normal,
                        SUM(CASE WHEN type = 'dealer' THEN 1 ELSE 0 END) as dealer
                    "))
                    ->first();

                $customer_post = [
                    'normal' => $customer_post->normal,
                    'dealer' => $customer_post->dealer
                ];

                
                $getdeal = MyDeal::where('customer_id', $customer_login->id)->count();
                $dealsInUse = MyDeal::where('customer_id', $customer_login->id)
                                    ->whereNotNull('cars_id')
                                    ->count();
                $freeDeals = $getdeal - $dealsInUse;
                $customer_deal = [
                    'all' => $getdeal ?: 0,
                    'use' => $dealsInUse,
                    'free' => $freeDeals,
                ];

                $carcontact = [];

                $carcontact = carsModel::where('customer_id', $customer_login->id)
                    ->whereHas('contacts', function ($query) {
                        $query->where('status', 'create');
                    })
                    ->pluck('id')
                    ->toArray();

                /**********************************************/    
                $carsCollection = carsModel::with(['brand', 'model'])
                    ->where('customer_id', $customerId)
                    ->get();

                // Group the cars by brand_id and then by model_id
                $cars = $carsCollection->groupBy('brand_id')->map(function ($groupByBrandId) {
                    return $groupByBrandId->groupBy('model_id')->map(function ($groupByModelId) {
                        return $groupByModelId;
                    });
                });

                // Pre-fetch all brands and models
                $brands = brandsModel::whereIn('id', $cars->keys())->get()->keyBy('id');
                $modelIds = $cars->flatMap(function ($modelsByBrand) {
                    return $modelsByBrand->keys();
                })->unique();
                $models = modelsModel::whereIn('id', $modelIds)->get()->keyBy('id');

                // Structure the data with counts
                $structuredCars = $cars->mapWithKeys(function ($modelsByBrand, $brandId) use ($brands, $models) {
                    $brand = $brands->get($brandId);
                    
                    $modelCounts = $modelsByBrand->mapWithKeys(function ($carsByModel, $modelId) use ($models) {
                        $model = $models->get($modelId);
                        return [
                            $modelId => [
                                'id' => $modelId,
                                'modelname' => $model->model,
                                'car_count_model' => $carsByModel->count(), // Count of cars for this model
                                'cars' => $carsByModel
                            ]
                        ];
                    });
                    
                    // Calculate total number of cars for this brand
                    $totalCarsForBrand = $modelsByBrand->map(function ($carsByModel) {
                        return $carsByModel->count(); // Count of cars in each model
                    })->sum(); // Sum the counts of cars for this brand
                    
                    return [
                        $brandId => [
                            'id' => $brandId,
                            'title' => $brand->title,
                            'feature' => $brand->feature,
                            'car_count_brand' => $totalCarsForBrand, // Total count of cars for the brand
                            'models' => $modelCounts
                        ]
                    ];
                });











                
                /*****************************************************************/
                // Get distinct statuses from the carsModel table
                $carAllStatuses = carsModel::where('customer_id', $customerId)
                    ->distinct()
                    ->pluck('status')
                    ->toArray();

                // Initialize an array to hold the structured cars data by status
                $structuredCarsByStatus = [];

                // Loop through each status
                foreach ($carAllStatuses as $status) {
                    // Fetch cars for the current status
                    $carsCollection = carsModel::with(['brand', 'model'])
                        ->where('customer_id', $customerId)
                        ->where('status', $status)
                        ->get();

                    // Count total cars for this status
                    $totalCarsForStatus = $carsCollection->count();

                    // Group the cars by brand_id and then by model_id
                    $cars = $carsCollection->groupBy('brand_id')->map(function ($groupByBrandId) {
                        return $groupByBrandId->groupBy('model_id')->map(function ($groupByModelId) {
                            return $groupByModelId;
                        });
                    });

                    // Pre-fetch all brands and models
                    $brands = brandsModel::whereIn('id', $cars->keys())->get()->keyBy('id');
                    $modelIds = $cars->flatMap(function ($modelsByBrand) {
                        return $modelsByBrand->keys();
                    })->unique();
                    $models = modelsModel::whereIn('id', $modelIds)->get()->keyBy('id');

                    // Structure the data with counts
                    $structuredCarsByStatus[$status] = [
                        'total_cars' => $totalCarsForStatus, // Total count of cars for this status
                        'brands' => $cars->mapWithKeys(function ($modelsByBrand, $brandId) use ($brands, $models) {
                            $brand = $brands->get($brandId);

                            $modelCounts = $modelsByBrand->mapWithKeys(function ($carsByModel, $modelId) use ($models) {
                                $model = $models->get($modelId);
                                return [
                                    $modelId => [
                                        'id' => $modelId,
                                        'modelname' => $model->model,
                                        'car_count_model' => $carsByModel->count(), // Count of cars for this model
                                        'cars' => $carsByModel
                                    ]
                                ];
                            });

                            // Calculate total number of cars for this brand
                            $totalCarsForBrand = $modelsByBrand->map(function ($carsByModel) {
                                return $carsByModel->count(); // Count of cars in each model
                            })->sum(); // Sum the counts of cars for this brand

                            return [
                                $brandId => [
                                    'id' => $brandId,
                                    'title' => $brand->title,
                                    'feature' => $brand->feature,
                                    'car_count_brand' => $totalCarsForBrand, // Total count of cars for the brand
                                    'models' => $modelCounts
                                ]
                            ];
                        })
                    ];
                }
                /*****************************************************************/
                // $view->with('customer_cars_by_status', $structuredCarsByStatus);









                /*****************************************************************/
                // Get distinct statuses from the carsModel table
                $carAllStatuses = carsModel::where('customer_id', $customerId)
                ->distinct()
                ->pluck('status')
                ->toArray();

                // Initialize arrays to hold the structured cars data by status
                $structuredCarsByStatus = [];
                $structuredCarsWithDeals = [];
                $structuredCarsWithoutDeals = [];

                // Loop through each status
                foreach ($carAllStatuses as $status) {
                // Fetch cars for the current status
                $carsCollection = carsModel::with(['brand', 'model'])
                    ->where('customer_id', $customerId)
                    ->where('status', $status)
                    ->get();

                // Count total cars for this status
                $totalCarsForStatus = $carsCollection->count();

                // Group the cars by brand_id and then by model_id
                $cars = $carsCollection->groupBy('brand_id')->map(function ($groupByBrandId) {
                    return $groupByBrandId->groupBy('model_id')->map(function ($groupByModelId) {
                        return $groupByModelId;
                    });
                });

                // Pre-fetch all brands and models
                $brands = brandsModel::whereIn('id', $cars->keys())->get()->keyBy('id');
                $modelIds = $cars->flatMap(function ($modelsByBrand) {
                    return $modelsByBrand->keys();
                })->unique();
                $models = modelsModel::whereIn('id', $modelIds)->get()->keyBy('id');

                // Structure the data with counts
                $structuredCarsByStatus[$status] = [
                    'total_cars' => $totalCarsForStatus, // Total count of cars for this status
                    'brands' => $cars->mapWithKeys(function ($modelsByBrand, $brandId) use ($brands, $models) {
                        $brand = $brands->get($brandId);

                        $modelCounts = $modelsByBrand->mapWithKeys(function ($carsByModel, $modelId) use ($models) {
                            $model = $models->get($modelId);
                            return [
                                $modelId => [
                                    'id' => $modelId,
                                    'modelname' => $model->model,
                                    'car_count_model' => $carsByModel->count(), // Count of cars for this model
                                    'cars' => $carsByModel
                                ]
                            ];
                        });

                        // Calculate total number of cars for this brand
                        $totalCarsForBrand = $modelsByBrand->map(function ($carsByModel) {
                            return $carsByModel->count(); // Count of cars in each model
                        })->sum(); // Sum the counts of cars for this brand

                        return [
                            $brandId => [
                                'id' => $brandId,
                                'title' => $brand->title,
                                'feature' => $brand->feature,
                                'car_count_brand' => $totalCarsForBrand, // Total count of cars for the brand
                                'models' => $modelCounts
                            ]
                        ];
                    })
                ];

                // For cars with mydeals
                $carsWithDealsCollection = $carsCollection->filter(function ($car) {
                    return $car->mydeals !== null;
                });

                if ($carsWithDealsCollection->isNotEmpty()) {
                    $totalCarsWithDeals = $carsWithDealsCollection->count();

                    $carsWithDeals = $carsWithDealsCollection->groupBy('brand_id')->map(function ($groupByBrandId) {
                        return $groupByBrandId->groupBy('model_id')->map(function ($groupByModelId) {
                            return $groupByModelId;
                        });
                    });

                    $structuredCarsWithDeals[$status] = [
                        'total_cars' => $totalCarsWithDeals,
                        'brands' => $carsWithDeals->mapWithKeys(function ($modelsByBrand, $brandId) use ($brands, $models) {
                            $brand = $brands->get($brandId);

                            $modelCounts = $modelsByBrand->mapWithKeys(function ($carsByModel, $modelId) use ($models) {
                                $model = $models->get($modelId);
                                return [
                                    $modelId => [
                                        'id' => $modelId,
                                        'modelname' => $model->model,
                                        'car_count_model' => $carsByModel->count(),
                                        'cars' => $carsByModel
                                    ]
                                ];
                            });

                            $totalCarsForBrand = $modelsByBrand->map(function ($carsByModel) {
                                return $carsByModel->count();
                            })->sum();

                            return [
                                $brandId => [
                                    'id' => $brandId,
                                    'title' => $brand->title,
                                    'feature' => $brand->feature,
                                    'car_count_brand' => $totalCarsForBrand,
                                    'models' => $modelCounts
                                ]
                            ];
                        })
                    ];
                }

                // For cars without mydeals
                $carsWithoutDealsCollection = $carsCollection->filter(function ($car) {
                    return $car->mydeals === null;
                });

                if ($carsWithoutDealsCollection->isNotEmpty()) {
                    $totalCarsWithoutDeals = $carsWithoutDealsCollection->count();

                    $carsWithoutDeals = $carsWithoutDealsCollection->groupBy('brand_id')->map(function ($groupByBrandId) {
                        return $groupByBrandId->groupBy('model_id')->map(function ($groupByModelId) {
                            return $groupByModelId;
                        });
                    });

                    $structuredCarsWithoutDeals[$status] = [
                        'total_cars' => $totalCarsWithoutDeals,
                        'brands' => $carsWithoutDeals->mapWithKeys(function ($modelsByBrand, $brandId) use ($brands, $models) {
                            $brand = $brands->get($brandId);

                            $modelCounts = $modelsByBrand->mapWithKeys(function ($carsByModel, $modelId) use ($models) {
                                $model = $models->get($modelId);
                                return [
                                    $modelId => [
                                        'id' => $modelId,
                                        'modelname' => $model->model,
                                        'car_count_model' => $carsByModel->count(),
                                        'cars' => $carsByModel
                                    ]
                                ];
                            });

                            $totalCarsForBrand = $modelsByBrand->map(function ($carsByModel) {
                                return $carsByModel->count();
                            })->sum();

                            return [
                                $brandId => [
                                    'id' => $brandId,
                                    'title' => $brand->title,
                                    'feature' => $brand->feature,
                                    'car_count_brand' => $totalCarsForBrand,
                                    'models' => $modelCounts
                                ]
                            ];
                        })
                    ];
                }
                }

                $catequery = categoriesModel::all();

                $history_post = [];
                if ($customerdata) {
                    // Find the customer in the database
                    $customer = Customer::find($customerdata->id);

                    if ($customer && $customer->history) {
                        // Decode the JSON history to an array
                        $history_ids = json_decode($customer->history, true);

                        // Fetch the related posts/cars based on the history in the order of the IDs in $history_ids
                        if (is_array($history_ids) && !empty($history_ids)) {
                            $history_post = carsModel::whereIn('id', $history_ids)
                                ->orderByRaw('FIELD(id, ' . implode(',', $history_ids) . ')')
                                ->get();
                        }
                    }
                }



                // dd($structuredCarsWithoutDeals);
                /*****************************************************************/
                $view->with('customer_cars_by_status', $structuredCarsByStatus);
                $view->with('customer_cars_with_deals', $structuredCarsWithDeals);
                $view->with('customer_cars_without_deals', $structuredCarsWithoutDeals);










                $view->with('history_post', $history_post);
                $view->with('catequery', $catequery);
                $view->with('carcontact', $carcontact);
                $view->with('customer_role', $customer_role);
                $view->with('customer_login', $customer_login);
                $view->with('customer_level', $customer_level);
                $view->with('customer_post', $customer_post);
                $view->with('customer_deal', $customer_deal);
                $view->with('customer_cars', $structuredCars);
                
                /**************************************************************/
                /******************************KONG****************************/
                /**************************************************************/
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // ...
    }
}
