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
