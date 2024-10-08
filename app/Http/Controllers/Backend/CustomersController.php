<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogsSaveController;
// use App\Http\Controllers\Backend\Input;

use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Customer;
use App\Models\provincesModel;
use App\Models\VipPackageModel;
use App\Models\OrderModel;
use App\Models\carsModel;

class CustomersController extends Controller
{
    // Show customer detail page for packages (VIP)
    public function BN_customers_detail_package(Request $request, $id)
    {
        // Fetch the customer based on the passed ID
        $Customer = Customer::find($id);

        // Get orders of type 'package' and 'vip'
        $orders = OrderModel::where('customer_id', $id)
            ->whereIn('type', ['package', 'vip'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('backend/customer-detail-package', [
            'default_pagename' => 'ประวัติการสั่งซื้อแพ็คเกจ',
            'Customer' => $Customer,
            'orders' => $orders
        ]);
    }

    // Show customer detail page for deals
    public function BN_customers_detail_deal(Request $request, $id)
    {
        // Fetch the customer based on the passed ID
        $Customer = Customer::find($id);

        // Get orders of type 'deal'
        $orders = OrderModel::where('customer_id', $id)
            ->where('type', 'deal')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('backend/customer-detail-deal', [
            'default_pagename' => 'ประวัติการสั่งซื้อดีล',
            'Customer' => $Customer,
            'orders' => $orders
        ]);
    }
    public function BN_customers_detail(Request $request, $id)
    {
        // Fetch the customer based on the passed id
        $Customer = Customer::find($id);
    
        // Build the query, filtering by customer_id
        $query = carsModel::with(['customer', 'brand', 'model', 'generation', 'subModel'])
            ->where('customer_id', '=', $id) // Filter by customer_id
            ->orderBy('id', 'desc');
    
        // Paginate the results
        $resultPerPage = 24;
        $cars = $query->paginate($resultPerPage);
    
        // Define the $arrtype array
        $arrtype = [
            'home' => 'รถบ้าน',
            'dealer' => 'ดีลเลอร์',
            'lady' => 'รถผู้หญิง',
        ];
    
        // Return the view with both Customer and cars data
        return view('backend/customer-detail', [ 
            'default_pagename' => 'ลูกค้า',
            'Customer' => $Customer,
            'cars' => $cars,  // Pass the paginated cars to the view
            'arrtype' => $arrtype  // Pass the $arrtype array to the view
        ]);
    }
    
    


    public function BN_customers_register_vip_action(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:customer,id',
            'vip' => 'required|exists:package_vips,id',
            'accept_payment' => 'accepted'
        ]);
    
        $customer = Customer::find($request->id);
        $vipPackage = VipPackageModel::find($request->vip);
    
        // Check if the customer is already a VIP and validate conditions
        if ($customer->role === 'vip') {
            $canRegister = false;
    
            // Check if the current VIP package has expired
            if ($customer->vippack_expire && now()->greaterThan($customer->vippack_expire)) {
                $canRegister = true; // Allow registration as the current package has expired
            } elseif ($vipPackage->id > $customer->vippack) {
                $canRegister = true; // Allow registration for a higher tier package
            }
    
            if (!$canRegister) {
                return redirect()->back()->with('error', 'You can only register for a higher tier VIP package or renew after expiry.');
            }
        }
    
        // Generate order details
        $orderNumber = 'VIP-' . strtoupper(uniqid());
        $vat = $vipPackage->price * 0.07; // 7% VAT
        $netPrice = $vipPackage->price - $vat;
        $total = $vipPackage->price;
    
        // Create the order and get the created order instance
        $order = OrderModel::create([
            'status' => 'success',
            'order_number' => $orderNumber,
            'customer_id' => $request->id,
            'type' => 'vip',
            'net_price' => $total,
            'vat' => $vat,
            'price' => $netPrice,
            'total' => $total,
            'accept' => 1,
            'no_receipt' => 1,
            'payment_method' => 'registration',
            'payment_date' => now(),
            'payment_status' => 'success',
        ]);
    
        // Update customer details including resetting dealer fields
        $customer->update([
            'vippack' => $vipPackage->id,
            'vippack_quota' => $vipPackage->limit,
            'vippack_regis' => now(),
            'vippack_expire' => now()->addYear(),
            'role' => 'vip',
            'accumulate' => $customer->accumulate + $total,
            'order_id' => $order->id,  // Save the order ID
            // Reset dealer fields
            'dealerpack' => null,
            'dealerpack_quota' => null,
            'dealerpack_regis' => null,
            'dealerpack_expire' => null
        ]);
    
        return redirect()->route('BN_customers_detail', ['id' => $customer->id])
                        ->with('success', 'VIP package registered successfully!');
    }
    
    
    
    
    




