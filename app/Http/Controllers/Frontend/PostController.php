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
use Illuminate\Support\Facades\DB;
use File;

class PostController extends Controller
{
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

    public function carpostregisterPage()
    {
        $provinces = provincesModel::all();
        $brands = brandsModel::all();
        // $models = modelsModel::all();
        // $query = DB::table('generations')->where('id', 1)->first();
        return view('frontend/carpost-register', [
            'provinces' => $provinces,
            'brands' => $brands,
            // 'query' => $query,
            // 'a' => 'test',
        ]);
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
