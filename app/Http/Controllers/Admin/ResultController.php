<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\TopTen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Winner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ResultController extends Controller
{
    public function topTenGenerate(Request $request)
    {
        try {
            // Check if any records already exist that meet the criteria
            $existingCount = TopTen::where('year', Carbon::now()->year)->count();

            // If no records exist, proceed with insertion
            if ($existingCount === 0) {
                $admin = Admin::where('selectedThree', true)
                    ->where('blocked', false)
                    ->where('role_id', 3)
                    ->where('trash', false)
                    ->get();

                $resultInsert = [];
                foreach ($admin as $student) {
                    $resultInsert[] = [
                        'name' => $student->first_name . ' ' . $student->last_name,
                        'university' => $student->uniname,
                        'year' => '2023',
                    ];
                }

                // Bulk insert if there are records to insert
                if (!empty($resultInsert)) {
                    TopTen::insert($resultInsert);
                    return back()->with('success', 'Top 10 Generated Successfully');
                } else {
                    return back()->with('warning', 'No new data to insert');
                }
            } else {
                return back()->with('danger', 'Data already exists for this year');
            }
        } catch (\Exception $e) {
            Log::error('Something is Wrong' . $e->getTraceAsString());
            return back()->with('danger', $e->getMessage());
        }

    }
    public function winnerGenerate(Request $request)
    {
        try {
            // Check if any records already exist that meet the criteria
            $existingCount = Winner::where('year', Carbon::now()->year)->count();

            // If no records exist, proceed with insertion
            if ($existingCount === 0) {
                $admin = Admin::where('winner', true)
                    ->where('blocked', false)
                    ->where('role_id', 3)
                    ->where('trash', false)
                    ->get();

                $resultInsert = [];
                foreach ($admin as $student) {
                    $resultInsert[] = [
                        'name' => $student->first_name . ' ' . $student->last_name,
                        'university' => $student->uniname,
                        'year' => '2023',
                    ];
                }

                // Bulk insert if there are records to insert
                if (!empty($resultInsert)) {
                    Winner::insert($resultInsert);
                    return back()->with('success', 'Winners Generated Successfully');
                } else {
                    return back()->with('warning', 'No new data to insert');
                }
            } else {
                return back()->with('danger', 'Data already exists for this year');
            }
        } catch (\Exception $e) {
            Log::error('Something is Wrong' . $e->getTraceAsString());
            return back()->with('danger', $e->getMessage());
        }

    }

}
