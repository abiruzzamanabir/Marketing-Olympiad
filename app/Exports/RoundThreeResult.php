<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoundThreeResult implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Admin::where('selectedThree', true)->where('blocked', false)->where('role_id', 3)->where('trash', false)->get()->map(function ($student) {
            return [
                'name' => $student->first_name . '' . $student->last_name,
                'email' => $student->email,
                'phone' => $student->cell,
                'University/Institute' => $student->uniname,
            ];
        });
    }

    public function headings(): array
    {
        return ["name", "email", "phone", "University/Institute"];
    }
}
