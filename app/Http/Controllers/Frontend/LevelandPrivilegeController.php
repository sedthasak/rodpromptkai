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
    public function specialprivilegesPage(Request $request) {
        // return dd($request->yearhigh);
        return view('frontend/special-privileges', [
            // "brand" => $brand,
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
