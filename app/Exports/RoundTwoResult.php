<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoundTwoResult implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Admin::orderBy("round_two_result", "DESC")->orderBy("durationTwo", "ASC")->where('round_two_status', true)->where('blocked', false)->where('role_id', 3)->where('trash', false)->get()->map(function ($student) {

            $minute = gmdate('i', $student->durationTwo);
            $secounds = gmdate('s', $student->durationTwo);
            $time = $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ');
            return [
                'name' => $student->first_name . ' ' . $student->last_name,
                'email' => $student->email,
                'phone' => $student->cell,
                'gender' => $student->gender,
                'University/Institute' => $student->uniname,
                'Marks' => $student->round_two_result,
                'Duration' => $time,
            ];
        });
    }

    public function headings(): array
    {
        return ["name", "email", "phone", "gender", "University/Institute", "Marks", "Duration"];
    }
}
