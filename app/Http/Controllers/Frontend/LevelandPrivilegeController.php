<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdatePriceRequest;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\DB;
// use File;

use App\Models\LevelModel;

class LevelandPrivilegeController extends Controller
{
    public function specialprivilegesPage(Request $request)
    {
        // ดึงข้อมูล Level ทั้งหมดจากฐานข้อมูล
        $levels = LevelModel::all();
    
        // สร้าง Array เพื่อเก็บหัวข้อทั้งหมดจาก text1 ถึง text12
        $allTexts = [];
    
        // วนลูปดึงข้อมูล text1 ถึง text12 ของแต่ละ level
        foreach ($levels as $level) {
            for ($i = 1; $i <= 12; $i++) {
                $textField = 'text' . $i;
                if (!empty($level->$textField)) {
                    $allTexts[] = $level->$textField;
                }
            }
        }
    
        // ลบค่าซ้ำใน allTexts และจัดเรียง
        $allTexts = array_values(array_unique($allTexts));
    
        // ส่งข้อมูลไปยัง view
        return view('frontend/special-privileges', [
            'levels' => $levels,
            'allTexts' => $allTexts,
        ]);
    }
    
    
    
    public function seealltiersPage(Request $request) {
        // return dd($request->yearhigh);
        return view('frontend/seeall-tiers', [
            // "brand" => $brand,
        ]);
    }
    public function profilememberPage(Request $request, $level) {
        // return dd($request->yearhigh);
        return view('frontend/profile-member', [
            "level" => $level,
        ]);
    }
}