    public function BN_customers_register_vip(Request $request, $id)
    {
        $customer = Customer::find($id);
        $vips = VipPackageModel::get();
        return view('backend/customer-register-vip', [ 
            'default_pagename' => 'ลงทะเบียนวีไอพี',
            'customer' => $customer,
            'vips' => $vips,
        ]);
    }
    public function BN_customers(Request $request)
    {
        // $Customer = Customer::query()
        // ->orderBy('id', 'desc')
        // ->paginate(16);

        $query = Customer::query()
            ->orderBy('id', 'desc');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($query) use ($keyword) {
                $query->where('firstname', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('lastname', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('phone', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('customer.role', '=', $status);
        }

        $resultPerPage = 24;
        $query = $query->paginate($resultPerPage);

        // dd($query);
        return view('backend/customer', [ 
            'default_pagename' => 'ลูกค้า',
            'query' => $query,
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
                                        <a href="<?php echo route('BN_customers_detail', ['id' => $res->id]); ?>">ดูข้อมูล</a>
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
        $provinces = provincesModel::all();
        return view('backend/customer-add', [ 
            'default_pagename' => 'เพิ่มรายชื่อลูกค้า',
            'provinces' => $provinces,
        ]);
    }
    public function BN_customers_add_action(Request $request)
    {
        // dd($request);
        $Customer = new Customer;

        if($request->hasFile('image')){


            if(isset($Customer->image)){
                $oldPath = public_path($Customer->image);
                if(File::exists($oldPath)){
                    File::delete($oldPath);
                }
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

        if($request->hasFile('map')){

            if(isset($Customer->map)){
                $oldPath = public_path($Customer->map);
                if(File::exists($oldPath)){
                    File::delete($oldPath);
                }
            }

            $file = $request->file('map');
            $destinationPath = public_path('/uploads/map');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/map/'.$newfilenam;

            $Customer->map = $filepath;
        }

        $Customer->sp_role = 'home';
        $Customer->role = $request->role;
        $Customer->phone = $request->phone;
        $Customer->firstname = $request->firstname;
        $Customer->lastname = $request->lastname;
        $Customer->email = $request->email;
        $Customer->google_map = $request->google_map;
        $Customer->province = $request->province;
        $Customer->line = $request->line;
        $Customer->place = $request->place;

        // $file = $request->file('image');
        // $destinationPath = public_path('/uploads/profile/');
        // $filename = $file->getClientOriginalName();

        // $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        // $newfilenam = time() . '.time().' .$ext;
        // $file->move($destinationPath, $newfilenam);
        // $filepath = 'uploads/profile/'.$newfilenam;

        
        
        // $Customer->phone = $request->phone;
        // $Customer->firstname = $request->firstname;
        // $Customer->lastname = $request->lastname;
        // $Customer->email = $request->email;
        // $Customer->image = $filepath;


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

        return redirect(route('BN_customers'))->with('success', 'บันทึกข้อมูลสำเร็จ !!!');

    }
    public function BN_customers_edit(Request $request, $id)
    {
        $provinces = provincesModel::all();
        $Customer = Customer::find($id);
        return view('backend/customer-edit', [ 
            'default_pagename' => 'แก้ไขรายชื่อลูกค้า',
            'Customer' => $Customer,
            'provinces' => $provinces,
        ]);
    }
    public function BN_customers_edit_action(Request $request)
    {
        // dd($request);
        $Customer = Customer::find($request->id);
        if($request->hasFile('image')){


            if(isset($Customer->image)){
                $oldPath = public_path($Customer->image);
                if(File::exists($oldPath)){
                    File::delete($oldPath);
                }
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

        if($request->hasFile('map')){


            if(isset($Customer->map)){
                $oldPath = public_path($Customer->map);
                if(File::exists($oldPath)){
                    File::delete($oldPath);
                }
            }

            $file = $request->file('map');
            $destinationPath = public_path('/uploads/map');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/map/'.$newfilenam;

            $Customer->map = $filepath;
        }

        $Customer->sp_role = 'home';
        $Customer->role = $request->role;
        $Customer->bigbrand = $request->bigbrand;
        $Customer->phone = $request->phone;
        $Customer->firstname = $request->firstname;
        $Customer->lastname = $request->lastname;
        $Customer->email = $request->email;
        $Customer->google_map = $request->google_map;
        $Customer->province = $request->province;
        $Customer->line = $request->line;
        $Customer->place = $request->place;
        
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

        return redirect(route('BN_customers'))->with('success', 'บันทึกข้อมูลสำเร็จ !!!');

    }

}
