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
    
    public function carsearchPage(Request $request, $brand = null, $model = null, $generation = null, $sub_model = null, $province = null)
    {
        // Initialize query
        $query = carsModel::query();

        // Apply filters based on the parameters
        if ($brand) {
            $brandId = brandsModel::where('title', $brand)->value('id');
            if ($brandId) {
                $query->where('brand_id', $brandId);
            }
        }
        if ($model) {
            $modelId = modelsModel::where('model', $model)->value('id');
            if ($modelId) {
                $query->where('model_id', $modelId);
            }
        }
        if ($generation) {
            $generationId = generationsModel::where('generations', $generation)->value('id');
            if ($generationId) {
                $query->where('generation_id', $generationId);
            }
        }
        if ($sub_model) {
            $subModelId = sub_modelsModel::where('sub_models', $sub_model)->value('id');
            if ($subModelId) {
                $query->where('sub_model_id', $subModelId);
            }
        }
        if ($province) {
            $query->where('province', 'like', '%' . $province . '%');
        }
        if ($request->has('color')) {
            $color = $request->input('color');
            $query->where('color', 'like', '%' . $color . '%');
        }

        // Check if any filters are applied
        $hasFilters = $brand || $model || $generation || $sub_model || $province || $request->has('color');

        // Fetch cars with eager loading of all related models
        $cars = $hasFilters 
            ? $query->with([
                'brand', 
                'model', 
                'generation', 
                'subModel', 
                'user', 
                'customer', 
                'myDeal', 
                'contacts'
            ])->get()
            : collect();

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
        if ($brand) {
            $breadcrumb[] = ['title' => $brand, 'url' => route('carsearchPage', ['brand' => $brand])];
        }
        if ($model) {
            $breadcrumb[] = ['title' => $model, 'url' => route('carsearchPage', ['brand' => $brand, 'model' => $model])];
        }
        if ($generation) {
            $breadcrumb[] = ['title' => $generation, 'url' => route('carsearchPage', ['brand' => $brand, 'model' => $model, 'generation' => $generation])];
        }
        if ($sub_model) {
            $breadcrumb[] = ['title' => $sub_model, 'url' => route('carsearchPage', ['brand' => $brand, 'model' => $model, 'generation' => $generation, 'sub_model' => $sub_model])];
        }

        // Return view with results, recommendations, and breadcrumbs
        return view('frontend.carsearch', [
            'results' => $cars,
            'recommendations' => $recommendations,
            'breadcrumb' => $breadcrumb,
            'brand_breadcrumb' => $brand,
            'model_breadcrumb' => $model,
            'generation_breadcrumb' => $generation,
            'sub_model_breadcrumb' => $sub_model,
            'provincesearch' => $province
        ]);
    }












    
    
    

    private function getRecommendedCars()
    {
        return carsModel::latest()->limit(4)->get(); // Example: returning the latest 4 cars
    }
}
