<?php

namespace App\Imports;

use App\Models\CategoryTwo;
use App\Models\QuestionAnswerTwo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionAnswerImportTwo implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $categoryId = $this->resolveCategoryId($row);

        $options = array_filter([
            $this->cleanExcelValue($row['option_1'] ?? $row['option1'] ?? null),
            $this->cleanExcelValue($row['option_2'] ?? $row['option2'] ?? null),
            $this->cleanExcelValue($row['option_3'] ?? $row['option3'] ?? null),
            $this->cleanExcelValue($row['option_4'] ?? $row['option4'] ?? null),
        ], function ($value) {
            return $value !== null && $value !== '';
        });

        return new QuestionAnswerTwo([
            'category_id'    => $categoryId,
            'question'       => $this->cleanExcelValue($row['question'] ?? ''),
            'image_question' => $this->cleanExcelValue($row['image_question'] ?? null),
            'option'         => json_encode(array_values($options), JSON_UNESCAPED_UNICODE),
            'answer'         => $this->cleanExcelValue($row['answer'] ?? ''),
            'status'         => $this->statusValue($row['status'] ?? 1),
            'is_archive'     => $this->archiveValue($row['archive_status'] ?? 0),
        ]);
    }

    private function resolveCategoryId(array $row)
    {
        $categoryId = $this->cleanExcelValue($row['category_id'] ?? null);
        $category = $this->cleanExcelValue($row['category'] ?? null);

        if ($categoryId !== null && $categoryId !== '') {
            return (int) $categoryId;
        }

        if ($category !== null && $category !== '' && !is_numeric($category)) {
            return (int) optional(CategoryTwo::where('category_name', $category)->first())->id;
        }

        return (int) ($category ?? 0);
    }

    private function cleanExcelValue($value)
    {
        if ($value === null) {
            return null;
        }

        $value = (string) $value;
        $value = str_replace("\xC2\xA0", ' ', $value);
        $value = preg_replace('/\s+/u', ' ', $value);

        return trim($value);
    }

    private function statusValue($status)
    {
        return strtolower((string) $status) === 'inactive' ? 0 : (int) ((string) $status !== '0');
    }

    private function archiveValue($archive)
    {
        return in_array(strtolower((string) $archive), ['1', 'yes', 'active', 'archived'], true) ? 1 : 0;
    }
}
