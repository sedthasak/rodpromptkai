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
use App\Models\carsModel;

class PostsController extends Controller
{
    public function BN_posts()
    {
        return view('backend/post', [ 
            'default_pagename' => 'โพสท์ลงขายรถ',
            
        ]);
    }
    public function BN_posts_add(Request $request)
    {
        return view('backend/post-add', [ 
            'default_pagename' => 'เพิ่มโพสท์ลงขายรถ',
        ]);
    }
    public function BN_postsFetch()
    {
        $query = carsModel::all()->sort();
        $output = '';
        if($query->count() > 0){
            foreach($query as $key => $res){
                ?>
                <tr class="intro-x">
                    <td>
                        <a href="" class="font-medium whitespace-nowrap"><?php echo date('d/m/Y', strtotime($res->created_at)) ?></a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"><?php echo date('H:i:s', strtotime($res->created_at)) ?> น.</div>
                    </td>
                    <td>
                        <a href="" class="font-medium whitespace-nowrap">ชนะพล สายนิพนธ์</a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">ดีลเลอร์</div>
                    </td>
                    <td>
                        <a href="" class="font-medium whitespace-nowrap">2016 Honda CR-V</a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">CR-V 2.0 E (MY12) (MNC)</div>
                    </td>
                    <td class="text-center"><?php echo $res->price ?> ฿</td>
                    <td class="w-40">
                        <div class="flex items-center justify-center text-success">
                            <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> อนุมัติ
                        </div>
                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="#">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> แก้ไข
                            </a>
                            <a class="flex items-center mr-3" href="#">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> ดูโพสท์
                            </a>
                            
                        </div>
                    </td>
                </tr>
                <?php
            }  
        }else{
            ?>
            <tr class="intro-x">  
                <td colspan="6" class="px-5 py-3 dark:border-darkmode-300 border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">Not Found!!!</td>
            </tr>
            <?php
        }
    }
}
