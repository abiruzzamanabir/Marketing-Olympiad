<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoundOneResult implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Admin::orderBy("round_one_result", "DESC")->orderBy("duration", "ASC")->where('round_one_status', true)->where('blocked', false)->where('role_id', 3)->where('trash', false)->get()->map(function($student) {

            $minute = gmdate('i', $student->duration);
            $secounds = gmdate('s', $student->duration);
             $time= $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ');
            return [
               'name' => $student->first_name.''.$student->last_name,
               'email' => $student->email,
               'phone' => $student->cell,
               'University/Institute' => $student->uniname,
               'Marks' => $student->round_one_result,
               'Duration' => $time,
            ];
         });
    }

   public function headings(): array
   {
       return ["name", "email", "phone","University/Institute","Marks","Duration"];
   }
}
