<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnumToTypeTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('tags', 'type'))
        Schema::table('tags', function ($table) {

            $table->dropColumn('type');

        });

        Schema::table('tags', function (Blueprint $table) {
            $table->enum('type', ["medici", "sopnsors", "warehause", "doctors"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            //
        });
    }
}
