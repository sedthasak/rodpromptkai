<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

use App\Models\CouponModel;
use App\Models\LevelModel;

class LevelMemberController extends Controller
{

    public function BN_levels(Request $request)
    {
        $query = LevelModel::query()
            ->orderBy('id', 'asc');
        $resultPerPage = 24;
        $query = $query->paginate($resultPerPage);
        return view('backend/levels', [ 
            'default_pagename' => 'ระดับยูสเซอร์',
            'query' => $query,
        ]);
    }
    public function BN_levels_detail(Request $request, $id)
    {
        try {
            // Find the level by ID
            $level = LevelModel::findOrFail($id);

            // Render the detail view with the level data
            return view('backend.levels-detail', [
                'default_pagename' => 'รายละเอียดระดับยูสเซอร์',
                'level' => $level,
            ]);
        } catch (\Exception $e) {
            // Handle errors if the level is not found
            Log::error('Error fetching level details: ' . $e->getMessage());
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการดึงข้อมูลระดับยูสเซอร์');
        }
    }


    public function BN_levels_edit(Request $request, $id)
    {
        try {
            // Find the level by ID
            $level = LevelModel::findOrFail($id);

            // Render the edit view with the level data
            return view('backend.levels-edit', [
                'default_pagename' => 'แก้ไขระดับยูสเซอร์',
                'level' => $level,
            ]);
        } catch (\Exception $e) {
            // Handle errors if the level is not found
            Log::error('Error editing level: ' . $e->getMessage());
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการแก้ไขระดับยูสเซอร์');
        }
    }
    public function BN_levels_edit_action(Request $request)
    {
        // Validate input data
        $request->validate([
            'id' => 'required|exists:levels,id',
            'name' => 'required|string|max:255',
            'accumulate' => [
                'required',
                'integer',
                'min:' . $this->getMinAccumulate($request->id), // Validate against lower level accumulate
                'max:' . $this->getMaxAccumulate($request->id), // Validate against upper level accumulate
            ],
            // Add validation for the new text fields
            'text1' => 'nullable|string|max:255',
            'text2' => 'nullable|string|max:255',
            'text3' => 'nullable|string|max:255',
            'text4' => 'nullable|string|max:255',
            'text5' => 'nullable|string|max:255',
            'text6' => 'nullable|string|max:255',
            'text7' => 'nullable|string|max:255',
            'text8' => 'nullable|string|max:255',
            'text9' => 'nullable|string|max:255',
            'text10' => 'nullable|string|max:255',
            'text11' => 'nullable|string|max:255',
            'text12' => 'nullable|string|max:255',
        ]);
    
        try {
            // Find the level by ID
            $level = LevelModel::findOrFail($request->id);
    
            // Update the level with the validated data
            $level->name = $request->name;
            $level->accumulate = $request->accumulate;
    
            // Update text fields dynamically
            for ($i = 1; $i <= 12; $i++) {
                $field = 'text' . $i;
                $level->$field = $request->$field;
            }
    
            // Save the updated level
            $level->save();
    
            return redirect()->route('BN_levels')->with('success', 'แก้ไขระดับยูสเซอร์สำเร็จ !!!');
        } catch (\Exception $e) {
            Log::error('Error updating level: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'การแก้ไขระดับยูสเซอร์ล้มเหลว !!!');
        }
    }
    

    /**
     * Get the minimum accumulate value based on the level ID.
     *
     * @param int $id
     * @return int
     */
    private function getMinAccumulate($id)
    {
        switch ($id) {
            case 1:
                return 0; // No lower level, so minimum is 0
            case 2:
                return LevelModel::where('id', 1)->value('accumulate');
            case 3:
                return LevelModel::where('id', 2)->value('accumulate');
            case 4:
                return LevelModel::where('id', 3)->value('accumulate');
            default:
                return 0; // Default to 0 if unexpected ID is provided
        }
    }

    /**
     * Get the maximum accumulate value based on the level ID.
     *
     * @param int $id
     * @return int
     */
    private function getMaxAccumulate($id)
    {
        switch ($id) {
            case 1:
                return LevelModel::where('id', 2)->value('accumulate') - 1;
            case 2:
                return LevelModel::where('id', 3)->value('accumulate') - 1;
            case 3:
                return LevelModel::where('id', 4)->value('accumulate') - 1;
            case 4:
                return 999999; // Adjust this based on your maximum expected value
            default:
                return 999999; // Default to a high number if unexpected ID is provided
        }
    }
    // public function BN_levels_edit_action(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'id' => 'required|exists:levels,id',
    //             'name' => 'required|string|max:255',
    //             'accumulate' => 'required|numeric',
    //         ]);

    //         $level = LevelModel::findOrFail($validated['id']);

    //         $level->name = $validated['name'];
    //         $level->accumulate = $validated['accumulate'];
    //         $level->save();

    //         return redirect()->route('BN_levels')->with('success', 'แก้ไขระดับยูสเซอร์สำเร็จ');
    //     } catch (\Exception $e) {
    //         Log::error('Error editing level: ' . $e->getMessage());
    //         return redirect()->back()->withInput()->with('error', 'เกิดข้อผิดพลาดในการแก้ไขระดับยูสเซอร์');
    //     }
    // }


    
}
