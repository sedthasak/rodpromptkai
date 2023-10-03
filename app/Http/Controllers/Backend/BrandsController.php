<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\brandsModel;

class BrandsController extends Controller
{
    public function BN_brands()
    {
        return view('backend/brands', [ 
            'default_pagename' => 'ยี่ห้อรถ',
            
        ]);
    }
    public function BN_brands_add(Request $request)
    {
        return view('backend/brands-add', [ 
            'default_pagename' => 'เพิ่มยี่ห้อรถ',
        ]);
    }
    public function BN_brands_add_action(Request $request)
    {
        $brands = new brandsModel;

        if($request->hasFile('feature')){
            $file = $request->file('feature');
            $destinationPath = public_path('/uploads');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = 'logo-'.time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/'.$newfilenam;
            $brands->feature = $filepath;
        }

        $brands->title = $request->title;
        $brands->excerpt = $request->excerpt;
        $brands->content = $request->content;
        $brands->user_id = $request->user_id;
        $brands->save();

        return redirect(route('BN_brands'))->with('success', 'เพิ่มสำเร็จ !');
    }
    public function BN_brands_edit(Request $request, $id)
    {
        $brands = brandsModel::find($id);
        return view('backend/brands-edit', [ 
            'default_pagename' => 'แก้ไขยี่ห้อรถ',
            'brands' => $brands,
        ]);
    }
    public function BN_brands_edit_action(Request $request)
    {
        $brands = brandsModel::find($request->id);

        if($request->hasFile('feature')){
            $file = $request->file('feature');
            $destinationPath = public_path('/uploads');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = 'logo-'.time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/'.$newfilenam;
            $brands->feature = $filepath;
        }

        $brands->title = $request->title;
        $brands->excerpt = $request->excerpt;
        $brands->content = $request->content;
        $brands->user_id = $request->user_id;
        $brands->update();

        return redirect(route('BN_brands'))->with('success', 'แก้ไขสำเร็จ !');
    }
    public function BN_brandsFetch()
    {
        $query = brandsModel::all()->sort();
        $output = '';
        if($query->count() > 0){
            foreach($query as $key => $res){
                ?>
                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                    <div class="box">
                        <div class="p-5">
                            <div class="image-fit h-40 overflow-hidden rounded-md before:absolute before:top-0 before:left-0 before:z-10 before:block before:h-full before:w-full before:bg-gradient-to-t before:from-black before:to-black/10 2xl:h-56">
                                <img class="rounded-md" src="<?php echo asset($res->feature) ?>" alt="rodpromtkai-<?php echo $res->title ?>">
                                <div class="absolute bottom-0 z-10 px-5 pb-6 text-white">
                                    <?php echo $res->title ?>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center border-t border-slate-200/60 p-5 dark:border-darkmode-400 lg:justify-end">
                            <a class="mr-auto flex items-center text-primary" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="eye" data-lucide="eye" class="lucide lucide-eye stroke-1.5 mr-1 h-4 w-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg> Preview
                            </a>
                            <a class="mr-3 flex items-center" href="<?php echo route('BN_brands_edit', ['id' => $res->id]); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-1 h-4 w-4"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> Edit
                            </a>
                            <a class="flex items-center text-danger" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash" data-lucide="trash" class="lucide lucide-trash stroke-1.5 mr-1 h-4 w-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg> Delete
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }  
        }else{
            echo "Not Found!!!";
        }
    }
}
