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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('role_id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('cell')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('nid')->nullable();
            $table->string('stuid')->nullable();
            $table->text('uniname')->nullable();
            $table->date('dob')->nullable();
            $table->string('photo')->default('avatar.png');
            $table->string('nidphotofront')->nullable();
            $table->string('nidphotoback')->nullable();
            $table->string('stuphotofront')->nullable();
            $table->string('stuphotoback')->nullable();
            $table->string('mac')->nullable();
            $table->text('certificate')->nullable();
            $table->string('access_token')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('round_one_result')->default(0);
            $table->boolean('round_one_status')->default(false);
            $table->boolean('trash')->default(false);
            $table->boolean('blocked')->default(false);
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->string('duration')->nullable();
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
        Schema::dropIfExists('admins');
    }
};
