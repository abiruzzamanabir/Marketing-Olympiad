<?php

namespace App\Exports;

use App\Models\QuestionAnswer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RoundOneQuestionsExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return QuestionAnswer::query()
            ->select(
                'category_id',
                'question',
                'image_question',
                'option',
                'answer'
            )
            ->orderBy('id');
    }

    public function map($question): array
    {
        $options = json_decode($question->option, true);

        if (!is_array($options)) {
            $options = [];
        }

        return [
            $question->category_id,
            $question->question,
            $question->image_question,
            $options[0] ?? '',
            $options[1] ?? '',
            $options[2] ?? '',
            $options[3] ?? '',
            $question->answer,
        ];
    }

    public function headings(): array
    {
        return [
            'category_id',
            'question',
            'image_question',
            'option1',
            'option2',
            'option3',
            'option4',
            'answer',
        ];
    }
}
