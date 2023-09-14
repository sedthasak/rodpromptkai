<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendPageController extends Controller
{

    public function notificationPage()
    {
        return view('frontend/notification', [

        ]);
    }
    public function loginPage()
    {
        return view('frontend/login', [

        ]);
    }
    public function indexPage()
    {
        return view('frontend/index-page', [
             // Specify the base layout.
             // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
             // The default value is 'side-menu'
 
            //  'layout' => 'side-menu'
        ]);
    }
}
