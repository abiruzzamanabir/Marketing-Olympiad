<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Role;
use App\Models\Admin;
use App\Models\CategoryTwo;
use App\Models\ExamControl;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\QuestionAnswer;
use App\Models\Theme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $mac = 'UNKNOWN';
        foreach (explode("\n", str_replace(' ', '', trim(`getmac`, "\n"))) as $i)
            if (strpos($i, 'Tcpip') > -1) {
                $mac = substr($i, 0, 17);
                break;
            }
        Admin::create([
            'first_name' => 'Provider',
            'last_name' => '',
            'email' => 'Provider@gmail.com',
            'cell' => '01700000000',
            'username' => 'provider',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
            'mac' => $mac,
        ]);
        Admin::create([
            'first_name' => 'demo',
            'last_name' => 'student',
            'email' => 'student@gmail.com',
            'cell' => '01711111111',
            'username' => 'demostudent123',
            'password' => Hash::make('123'),
            'role_id' => 3,
            'address' => 'xxx',
            'city' => 'xx',
            'state' => 'xx',
            'zip' => '000',
            'country' => 'bangladesh',
            'nid' => '1649815648',
            'stuid' => '8765654',
            'uniname' => 'XXXX',
            'dob' => '1990-01-01',
            'photo' => '5b82c0c8a86a61aaff8b84e6999fbf2fDemo_Student.jpg',
            'nidphotofront' => '1b9b4a17872425eb17dd814eda6eba88NID_FrontDemo_Student.jpg',
            'nidphotoback' => '6fcce46062454ca34e125a233a5879cfNID_BackDemo_Student.jpg',
            'stuphotofront' => '26d6175b75e3f11f22e80f93d1ed2b78SID_FrontDemo_Student.jpg',
            'stuphotoback' => 'ddcba78d617ca600757c2e628e15148eSID_BackDemo_Student.jpg',
            'mac' => $mac,
        ]);

        Permission::create([
            'name' => 'Admin user',
            'slug' => 'admin-user',
        ]);
        Permission::create([
            'name' => 'Role',
            'slug' => 'role',
        ]);
        Permission::create([
            'name' => 'Permission',
            'slug' => 'permission',
        ]);
        Permission::create([
            'name' => 'Theme option',
            'slug' => 'theme-option',
        ]);
        Permission::create([
            'name' => 'Verified Student',
            'slug' => 'verified-student',
        ]);
        Permission::create([
            'name' => 'Unverified Student',
            'slug' => 'unverified-student',
        ]);
        Permission::create([
            'name' => 'Add Question',
            'slug' => 'add-question',
        ]);
        Permission::create([
            'name' => 'Edit Question',
            'slug' => 'edit-question',
        ]);
        Permission::create([
            'name' => 'Update Question',
            'slug' => 'update-question',
        ]);
        Permission::create([
            'name' => 'Delete Question',
            'slug' => 'delete-question',
        ]);
        Permission::create([
            'name' => 'Round 1',
            'slug' => 'round-1',
        ]);
        Permission::create([
            'name' => 'Round 2',
            'slug' => 'round-2',
        ]);
        Permission::create([
            'name' => 'Exam Controll',
            'slug' => 'exam-controll',
        ]);
        Permission::create([
            'name' => 'Add Question From Excel',
            'slug' => 'add-question-from-excel',
        ]);
        Permission::create([
            'name' => 'Result',
            'slug' => 'result',
        ]);
        Permission::create([
            'name' => 'Result 2',
            'slug' => 'result-2',
        ]);
        Permission::create([
            'name' => 'Get Certificate',
            'slug' => 'get-certificate',
        ]);
        Permission::create([
            'name' => 'Download Certificate',
            'slug' => 'download-certificate',
        ]);
        Permission::create([
            'name' => 'Round One Result',
            'slug' => 'round-one-result',
        ]);
        Permission::create([
            'name' => 'Round Two Result',
            'slug' => 'round-two-result',
        ]);
        Permission::create([
            'name' => 'Add Question Round 2',
            'slug' => 'add-question-round-2',
        ]);
        Permission::create([
            'name' => 'Edit Question Round 2',
            'slug' => 'edit-question-round-2',
        ]);
        Permission::create([
            'name' => 'Update Question Round 2',
            'slug' => 'update-question-round-2',
        ]);
        Permission::create([
            'name' => 'Delete Question Round 2',
            'slug' => 'delete-question-round-2',
        ]);
        Permission::create([
            'name' => 'Add Question From Excel Two',
            'slug' => 'add-question-from-excel-two',
        ]);



        Role::create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'permission' => '["admin-user","role","permission","theme-option","verified-student","unverified-student","add-question","edit-question","update-question","delete-question","exam-controll","add-question-from-excel","round-one-result","round-two-result","add-question-round-2","edit-question-round-2","update-question-round-2","delete-question-round-2","add-question-from-excel-two"]',
        ]);
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permission' => '["theme-option"]',
        ]);
        Role::create([
            'name' => 'Student',
            'slug' => 'student',
            'permission' => '["round-1","result","get-certificate","download-certificate","round-2","result-2"]',
        ]);
        Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
            'permission' => '["theme-option"]',
        ]);
        Theme::create([
            'logo' => 'logo.png',
            'favicon' => 'favicon.ico',
            'social' => '{"facebook":"","twitter":"","linkedin":"","instagram":"","youtube":""}',
            'title' => 'Demo title',
            'tagline' => 'Demo Tagline',
            'copyright' => '2023 Copyright',
        ]);
        ExamControl::create([
            'round1resultstatus' => 'true',
            'round2resultstatus' => 'false',
        ]);
        // QuestionAnswer::create([
        //     'category_id'=>1,
        //     'question' =>'_______ is the smallest unit of data in a computer ?',
        //     'option' =>'["Gigabyte","Bit","Byte","Terabyte"]',
        //     'answer' =>'Bit',
        // ]);
        // QuestionAnswer::create([
        //     'category_id'=>1,
        //     'question' =>'Which of the following is NOT an anti-virus software ?',
        //     'option' =>'["Avast","Linux","Norton","Kaspersky"]',
        //     'answer' =>'Linux',
        // ]);
        // QuestionAnswer::create([
        //     'category_id'=>1,
        //     'question' =>'In the context of digital computer, which of the following pairs of digits is referred to as binary code ?',
        //     'option' =>'["3 and 4","0 and 1","2 and 3","1 and 2"]',
        //     'answer' =>'0 and 1',
        // ]);
        // QuestionAnswer::create([
        //     'category_id'=>2,
        //     'question' =>'Which unit of the computer is considered as the brain of the computer ?',
        //     'option' =>'["Memory unit","Input unit","CPU","Output unit"]',
        //     'answer' =>'CPU',
        // ]);
        // QuestionAnswer::create([
        //     'category_id'=>1,
        //     'question' =>'What is the full form of PROM ?',
        //     'option' =>'["Program read-only memory","Primary read-only memory","Programmable read-only memory","Program read-output memory"]',
        //     'answer' =>'Programmable read-only memory',
        // ]);
        // QuestionAnswer::create([
        //     'category_id'=>2,
        //     'question' =>'In the context of computing, what is the full form of URL ?',
        //     'option' =>'["Undistributed Resource Locator","Unified Resource Locator","Uniform Resource Locator","Uniform Region Locator"]',
        //     'answer' =>'Unified Resource Locator',
        // ]);
        // QuestionAnswer::create([
        //     'category_id'=>2,
        //     'question' =>'Which of the following is an input device used to enter motion data in computers or other electronic devices ?',
        //     'option' =>'["Monitor","Trackball","Plotter","Joystick"]',
        //     'answer' =>'Trackball',
        // ]);
        // QuestionAnswer::create([
        //     'category_id'=>1,
        //     'question' =>'In the context of computing, a byte is equal to _____ bits ?',
        //     'option' =>'["4","16","24","8"]',
        //     'answer' =>'8',
        // ]);
        // QuestionAnswer::create([
        //     'category_id'=>1,
        //     'question' =>'_____ is a small, portable flash memory card that plugs into a computer’s USB port and functions as a portable hard drive ?',
        //     'option' =>'["Flash drive","CD-RW","DVD-ROM","CD-ROM"]',
        //     'answer' =>'Flash drive',
        // ]);
        // QuestionAnswer::create([
        //     'category_id'=>2,
        //     'question' =>'Which of the following devices is NOT used to enter data into a computer ?',
        //     'option' =>'["Mouse","Keyboard","Scanner","Monitor"]',
        //     'answer' =>'Monitor',
        // ]);
        Category::create([
            'category_name'=> 'Multiple Choice Question',
            'question_size'=> 20,
            'status'=> 1,
            'is_archive'=> 0,
        ]);
        Category::create([
            'category_name'=> 'Logo Recognition',
            'question_size'=> 10,
            'status'=> 1,
            'is_archive'=> 0,
        ]);
        Category::create([
            'category_name'=> 'Brand By Shape',
            'question_size'=> 10,
            'status'=> 1,
            'is_archive'=> 0,
        ]);
        CategoryTwo::create([
            'category_name'=> 'Multiple Choice Question',
            'question_size'=> 20,
            'status'=> 1,
            'is_archive'=> 0,
        ]);
        CategoryTwo::create([
            'category_name'=> 'Logo Recognition',
            'question_size'=> 10,
            'status'=> 1,
            'is_archive'=> 0,
        ]);
        CategoryTwo::create([
            'category_name'=> 'Brand By Shape',
            'question_size'=> 10,
            'status'=> 1,
            'is_archive'=> 0,
        ]);
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
