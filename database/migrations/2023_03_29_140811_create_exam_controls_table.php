<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_controls', function (Blueprint $table) {
            $table->id();
            $table->string('round1resultstatus')->default('true');
            $table->string('round2resultstatus')->default('false');
            $table->integer('minutes')->default(20);
            $table->integer('seconds')->default(1);
            $table->integer('question_qty')->default(40);
            $table->dateTime('start_date_time')->nullable()->default('2023-05-01 00:00:00');
            $table->dateTime('end_date_time')->nullable()->default('2023-05-03 23:59:00');
            $table->dateTime('result_published_time')->nullable()->default('2023-05-05 23:59:00');
            $table->dateTime('next_round_date')->nullable()->default('2023-05-10 00:00:00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_controls');
    }
};
