<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\modelsModel;
use App\Models\brandsModel;

class ModelsController extends Controller
{
    public function BN_carmd()
    {
        return view('backend/models', [ 
            'default_pagename' => 'รุ่นรถ',
        ]);
    }
    public function BN_carmd_add(Request $request)
    {
        $brands = brandsModel::all();
        return view('backend/models-add', [ 
            'default_pagename' => 'เพิ่มรุ่นรถ',
            'brands' => $brands,
        ]);
    }
    public function BN_carmd_add_action(Request $request)
    {
        $models = new modelsModel;

        if($request->hasFile('feature')){
            $file = $request->file('feature');
            $destinationPath = public_path('/uploads');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = 'model-'.time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/'.$newfilenam;
            $models->feature = $filepath;
        }

        $models->brand_id = $request->brand_id;
        $models->model = $request->model;
        $models->modelyear = $request->modelyear;
        $models->submodel = $request->submodel;
        $models->description = $request->description;
        $models->save();

        return redirect(route('BN_carmd'))->with('success', 'เพิ่มสำเร็จ !');

    }
    public function BN_carmd_edit(Request $request, $id)
    {

    }
    public function BN_carmd_edit_action(Request $request)
    {

    }
    public function BN_carmdFetch()
    {
        $query = modelsModel::all()->sort();
        $output = '';
        if($query->count() > 0){
            ?>
                <div class="grid gap-6 mt-5 p-5 box">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="">
                                <tr class="">
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">#</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">ยี่ห้อ</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">รุ่น</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">รุ่นปี</td>
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
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->brand_id ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->model ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->modelyear ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->submodel ?></td>
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
