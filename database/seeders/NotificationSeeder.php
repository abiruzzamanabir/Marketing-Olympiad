<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Notification::create([
            'caption'=> 'RoundOneExamAlert',
            'title'=> 'Exam Alert',
            'details'=> 'Your Round One  Exam Is start at {$start_date} and end at {$end_date}',
            'status'=> 1,
            'is_archive'=> 0,
        ]);
        Notification::create([
            'caption'=> 'RoundOneResultAlert',
            'title'=> 'Result Alert',
            'details'=> 'Your Round One  Exam Result is {$result}',
            'status'=> 1,
            'is_archive'=> 0,
        ]);
    }
}
