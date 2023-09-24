<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;

use Illuminate\Http\Request;
use App\Models\Customer;

class BackendPageController extends Controller
{

    



    
    public function BN_tags()
    {
        return view('backend/users', [ 
            'default_pagename' => 'แท็ก',
            
        ]);
    }
    public function BN_categories()
    {
        return view('backend/users', [ 
            'default_pagename' => 'หมวดหมู่',
            
        ]);
    }
    public function BN_posts()
    {
        return view('backend/users', [ 
            'default_pagename' => 'Post',
            
        ]);
    }
    public function BN_setting()
    {
        return view('backend/users', [ 
            'default_pagename' => 'Settings',
        ]);
    }
    public function BN_news()
    {
        return view('backend/users', [ 
            'default_pagename' => 'News',
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
        // $para = array(
        //     'part' => 'backend',
        //     'user' => 6,
        //     'ref' => 11,
        //     'event' => 'ทดสอบ Log',
        // );
        // $result = (new LogsController)->create_log($para);

        return view('backend/backend-dashboard', [
            // 'layout' => 'side-menu',
            'default_pagename' => 'แดชบอร์ด',
        ]);
    }
}
