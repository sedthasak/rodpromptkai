<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\newsModel;

class NewsController extends Controller
{
    public function BN_news()
    {
        return view('backend/news', [ 
            'default_pagename' => 'ข่าวรถยนต์',
        ]);
    }
    public function BN_news_add(Request $request)
    {
        return view('backend/news-add', [ 
            'default_pagename' => 'เพิ่มข่าวใหม่',
        ]);
    }
    public function BN_newsFetch()
    {
        $query = newsModel::all()->sort();
        $output = '';
        if($query->count() > 0){
            ?>
                <div class="grid gap-6 mt-5 p-5 box">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="">
                                <tr class="">
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">#</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">ชื่อ</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">คำอธิบาย</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">รูปภาพ</td>
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
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->name ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->description ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap">
                                        <img width="150" src="<?php echo url($res->feature) ?>" />
                                    </td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><a href="<?php echo route('BN_categories_edit', ['id' => $res->id]); ?>">แก้ไข</a></td>
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
