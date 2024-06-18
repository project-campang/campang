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
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('camp_id')->nullable();
            $table->char('type', 1);
            $table->string('title', 50);
            $table->string('content', 500);
            $table->string('main_img', 100)->nullable();
            $table->string('other_img2', 100)->nullable();
            $table->string('other_img3', 100)->nullable();
            $table->string('other_img4', 100)->nullable();
            $table->string('other_img5', 100)->nullable();
            $table->integer('views')->default(0)->nullable();
            $table->char('rating', 1)->default(0)->nullable();
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
        Schema::dropIfExists('communities');
    }
};
