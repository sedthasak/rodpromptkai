<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;

use Illuminate\Http\Request;

use App\Models\User;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsersController extends Controller
{

    public function BN_user_add()
    {
        return view('backend/users-add', [ 
            'default_pagename' => 'เพิ่มยูสเซอร์',
        ]);
    }

    public function BN_user()
    {
        return view('backend/users', [ 
            'default_pagename' => 'ยูสเซอร์',
        ]);
    }

    public function BN_usersFetch()
    {
        $queryy = User::all()->sortDesc();
        $output = '';
        if($queryy->count() > 0){
            ?>
                <div class="grid gap-6 mt-5 p-5 box">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="">
                                <tr class="">
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">#</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">ชื่อ</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">อีเมล</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach($queryy as $key => $res){
                                $count++;
                                ?>
                                <tr class="">
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $count ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->name ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->email ?></td>
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


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function BN_user_add_action(Request $request)
    {
        
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        $User = new User;

        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->gender = 'male';
        $User->active = '1';

        $User->save();
        
        event(new Registered($User));

        return redirect(route('BN_user'));
    }
}
