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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('camp_id');
            $table->string('title', 50);
            $table->string('content', 500);
            $table->string('img_1', 100);
            $table->string('img_2', 100)->nullable();
            $table->string('img_3', 100)->nullable();
            $table->string('img_4', 100)->nullable();
            $table->string('img_5', 100)->nullable();
            $table->char('rating', 1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
