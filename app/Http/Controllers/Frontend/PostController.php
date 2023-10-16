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
use Illuminate\Support\Facades\Storage;
use File;

class PostController extends Controller
{
    public function carpostSelectBrand(Request $request) {

        return response()->json($request);
        // return response($request);
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
