<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\TopTen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AllParticipant;
use App\Models\Winner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ResultController extends Controller
{
    public function allParticipantsGenerate(Request $request)
    {
        try {
            // You can use dynamic year if needed
            $year = Carbon::now()->year;
            // $year = '2023';

            // Check if data for this year already exists
            $existingCount = AllParticipant::where('year', $year)->count();

            if ($existingCount === 0) {
                // Fetch all eligible participants
                $admins = Admin::where('blocked', false)
                    ->where('role_id', 3)
                    ->where('trash', false)
                    ->get();

                $resultInsert = [];

                foreach ($admins as $student) {
                    $resultInsert[] = [
                        'name' => $student->first_name . ' ' . $student->last_name,
                        'university' => $student->uniname,
                        'year' => $year,
                    ];
                }

                if (!empty($resultInsert)) {
                    AllParticipant::insert($resultInsert);
                    return back()->with('success', 'All participants generated successfully.');
                } else {
                    return back()->with('warning', 'No eligible participants found.');
                }
            } else {
                return back()->with('danger', 'Data for this year already exists.');
            }
        } catch (\Exception $e) {
            Log::error('All Participants Generation Error: ' . $e->getMessage());
            return back()->with('danger', 'An error occurred while generating participants.');
        }
    }

    public function topTenGenerate(Request $request)
    {
        try {
            $year = Carbon::now()->year;
            // $year = '2023';

            $existingCount = TopTen::where('year', $year)->count();

            if ($existingCount === 0) {
                $admins = Admin::where('selectedThree', true)
                    ->where('blocked', false)
                    ->where('role_id', 3)
                    ->where('trash', false)
                    ->get();

                $resultInsert = [];

                foreach ($admins as $student) {
                    $resultInsert[] = [
                        'name' => $student->first_name . ' ' . $student->last_name,
                        'university' => $student->uniname,
                        'year' => $year,
                    ];
                }

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
            Log::error('Top Ten Generation Error: ' . $e->getTraceAsString());
            return back()->with('danger', $e->getMessage());
        }
    }

    public function winnerGenerate(Request $request)
    {
        try {
            $year = Carbon::now()->year;
            // $year = '2023';

            $existingCount = Winner::where('year', $year)->count();

            if ($existingCount === 0) {
                $admins = Admin::where('winner', true)
                    ->where('blocked', false)
                    ->where('role_id', 3)
                    ->where('trash', false)
                    ->get();

                $resultInsert = [];

                foreach ($admins as $student) {
                    $resultInsert[] = [
                        'name' => $student->first_name . ' ' . $student->last_name,
                        'university' => $student->uniname,
                        'year' => $year,
                    ];
                }

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
            Log::error('Winner Generation Error: ' . $e->getTraceAsString());
            return back()->with('danger', $e->getMessage());
        }
    }
}
