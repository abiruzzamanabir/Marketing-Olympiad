<?php

namespace App\Imports;

use App\Models\QuestionAnswerTwo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionAnswerImportTwo implements ToModel,WithHeadingRow
{
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $options = [
            $row['option1'],
            $row['option2'],
            $row['option3'],
            $row['option4'],
        ];
        return new QuestionAnswerTwo([
            'category_id'     => (int)$row['category_id'],
            'question'    => $row['question'],
            'image_question' => $row['image_question'],
            'option' => json_encode($options),
            'answer' =>$row['answer'],
            'status' =>1
        ]);
    }
}
