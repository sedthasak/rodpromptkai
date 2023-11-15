<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\brandsModel;
use App\Models\modelsModel;

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
                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-2 xl:col-span-2">
                    <div class="box">
                        <div class="p-3">
                            <div class="image-fit h-40 overflow-hidden rounded-md before:absolute before:top-0 before:left-0 before:z-10 before:block before:h-full before:w-full before:bg-gradient-to-t before:from-black before:to-black/10 2xl:h-56">
                                <img class="rounded-md" src="<?php echo asset($res->feature) ?>" alt="rodpromtkai-<?php echo $res->title ?>">
                            </div>
                            <div class="mt-5 text-slate-600 dark:text-slate-500">
                                <div class="flex items-center">
                                    <?php echo strtoupper($res->title) ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-center border-t border-slate-200/60 p-5 dark:border-darkmode-400 lg:justify-end">
                            <a class="mr-auto flex items-center text-primary" href="<?php echo route('BN_brands_preview', ['id' => $res->id]); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="eye" data-lucide="eye" class="lucide lucide-eye stroke-1.5 mr-1 h-4 w-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg> 
                            </a>
                            <a class="mr-3 flex items-center" href="<?php echo route('BN_brands_edit', ['id' => $res->id]); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-1 h-4 w-4"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> Edit
                            </a>
                            <!-- <a class="flex items-center text-danger" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash" data-lucide="trash" class="lucide lucide-trash stroke-1.5 mr-1 h-4 w-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg> Delete
                            </a> -->
                        </div>
                    </div>
                </div>
                <?php
            }  
        }else{
            echo "Not Found!!!";
        }
    }
    public function BN_brands_preview(Request $request, $id)
    {
        $brands = brandsModel::find($id);
        return view('backend/brands-preview', [ 
            'default_pagename' => 'ตัวอย่างบทความ',
            'brands' => $brands,
        ]);
    }

    public function BN_excelcars_add()
    {
        return view('backend/brands-excelcars-add');
    }

    public function BN_excelcars_store(Request $request)
    {
        if ($request->hasFile('excel_file')) {
            $fileName = uniqid() . '_' . $request->file('new_police')->getClientOriginalName();
            $request->file('new_police')->move(public_path('assets/addPoliceFile'), $fileName);
            $path = public_path('assets/addPoliceFile/' . $fileName);
            $spreadsheet = IOFactory::load($path);
    
            $worksheetName = 'Sheet1';
            $worksheet = $spreadsheet->getSheetByName($worksheetName);
            $missingIDcard = [];
            
            if ((empty($worksheet->getCell('C2')->getValue()) && empty($worksheet->getCell('A2')->getValue())) &&
                (empty($worksheet->getCell('C3')->getValue()) && empty($worksheet->getCell('A3')->getValue())) &&
                (empty($worksheet->getCell('C4')->getValue()) && empty($worksheet->getCell('A4')->getValue()))
            ) {
                return redirect()->back()->with('error', 'No data found in the Excel file.');
            }
            
            $highestRow = $worksheet->getHighestRow() + 3;
            for ($row = 2; $row <= $highestRow; $row++) {
                $cellValueC = $worksheet->getCell('C' . $row)->getValue();
                $cellValueC1 = $worksheet->getCell('C' . ($row + 1))->getValue();
                $cellValueC2 = $worksheet->getCell('C' . ($row + 2))->getValue();
                $cellValueA = $worksheet->getCell('A' . $row)->getValue();
                $cellValueB = $worksheet->getCell('B' . $row)->getValue();
                $cellValueD = $worksheet->getCell('D' . $row)->getValue();
                $cellValueE = $worksheet->getCell('E' . $row)->getValue();
                $cellValueF = $worksheet->getCell('F' . $row)->getValue();
                $cellValueG = $worksheet->getCell('G' . $row)->getValue();
                $cellValueH = $worksheet->getCell('H' . $row)->getValue();
                $cellValueI = $worksheet->getCell('I' . $row)->getValue();
                $cellValueJ = $worksheet->getCell('J' . $row)->getValue();
                $cellValueK = $worksheet->getCell('K' . $row)->getValue();
                $cellValueL = $worksheet->getCell('L' . $row)->getValue();
                $cellValueM = $worksheet->getCell('M' . $row)->getValue();
                $cellValueN = $worksheet->getCell('N' . $row)->getValue();
                $cellValueO = $worksheet->getCell('O' . $row)->getValue();
                $cellValueP = $worksheet->getCell('P' . $row)->getValue();
                $RankTable = Rank::where('rank_name', $cellValueI)->first();
                $PositionTable = Position::where('position_number', $cellValueO)->first();
                $existedPP = Users2::where('id_card', $cellValueC)->first();
                $max_num_rows_rank = Users2_rank::max("num_rows");
                $max_num_rows_users = Users2::max("num_rows");
                $max_num_rows_salary = Users2_salary_promote::max("num_rows");
                $max_num_rows_position = Users2_position::max("num_rows");
                
                if (!empty($cellValueC)) {
                    
                    if (!empty($existedPP)) {
                        $missingIDcard[] = 'This ' . $cellValueC . ' already existed in database. Did not add to database.';
                    } else {
                        // เช็คคนคอย
                        $position_id = $PositionTable->id;
                        $users2_qry = Users2::where("position_id", $position_id)->where("special_status", 0)->get();
                        if ($users2_qry->count() > 0) {
                            // คนลอย
                            Users2::where('position_id', $position_id)->update(['special_status' => '1']);
                            Users2::where('position_id', $position_id)->update(['special_status_comment' => 'คนลอย']);
                            // Users2::where('position_id', $position_id)->update(['position_id' => 9999]);
                            
                            
                        }
                        else {
                            // $missingIDcard[] = 'This ' . $cellValueO . ' already existed in database. Did not add to database.';
                        }
                        $Users2add = new Users2();
                        $Users2add->first_name = $cellValueA;
                        $Users2add->last_name = $cellValueB;
                        $Users2add->id_card = $cellValueC;
                        $Users2add->birth_date = $this->datepicker_format($cellValueD);
                        $Users2add->pratuan_qualification = $cellValueE;
                        $Users2add->pratuan_school = $cellValueF;
                        $Users2add->commision_qualification = $cellValueG;
                        $Users2add->commission_school = $cellValueH;
                        $Users2add->rank_id = $RankTable->id;
                        $Users2add->position_id = $PositionTable->id;
                        $Users2add->num_rows = $max_num_rows_users + 1;
                        $Users2add->save();
                        
                        $SalaryAdd = new Users2_salary_promote();
                        $SalaryAdd->users2_id = $Users2add->id;
                        $SalaryAdd->salary = $cellValueK;
                        $SalaryAdd->step = $cellValueL;
                        $SalaryAdd->level = $cellValueM;
                        $SalaryAdd->num_rows = $max_num_rows_salary + 1;
                        $SalaryAdd->save();
                        
                        $RankAdd = new Users2_rank();
                        $RankAdd->users2_id = $Users2add->id;
                        $RankAdd->rank_id = $Users2add->rank_id;
                        $RankAdd->appointment_date = $this->datepicker_format($cellValueN);
                        $RankAdd->num_rows = $max_num_rows_rank + 1;
                        $RankAdd->save();
                        
                        $positionAdd = new Users2_position();
                        $positionAdd->users2_id = $Users2add->id;
                        $positionAdd->position_id = $Users2add->position_id;
                        $positionAdd->appointment_date = $this->datepicker_format($cellValueP);
                        $positionAdd->num_rows = $max_num_rows_position + 1;
                        
                        $nameAdd = new users2_name();
                        $nameAdd->first_name = $cellValueA;
                        $nameAdd->last_name = $cellValueB;
                        $nameAdd->users2_id = $Users2add->id;
                        $nameAdd->num_rows = 1;
                        $nameAdd->save();
                        
                    }
                    
                    // if ($row == $highestRow) {
                    //         if (!empty($missingIDcard)) {
                    //             return redirect()->back()->with('success', 'Police data added successfully.');
                    //         }
                    //         else {
                    //             $errorID = implode(',' , $missingIDcard) . 'The rest is added.';
                    //             return redirect()->back()->with('error', $errorID);
                    //         }
                    // }
                    
                } elseif ( 
                    ($cellValueC == null) && ($cellValueC1 != null) && ($cellValueC2 != null) ||
                    ($cellValueC == null) && ($cellValueC1 == null) && ($cellValueC2 != null) ||
                    ($cellValueC == null) && ($cellValueC1 != null) && ($cellValueC2 == null)
                ) {
                    $missingIDcard[] = 'Missing ID card in row ' . $row;
                } elseif ( (empty($missingIDcard)) && ($cellValueC == null) && ($cellValueC1 == null) && ($cellValueC2 == null) ) {
                    return redirect()->back()->with('success', 'Police data added successfully.');
                } else {
                    $errorID = implode('.\n' , $missingIDcard) . '.\nThe rest is added.';
                    return redirect()->back()->with('error', $errorID);
                }
            }
        } else {
            return redirect()->back()->with('error', 'Please select file to update');
        }
    }
}
