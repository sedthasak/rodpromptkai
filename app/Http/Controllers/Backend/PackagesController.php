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
                // Add validation rules for other fields as needed
            ]);

            // Find the package and update its attributes
            $package = PackageDealerModel::findOrFail($request->input('id'));
            $package->name = $request->input('name');
            $package->price = $request->input('price');
            $package->limit = $request->input('limit');
            // Update other attributes as needed

            // Save the updated package
            $package->save();

        } elseif ($type === 'vip') {
            // Validate the request data for updating a VIP package
            $request->validate([
                'id' => 'required|exists:package_vips,id',
                'name' => 'required|string',
                'price' => 'required|numeric',
                'limit' => 'required|numeric',
                // Add validation rules for other fields as needed
            ]);

            // Find the package and update its attributes
            $package = VipPackageModel::findOrFail($request->input('id'));
            $package->name = $request->input('name');
            $package->price = $request->input('price');
            $package->limit = $request->input('limit');
            // Update other attributes as needed

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
