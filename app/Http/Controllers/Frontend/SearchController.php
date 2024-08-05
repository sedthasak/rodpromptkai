<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\carsModel;

use App\Models\brandsModel;
use App\Models\modelsModel;
use App\Models\generationsModel;
use App\Models\sub_modelsModel;
use App\Models\Province;

class SearchController extends Controller
{
    
    public function carsearchPage(Request $request, $kw1 = null, $kw2 = null, $kw3 = null, $kw4 = null, $kw5 = null)
    {
        // Initialize query
        $query = carsModel::query();

        // Initialize variables
        $brand = $model = $generation = $sub_model = $province = null;
        $parameters = []; // Initialize the parameters array

        // Check kw1 for brand
        if ($kw1) {
            $brand = brandsModel::where('title', $kw1)->first();
            if ($brand) {
                $query->where('brand_id', $brand->id);
                $parameters['brand'] = $brand->title; // Add to parameters array
            } else {
                // Brand not found, return empty results
                return view('frontend.carsearch', ['results' => collect(), 'parameters' => $parameters]);
            }
        }

        // Check kw2 for model or province
        if ($kw2) {
            if ($brand) {
                $model = modelsModel::where('model', $kw2)->where('brand_id', $brand->id)->first();
            }
            if ($model) {
                $query->where('model_id', $model->id);
                $parameters['model'] = $model->model; // Add to parameters array
            } else {
                $province = Province::where('name_th', $kw2)->orWhere('name_en', $kw2)->first();
                if ($province) {
                    $parameters['province'] = $province->name_th; // Add to parameters array
                } else {
                    // Model or province not found, return empty results
                    return view('frontend.carsearch', ['results' => collect(), 'parameters' => $parameters]);
                }
            }
        }

        // Check kw3 for generation or province
        if ($kw3) {
            if ($model) {
                $generation = generationsModel::where('generations', $kw3)->where('models_id', $model->id)->first();
            }
            if ($generation) {
                $query->where('generations_id', $generation->id);
                $parameters['generation'] = $generation->generations; // Add to parameters array
            } else {
                $province = Province::where('name_th', $kw3)->orWhere('name_en', $kw3)->first();
                if ($province) {
                    $parameters['province'] = $province->name_th; // Add to parameters array
                } else {
                    // Generation or province not found, return empty results
                    return view('frontend.carsearch', ['results' => collect(), 'parameters' => $parameters]);
                }
            }
        }

        // Check kw4 for sub_model or province
        if ($kw4) {
            if ($generation) {
                $sub_model = sub_modelsModel::where('sub_models', $kw4)->where('generations_id', $generation->id)->first();
            }
            if ($sub_model) {
                $query->where('sub_models_id', $sub_model->id);
                $parameters['sub_model'] = $sub_model->sub_models; // Add to parameters array
            } else {
                $province = Province::where('name_th', $kw4)->orWhere('name_en', $kw4)->first();
                if ($province) {
                    $parameters['province'] = $province->name_th; // Add to parameters array
                } else {
                    // Sub-model or province not found, return empty results
                    return view('frontend.carsearch', ['results' => collect(), 'parameters' => $parameters]);
                }
            }
        }

        // Check kw5 for province
        if ($kw5) {
            $province = Province::where('name_th', $kw5)->orWhere('name_en', $kw5)->first();
            if ($province) {
                $parameters['province'] = $province->name_th; // Add to parameters array
            } else {
                // Province not found, return empty results
                return view('frontend.carsearch', ['results' => collect(), 'parameters' => $parameters]);
            }
        }

        // Apply province filter if set
        if ($province) {
            $query->where('province', 'like', '%' . $province->name_th . '%');
        }

        // Get the SQL query and parameters
        $sql = $query->toSql();
        $bindings = $query->getBindings();

        // Replace placeholders with actual values for debugging
        foreach ($bindings as $binding) {
            $value = is_string($binding) ? "'" . addslashes($binding) . "'" : $binding;
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }

        // Debugging: dump the SQL query with actual values
        // dd($sql);

        // Fetch cars with eager loading of all related models
        $cars = $query->with([
            'brand', 
            'model', 
            'generation', 
            'subModel', 
            'user', 
            'customer', 
            'myDeal', 
            'contacts'
        ])->get();

        // Fetch recommendations with eager loading of all related models
        $recommendations = $this->getRecommendedCars()->load([
            'brand', 
            'model', 
            'generation', 
            'subModel', 
            'user', 
            'customer', 
            'myDeal', 
            'contacts'
        ]);

        // Generate breadcrumbs
        $breadcrumb = [];
        if (isset($parameters['brand'])) {
            $breadcrumb[] = ['title' => $parameters['brand'], 'url' => route('carsearchPage', ['kw1' => $parameters['brand']])];
        }
        if (isset($parameters['model'])) {
            $breadcrumb[] = ['title' => $parameters['model'], 'url' => route('carsearchPage', ['kw1' => $parameters['brand'], 'kw2' => $parameters['model']])];
        }
        if (isset($parameters['generation'])) {
            $breadcrumb[] = ['title' => $parameters['generation'], 'url' => route('carsearchPage', ['kw1' => $parameters['brand'], 'kw2' => $parameters['model'], 'kw3' => $parameters['generation']])];
        }
        if (isset($parameters['sub_model'])) {
            $breadcrumb[] = ['title' => $parameters['sub_model'], 'url' => route('carsearchPage', ['kw1' => $parameters['brand'], 'kw2' => $parameters['model'], 'kw3' => $parameters['generation'], 'kw4' => $parameters['sub_model']])];
        }

        // Return view with results, recommendations, and breadcrumbs
        return view('frontend.carsearch', [
            'results' => $cars,
            'recommendations' => $recommendations,
            'breadcrumb' => $breadcrumb,
            'brand_breadcrumb' => $parameters['brand'] ?? null,
            'model_breadcrumb' => $parameters['model'] ?? null,
            'generation_breadcrumb' => $parameters['generation'] ?? null,
            'sub_model_breadcrumb' => $parameters['sub_model'] ?? null,
            'provincesearch' => $parameters['province'] ?? null
        ]);
    }





