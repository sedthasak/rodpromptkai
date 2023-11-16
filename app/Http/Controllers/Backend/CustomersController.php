<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;

use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use App\Models\Customer;

class CustomersController extends Controller
{
    
    public function BN_customers()
    {
        return view('backend/customer', [ 
            'default_pagename' => 'ลูกค้า',
        ]);
    }
    public function BN_customersFetch()
    {
        $queryy = Customer::all()->sortDesc();
        $output = '';

        // echo "<pre>";
        // print_r($queryy);
        // echo "<pre>";

        if($queryy->count() > 0){
            ?>
                <div class="grid gap-6 mt-5 p-5 box">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="">
                                <tr class="">
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">#</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">เบอร์โทร</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">ชื่อ</td>
                                    
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">อีเมล</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"></td>
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
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->phone ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->firstname." ".$res->lastname ?></td>
                                    
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->email ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap">
                                        <a href="#">ดูข้อมูล</a>
                                        &emsp;&emsp;<a href="<?php echo route('BN_customers_edit', ['id' => $res->id]); ?>">แก้ไข</a></td>
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
    public function BN_customers_add(Request $request)
    {
        return view('backend/customer-add', [ 
            'default_pagename' => 'เพิ่มรายชื่อลูกค้า',
        ]);
    }
    public function BN_customers_add_action(Request $request)
    {
        // dd($request);
        $Customer = new Customer;

        $file = $request->file('image');
        $destinationPath = public_path('/uploads/profile/');
        $filename = $file->getClientOriginalName();

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $newfilenam = time() . '.' .$ext;
        $file->move($destinationPath, $newfilenam);
        $filepath = 'uploads/profile/'.$newfilenam;
        
        $Customer->phone = $request->phone;
        $Customer->firstname = $request->firstname;
        $Customer->lastname = $request->lastname;
        $Customer->email = $request->email;
        $Customer->image = $filepath;
        $Customer->save();

        // if(isset($Customer->id)){
        //     $usersavelog = auth()->user();
        //     $idsavelog = auth()->user()->id; 
        //     $emailsavelog = auth()->user()->email;
        //     $para = array(
        //         'part' => 'backend',
        //         'user' => $idsavelog,
        //         'ref' => $categories->id,
        //         'remark' => 'User '.$idsavelog.' Create new Category!',
        //         'event' => 'create category',
        //     );
        //     $result = (new LogsSaveController)->create_log($para);
        // }

        return redirect(route('BN_customers'));

    }
    public function BN_customers_edit(Request $request, $id)
    {
        $Customer = Customer::find($id);
        return view('backend/customer-edit', [ 
            'default_pagename' => 'แก้ไขรายชื่อลูกค้า',
            'Customer' => $Customer,
        ]);
    }
    public function BN_customers_edit_action(Request $request)
    {
        // dd($request);
        $Customer = Customer::find($request->id);
        if($request->hasFile('image')){

            $oldPath = public_path($Customer->image);
            if(File::exists($oldPath)){
                File::delete($oldPath);
            }

            $file = $request->file('image');
            $destinationPath = public_path('/uploads/profile');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/profile/'.$newfilenam;

            $Customer->image = $filepath;
        }

        $Customer->phone = $request->phone;
        $Customer->firstname = $request->firstname;
        $Customer->lastname = $request->lastname;
        $Customer->email = $request->email;
        
        $Customer->update();

        // if(isset($categories->id)){
        //     $usersavelog = auth()->user();
        //     $idsavelog = auth()->user()->id; 
        //     $emailsavelog = auth()->user()->email;
        //     $para = array(
        //         'part' => 'backend',
        //         'user' => $idsavelog,
        //         'ref' => $categories->id,
        //         'remark' => 'User '.$idsavelog.' Update Category!',
        //         'event' => 'update category',
        //     );
        //     $result = (new LogsSaveController)->create_log($para);
        // }

        return redirect(route('BN_customers'));

    }

}
