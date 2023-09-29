<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class SessionLoginComposer
{ 



    public function SetSession()
    {
        $codetosend = rand(100000,999999);
        session()->put('codetosend', $codetosend);
    }
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('codetosend',
            session()->has('codetosend') ? session('codetosend') : ""
        );

        // $view->with('dark_mode', 
        //     session()->has('dark_mode') ? filter_var(session('dark_mode'), FILTER_VALIDATE_BOOLEAN) : false
        // );
    }
}
