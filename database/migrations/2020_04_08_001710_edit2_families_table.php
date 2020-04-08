<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Edit2FamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('families', function (Blueprint $table) {
            //

            $table->dropColumn('national_id');
            $table->dropColumn('family_card_id');

        });

        Schema::table('families', function (Blueprint $table) {
            //

            $table->string('national_id');
            $table->string('family_card_id');

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
