<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('husband',50);
            $table->string('wife',50);
            $table->integer('national_id')->unsigned();
            $table->integer('family_card_id')->unsigned();
            $table->unsignedBigInteger('mobile');
            $table->string('economic_status',100);
            $table->string('previous_resident_address',100)->default("لا يوجد سكن سابق");
            $table->string('current_resident_address',100);
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
        Schema::dropIfExists('families');
    }
}
