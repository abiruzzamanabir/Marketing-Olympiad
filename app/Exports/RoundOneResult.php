<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;

class RoundOneResult implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Admin::orderBy("round_one_result", "DESC")->orderBy("duration", "ASC")->where('round_one_status', true)->where('blocked', false)->where('role_id', 3)->where('trash', false)->get();
    }

//    public function headings(): array
//    {
//        return ["your", "headings", "here"];
//    }
}
