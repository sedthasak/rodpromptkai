<?php
// app/Providers/ViewDataServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Models\Customer;
use App\Models\brandsModel;
use App\Models\contacts_backModel;
use App\Models\noticeModel;
use App\Models\carsModel;
use App\Models\provincesModel;
use App\Models\LevelModel;
use App\Models\PackageDealerModel;
use App\Models\VipPackageModel;
use App\Models\MyDeal;

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
                );
                foreach($mycars as $keystatus => $carstatus){
                    $carfromstatus[$carstatus->status][] = $carstatus;
                }   
                $allprovince = provincesModel::all();

                // Share the variables with all views
                $view->with('carfromstatus', $carfromstatus);
                $view->with('contacts_back', $contacts_back);
                $view->with('notice', $notice);
                $view->with('customer_id', $customerdata->id);
                $view->with('allprovince', $allprovince);

                /**************************************************************/
                /*************************************************************s*/

                $customer_login = Customer::find($customerdata->id);
                $customer_role = $customer_login->role;
                $customer_role = [
                    'role' => $customer_login->role,
                    'quota' => $customer_login->customer_quota,
                    'dealerpack' => $customer_login->dealerpack,
                    'dealerpack_regis' => $customer_login->dealerpack_regis,
                    'dealerpack_expire' => $customer_login->dealerpack_expire,
                    'vippack' => $customer_login->vippack,
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

                $customer_post = carsModel::where('customer_id', $customer_login->id)->count();

                
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

                $view->with('customer_role', $customer_role);
                $view->with('customer_login', $customer_login);
                $view->with('customer_level', $customer_level);
                $view->with('customer_post', $customer_post);
                $view->with('customer_deal', $customer_deal);
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
