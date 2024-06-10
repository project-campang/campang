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
        Schema::table('camp_topos', function(Blueprint $table) {
            $table->foreign('topo_no')->references('id')->on('topos');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('camp_topos', function(Blueprint $table) {
            $table->dropForeign(['topo_no']);
        }); 
    }
};
