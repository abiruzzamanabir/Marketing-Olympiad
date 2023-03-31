<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\Admin;
use App\Models\ExamControl;
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
            'photo' => '5b82c0c8a86a61aaff8b84e6999fbf2fAbiruzzaman_Abir.jpg',
            'nidphotofront' => '1b9b4a17872425eb17dd814eda6eba88NID_FrontAbiruzzaman_Abir.jpg',
            'nidphotoback' => '6fcce46062454ca34e125a233a5879cfNID_BackAbiruzzaman_Abir.jpg',
            'stuphotofront' => '26d6175b75e3f11f22e80f93d1ed2b78SID_FrontAbiruzzaman_Abir.jpg',
            'stuphotoback' => 'ddcba78d617ca600757c2e628e15148eSID_BackAbiruzzaman_Abir.jpg',
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
            'name' => 'Round 1',
            'slug' => 'round-1',
        ]);
        Permission::create([
            'name' => 'Exam Controll',
            'slug' => 'exam-controll',
        ]);



        Role::create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'permission' => '["admin-user","role","permission","theme-option","verified-student","unverified-student","add-question","edit-question","update-question","exam-controll"]',
        ]);
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permission' => '["theme-option"]',
        ]);
        Role::create([
            'name' => 'Student',
            'slug' => 'student',
            'permission' => '["round-1","result"]',
        ]);
        Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
            'permission' => '["theme-option"]',
        ]);
        Theme::create([
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
            'social' => '{"facebook":"","twitter":"","linkedin":"","instagram":"","dribbble":""}',
            'title' => 'Demo title',
            'tagline' => 'Demo Tagline',
            'copyright' => '2023 Copyright',
        ]);
        ExamControl::create([
            'round1resultstatus' => 'false',
            'round2resultstatus' => 'false',
        ]);
        QuestionAnswer::create([
            'question' =>'_______ is the smallest unit of data in a computer ?',
            'option' =>'["Gigabyte","Bit","Byte","Terabyte"]',
            'answer' =>'Bit',
        ]);
        QuestionAnswer::create([
            'question' =>'Which of the following is NOT an anti-virus software ?',
            'option' =>'["Avast","Linux","Norton","Kaspersky"]',
            'answer' =>'Linux',
        ]);
        QuestionAnswer::create([
            'question' =>'In the context of digital computer, which of the following pairs of digits is referred to as binary code ?',
            'option' =>'["3 and 4","0 and 1","2 and 3","1 and 2"]',
            'answer' =>'0 and 1',
        ]);
        QuestionAnswer::create([
            'question' =>'Which unit of the computer is considered as the brain of the computer ?',
            'option' =>'["Memory unit","Input unit","CPU","Output unit"]',
            'answer' =>'CPU',
        ]);
        QuestionAnswer::create([
            'question' =>'What is the full form of PROM ?',
            'option' =>'["Program read-only memory","Primary read-only memory","Programmable read-only memory","Program read-output memory"]',
            'answer' =>'Programmable read-only memory',
        ]);
        QuestionAnswer::create([
            'question' =>'In the context of computing, what is the full form of URL ?',
            'option' =>'["Undistributed Resource Locator","Unified Resource Locator","Uniform Resource Locator","Uniform Region Locator"]',
            'answer' =>'Unified Resource Locator',
        ]);
        QuestionAnswer::create([
            'question' =>'Which of the following is an input device used to enter motion data in computers or other electronic devices ?',
            'option' =>'["Monitor","Trackball","Plotter","Joystick"]',
            'answer' =>'Trackball',
        ]);
        QuestionAnswer::create([
            'question' =>'In the context of computing, a byte is equal to _____ bits ?',
            'option' =>'["4","16","24","8"]',
            'answer' =>'8',
        ]);
        QuestionAnswer::create([
            'question' =>'_____ is a small, portable flash memory card that plugs into a computer’s USB port and functions as a portable hard drive ?',
            'option' =>'["Flash drive","CD-RW","DVD-ROM","CD-ROM"]',
            'answer' =>'Flash drive',
        ]);
        QuestionAnswer::create([
            'question' =>'Which of the following devices is NOT used to enter data into a computer ?',
            'option' =>'["Mouse","Keyboard","Scanner","Monitor"]',
            'answer' =>'Monitor',
        ]);
    }
}
