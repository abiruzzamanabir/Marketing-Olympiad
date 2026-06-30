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
        if (!Schema::hasColumn('admins', 'gender')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->string('gender')->nullable()->after('cell');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('admins', 'gender')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('gender');
            });
        }
    }
};
