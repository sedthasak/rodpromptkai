<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\carsModel;

use App\Models\categoriesModel;
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
        $brand = $model = $generation = $sub_model = $province = $category = null;
        $parameters = []; // Initialize the parameters array
        $searchFailed = false; // Variable to track if search should return empty results

        // Check kw1 for category
        if ($kw1 && !$searchFailed) {
            $category = categoriesModel::where('name', $kw1)->first();
            if ($category) {
                $query->whereJsonContains('category', (string) $category->id);
                $parameters['category'] = $category->name; // Add to parameters array
            }
        }

        // Check kw1 for brand (if not already used for category)
        if ($kw1 && !$category && !$searchFailed) {
            $brand = brandsModel::where('title', $kw1)->first();
            if ($brand) {
                $query->where('brand_id', $brand->id);
                $parameters['brand'] = $brand->title; // Add to parameters array
            } else {
                // Brand not found, mark search as failed
                $searchFailed = true;
            }
        }

        // Check kw2 for model or province
        if ($kw2 && !$searchFailed) {
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
                    // Model or province not found, mark search as failed
                    $searchFailed = true;
                }
            }
        }

        // Check kw3 for generation or province
        if ($kw3 && !$searchFailed) {
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
                    // Generation or province not found, mark search as failed
                    $searchFailed = true;
                }
            }
        }

        // Check kw4 for sub_model or province
        if ($kw4 && !$searchFailed) {
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
                    // Sub-model or province not found, mark search as failed
                    $searchFailed = true;
                }
            }
        }

        // Check kw5 for province
        if ($kw5 && !$searchFailed) {
            $province = Province::where('name_th', $kw5)->orWhere('name_en', $kw5)->first();
            if ($province) {
                $parameters['province'] = $province->name_th; // Add to parameters array
            } else {
                // Province not found, mark search as failed
                $searchFailed = true;
            }
        }

        // Apply province filter if set
        if ($province && !$searchFailed) {
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
        $cars = $searchFailed ? collect() : $query->with([
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
        if (isset($parameters['category'])) {
            $breadcrumb[] = ['title' => $parameters['category'], 'url' => route('carsearchPage', ['kw1' => $parameters['category']])];
        }
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

        // Return view with results, recommendations, breadcrumbs, and searchFailed flag
        return view('frontend.carsearch', [
            'results' => $cars,
            'recommendations' => $recommendations,
            'breadcrumb' => $breadcrumb,
            'brand_breadcrumb' => $parameters['brand'] ?? null,
            'model_breadcrumb' => $parameters['model'] ?? null,
            'generation_breadcrumb' => $parameters['generation'] ?? null,
            'sub_model_breadcrumb' => $parameters['sub_model'] ?? null,
            'provincesearch' => $parameters['province'] ?? null,
            'searchFailed' => $searchFailed
        ]);
    }




    private function getRecommendedCars()
    {
        return carsModel::latest()->limit(4)->get(); // Example: returning the latest 4 cars
    }
}
