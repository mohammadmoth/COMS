<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('families', function (Blueprint $table) {
            $table->dropColumn(['economic_status', 'previous_resident_address', 'current_resident_address']);
        });

        Schema::table('families', function (Blueprint $table) {
            $table->string('husband')->change();
            $table->string('wife')->change();
            $table->string('mobile')->change();
            $table->enum('economic_status',["bad","middle",'good']);
            $table->string('previous_resident_address')->nullable();
            $table->string('current_resident_address');

            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('families', function (Blueprint $table) {
            //
        });
    }
}
