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
        // dd($request);
        $query = carsModel::query();
        $brand = $model = $generation = $sub_model = $province = $category = null;
        $parameters = [];
        $parameterstitle = [];
        $searchFailed = false;

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

        // Fetch cars
        $cars = $searchFailed ? collect() : $query->with([
            'brand', 'model', 'generation', 'subModel', 'user', 'customer', 'myDeal', 'contacts'
        ])->get();

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
        // dd($formattedKeywords);
        return view('frontend.carsearch', [
            'results' => $cars,
            'recommendations' => $recommendations,
            'breadcrumb' => $breadcrumb,
            'mytitle' => $mytitle,
            'mykeyword' => $formattedKeywords, // Now a formatted string
            'searchFailed' => $searchFailed
        ]);
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
}