    // public function carsearchPage(Request $request, $brand = null, $model = null, $generation = null, $sub_model = null, $province = null)
    // {
    //     // Initialize query
    //     $query = carsModel::query();
        
    //     // Apply filters based on the parameters
    //     if ($brand) {
    //         $brandId = brandsModel::where('title', $brand)->value('id');
    //         if ($brandId) {
    //             $query->where('brand_id', $brandId);
    //         }
    //     }
    //     if ($model) {
    //         $modelId = modelsModel::where('model', $model)->value('id');
    //         if ($modelId) {
    //             $query->where('model_id', $modelId);
    //         }
    //     }
    //     if ($generation) {
    //         $generationId = generationsModel::where('generations', $generation)->value('id');
    //         if ($generationId) {
    //             $query->where('generation_id', $generationId);
    //         }
    //     }
    //     if ($sub_model) {
    //         $subModelId = sub_modelsModel::where('sub_models', $sub_model)->value('id');
    //         if ($subModelId) {
    //             $query->where('sub_model_id', $subModelId);
    //         }
    //     }
    //     if ($province) {
    //         $query->where('province', 'like', '%' . $province . '%');
    //     }
    //     if ($request->has('color')) {
    //         $color = $request->input('color');
    //         $query->where('color', 'like', '%' . $color . '%');
    //     }

    //     // Check if any filters are applied
    //     $hasFilters = $brand || $model || $generation || $sub_model || $province || $request->has('color');
    //     dd($hasFilters);
    //     // Fetch cars with eager loading of all related models
    //     $cars = $hasFilters 
    //         ? $query->with([
    //             'brand', 
    //             'model', 
    //             'generation', 
    //             'subModel', 
    //             'user', 
    //             'customer', 
    //             'myDeal', 
    //             'contacts'
    //         ])->get()
    //         : collect();

    //     // Fetch recommendations with eager loading of all related models
    //     $recommendations = $this->getRecommendedCars()->load([
    //         'brand', 
    //         'model', 
    //         'generation', 
    //         'subModel', 
    //         'user', 
    //         'customer', 
    //         'myDeal', 
    //         'contacts'
    //     ]);

    //     // Generate breadcrumbs
    //     $breadcrumb = [];
    //     if ($brand) {
    //         $breadcrumb[] = ['title' => $brand, 'url' => route('carsearchPage', ['brand' => $brand])];
    //     }
    //     if ($model) {
    //         $breadcrumb[] = ['title' => $model, 'url' => route('carsearchPage', ['brand' => $brand, 'model' => $model])];
    //     }
    //     if ($generation) {
    //         $breadcrumb[] = ['title' => $generation, 'url' => route('carsearchPage', ['brand' => $brand, 'model' => $model, 'generation' => $generation])];
    //     }
    //     if ($sub_model) {
    //         $breadcrumb[] = ['title' => $sub_model, 'url' => route('carsearchPage', ['brand' => $brand, 'model' => $model, 'generation' => $generation, 'sub_model' => $sub_model])];
    //     }

    //     // Return view with results, recommendations, and breadcrumbs
    //     return view('frontend.carsearch', [
    //         'results' => $cars,
    //         'recommendations' => $recommendations,
    //         'breadcrumb' => $breadcrumb,
    //         'brand_breadcrumb' => $brand,
    //         'model_breadcrumb' => $model,
    //         'generation_breadcrumb' => $generation,
    //         'sub_model_breadcrumb' => $sub_model,
    //         'provincesearch' => $province
    //     ]);
    // }













    
    
    

    private function getRecommendedCars()
    {
        return carsModel::latest()->limit(4)->get(); // Example: returning the latest 4 cars
    }
}
