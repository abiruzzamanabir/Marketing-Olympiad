<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exam_controls', function (Blueprint $table) {
            $table->id();

            $table->string('round1resultstatus')->default('true');
            $table->string('round2resultstatus')->default('false');

            $table->integer('minutes')->default(20);
            $table->integer('seconds')->default(1);
            $table->integer('question_qty')->default(40);

            $table->dateTime('start_date_time')->nullable()->default('2026-07-11 00:00:00');
            $table->dateTime('end_date_time')->nullable()->default('2026-07-13 23:59:00');

            $table->dateTime('result_published_time')->nullable()->default('2026-07-14 23:59:00');

            $table->dateTime('next_round_date')->nullable()->default('2026-07-18 00:00:00');
            $table->dateTime('next_round_end_date')->nullable()->default('2026-07-20 23:59:00');

            $table->dateTime('result_published_time_round_two')->nullable()->default('2026-07-21 00:00:00');

            $table->dateTime('bootcamp_date')->nullable()->default('2026-07-25 09:00:00');
            $table->dateTime('bootcamp_end_date')->nullable()->default('2026-07-25 17:00:00');

            $table->dateTime('third_round_date')->nullable()->default('2026-08-01 00:00:00');
            $table->dateTime('third_round_end_date')->nullable()->default('2026-08-01 23:59:00');

            $table->dateTime('result_published_time_round_third')->nullable()->default('2026-08-02 23:59:00');

            $table->dateTime('grand_finale')->nullable()->default('2026-08-08 10:00:00');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_controls');
    }
};
