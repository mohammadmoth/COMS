<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypesponsorToSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->enum('typesponsor' , ["money","medical","educational"])->after("phone");
            $table->bigInteger('tags_id' )->nullable()->after("typesponsor");
            $table->date('birthday' )->after("tags_id");
            $table->string('idnumber' )->after("birthday");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            //
        });
    }
}
