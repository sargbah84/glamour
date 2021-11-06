<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RanderTableUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('duration', 50)->after('description')->default(10);
        });

        Schema::table('user_lessons', function (Blueprint $table) {
            $table->dropColumn('duration');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
