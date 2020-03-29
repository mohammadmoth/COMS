<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasfromsponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasfromsponsors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_child');
            $table->unsignedBigInteger('id_sponsor');
            $table->date('startsopnser');
            $table->date('endsponosor');
            
            $table->timestamps();

            $table->foreign('id_child')->references('id')->on('childrens');
            $table->foreign('id_sponsor')->references('id')->on('sponsors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasfromsponsors');
    }
}
