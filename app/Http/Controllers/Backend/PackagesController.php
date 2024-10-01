<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

use App\Models\PackageDealerModel;
use App\Models\VipPackageModel;

class PackagesController extends Controller
{
    


    public function BN_packages(Request $request)
    {
        // Retrieve data from package_dealers table (Dealer packages)
        $packageDealers = PackageDealerModel::all();

        // Retrieve data from package_vips table (VIP packages)
        $vipPackages = VipPackageModel::all();

        return view('backend.packages', [
            'default_pagename' => 'แพ็คเกจ',
            'packageDealers' => $packageDealers,
            'vipPackages' => $vipPackages,
        ]);
    }

    public function BN_packages_edit(Request $request, $type, $id)
    {
        // Fetch the correct package based on type and ID
        if ($type === 'dealer') {
            $package = PackageDealerModel::findOrFail($id);
        } elseif ($type === 'vip') {
            $package = VipPackageModel::findOrFail($id);
        } else {
            abort(404);
        }

        return view('backend.packages-edit', [
            'default_pagename' => 'แก้ไขแพ็คเกจ',
            'package' => $package,
            'packageType' => ucfirst($type), // ucfirst() to capitalize type
        ]);
    }

    public function BN_packages_edit_action(Request $request)
    {
        $type = strtolower($request->input('type'));
    
        if ($type === 'dealer') {
            // Validate the request data for updating a dealer package
            $request->validate([
                'id' => 'required|exists:package_dealers,id',
                'name' => 'required|string',
                'price' => 'required|numeric',
                'limit' => 'required|numeric',
                'old_price' => 'nullable|numeric',
                'label_save' => 'nullable|numeric',
                'label_bottom' => 'nullable|string',
                'text1' => 'nullable|string',
                'text2' => 'nullable|string',
                'text3' => 'nullable|string',
                'text4' => 'nullable|string',
                'text5' => 'nullable|string',
                'text6' => 'nullable|string',
                'text7' => 'nullable|string',
                'text8' => 'nullable|string',
                'text9' => 'nullable|string',
                'text10' => 'nullable|string',
                'text11' => 'nullable|string',
                'text12' => 'nullable|string',
            ]);
    
            // Find the package and update its attributes
            $package = PackageDealerModel::findOrFail($request->input('id'));
            $package->name = $request->input('name');
            $package->price = $request->input('price');
            $package->limit = $request->input('limit');
            $package->old_price = $request->input('old_price');
            $package->label_save = $request->input('label_save');
            $package->label_bottom = $request->input('label_bottom');
            $package->text1 = $request->input('text1');
            $package->text2 = $request->input('text2');
            $package->text3 = $request->input('text3');
            $package->text4 = $request->input('text4');
            $package->text5 = $request->input('text5');
            $package->text6 = $request->input('text6');
            $package->text7 = $request->input('text7');
            $package->text8 = $request->input('text8');
            $package->text9 = $request->input('text9');
            $package->text10 = $request->input('text10');
            $package->text11 = $request->input('text11');
            $package->text12 = $request->input('text12');
    
            // Save the updated package
            $package->save();
    
        } elseif ($type === 'vip') {
            // Validate the request data for updating a VIP package
            $request->validate([
                'id' => 'required|exists:package_vips,id',
                'name' => 'required|string',
                'price' => 'required|numeric',
                'limit' => 'required|numeric',
                'old_price' => 'nullable|numeric',
                'label_save' => 'nullable|numeric',
                'label_bottom' => 'nullable|string',
                'text1' => 'nullable|string',
                'text2' => 'nullable|string',
                'text3' => 'nullable|string',
                'text4' => 'nullable|string',
                'text5' => 'nullable|string',
                'text6' => 'nullable|string',
                'text7' => 'nullable|string',
                'text8' => 'nullable|string',
                'text9' => 'nullable|string',
                'text10' => 'nullable|string',
                'text11' => 'nullable|string',
                'text12' => 'nullable|string',
            ]);
    
            // Find the package and update its attributes
            $package = VipPackageModel::findOrFail($request->input('id'));
            $package->name = $request->input('name');
            $package->price = $request->input('price');
            $package->limit = $request->input('limit');
            $package->old_price = $request->input('old_price');
            $package->label_save = $request->input('label_save');
            $package->label_bottom = $request->input('label_bottom');
            $package->text1 = $request->input('text1');
            $package->text2 = $request->input('text2');
            $package->text3 = $request->input('text3');
            $package->text4 = $request->input('text4');
            $package->text5 = $request->input('text5');
            $package->text6 = $request->input('text6');
            $package->text7 = $request->input('text7');
            $package->text8 = $request->input('text8');
            $package->text9 = $request->input('text9');
            $package->text10 = $request->input('text10');
            $package->text11 = $request->input('text11');
            $package->text12 = $request->input('text12');
    
            // Save the updated package
            $package->save();
    
        } else {
            abort(404); // Handle invalid package type
        }
    
        // Redirect back to the package list page or any other appropriate page
        return redirect()->route('BN_packages')->with('success', 'แก้ไขแพ็คเกจสำเร็จ');
    }
    

    public function BN_packages_detail_dealer($id)
    {
        $package = PackageDealerModel::findOrFail($id); // Adjust this based on your model and primary key
        $packageType = 'dealer'; // Set the package type explicitly

        return view('backend.packages-detail', [
            'default_pagename' => 'Package Detail',
            'package' => $package,
            'packageType' => $packageType,
        ]);
    }

    public function BN_packages_detail_vip($id)
    {
        $package = VipPackageModel::findOrFail($id); // Adjust this based on your model and primary key
        $packageType = 'vip'; // Set the package type explicitly

        return view('backend.packages-detail', [
            'default_pagename' => 'Package Detail',
            'package' => $package,
            'packageType' => $packageType,
        ]);
    }
}
