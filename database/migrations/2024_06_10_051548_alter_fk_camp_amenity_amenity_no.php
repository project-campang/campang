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
        Schema::table('camp_amenities', function(Blueprint $table) {
            $table->foreign('amenity_no')->references('id')->on('amenities');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('camp_amenities', function(Blueprint $table) {
            $table->dropForeign(['amenity_no']);
        }); 
    }
};
