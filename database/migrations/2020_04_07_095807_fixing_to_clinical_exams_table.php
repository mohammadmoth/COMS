<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixingToClinicalExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinical_exams', function (Blueprint $table) {

            $table->dropForeign('clinical_exams_doctor_id_foreign');
            $table->foreign('doctor_id')->references('id')->on('tags');// foreign
            $table->string("case");
            $table->date("date");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinical_exams', function (Blueprint $table) {
            //
        });
    }
}
