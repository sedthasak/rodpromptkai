<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\modelsModel;
use App\Models\brandsModel;
use App\Models\generationsModel;
use App\Models\sub_modelsModel;

class Sub_modelsController extends Controller
{
    //
    public function BN_sub_models()
    {
        return view('backend/sub_models', [ 
            'default_pagename' => 'รุ่นย่อย',
            
        ]);
    }

    public function BN_sub_models_add(Request $request)
    {
        $generations = generationsModel::all();
        return view('backend/sub_models-add', [ 
            'default_pagename' => 'เพิ่มรุ่นย่อยรถ',
            'generations' => $generations,
        ]);
    }
    public function BN_sub_models_add_action(Request $request)
    {
        $sub_modelsModel = new sub_modelsModel;

        if($request->hasFile('feature')){
            $file = $request->file('feature');
            $destinationPath = public_path('/uploads');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = 'sub_model-'.time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/'.$newfilenam;
            $sub_modelsModel->feature = $filepath;
        }

        $sub_modelsModel->generations_id = $request->generations_id;
        $sub_modelsModel->sub_models = $request->sub_models;
        $sub_modelsModel->description = $request->description;
        $sub_modelsModel->save();

        return redirect(route('BN_sub_models'))->with('success', 'เพิ่มสำเร็จ !');

    }
    public function BN_sub_models_edit(Request $request, $id)
    {

    }
    public function BN_sub_models_edit_action(Request $request)
    {

    }
    public function BN_sub_modelsFetch()
    {
        $query = DB::table('sub_models')
            ->join('generations', 'sub_models.generations_id', '=', 'generations.id')
            ->get();

        $output = '';
        if($query->count() > 0){
            ?>
                <div class="grid gap-6 mt-5 p-5 box">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="">
                                <tr class="">
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">#</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">โฉม</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">รุ่นย่อย</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">*</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach($query as $key => $res){
                                $count++;
                                ?>
                                <tr class="">
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $count ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->generations ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->sub_models ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"></td>
                                    
                                </tr>
                                <?php
                                }
                                ?>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
        }else{
            echo "Not Found!!!";
        }
    }
}
