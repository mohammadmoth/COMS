<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('children_id');
            $table->unsignedBigInteger('doctor_id');


            $table->foreign('children_id')->references('id')->on('childrens'); // foreign
            $table->foreign('doctor_id')->references('id')->on('doctors');// foreign


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
        Schema::dropIfExists('clinical_exams');
    }
}
