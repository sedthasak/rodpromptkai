<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\modelsModel;
use App\Models\brandsModel;
use App\Models\generationsModel;
use App\Models\sub_modelsModel;

class BackendPageController extends Controller
{


    public function BN_setfooter()
    {
        return view('backend/setfooter', [ 
            'default_pagename' => 'ตั้งค่า footer',
            
        ]);
    }

    // public function BN_generations()
    // {
    //     return view('backend/models', [ 
    //         'default_pagename' => 'โฉมรถ',
    //     ]);
    // }
    public function BN_car()
    {
        return view('backend/car', [ 
            'default_pagename' => 'ข้อมูลรถ',
            
        ]);
    }

    

    public function BN_modelsss()
    {
        return view('backend/backend-dashboard', [ 
            'default_pagename' => 'แท็ก',
            
        ]);
    }



    
    public function BN_tags()
    {
        return view('backend/backend-dashboard', [ 
            'default_pagename' => 'แท็ก',
            
        ]);
    }
    
    
    public function BN_setting()
    {
        return view('backend/backend-dashboard', [ 
            'default_pagename' => 'ตั้งค่าระบบ',
        ]);
    }
    
    
    public function BN_dev()
    {
        return view('backend/dev', [ 
            'default_pagename' => 'Development',
        ]);
    }
    

    public function backendDashboard()
    {
        return view('backend/backend-dashboard', [
            // 'layout' => 'side-menu',
            'default_pagename' => 'แดชบอร์ด',
        ]);
    }
    
}
