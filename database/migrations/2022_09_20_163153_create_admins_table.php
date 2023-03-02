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
            $table->string('fast_name');
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
            $table->text('bio')->nullable();
            $table->date('dob')->nullable();
            $table->string('photo')->default('avatar.png');
            $table->string('nidphoto')->nullable();
            $table->string('stuphoto')->nullable();
            $table->string('access_token')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('trash')->default(false);
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
