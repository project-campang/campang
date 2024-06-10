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
        Schema::create('camps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tel', 20);
            $table->string('address', 100);
            $table->string('state', 100);
            $table->string('country', 100);
            $table->string('info_text', 500);
            $table->integer('max_capacity');
            $table->string('main_img', 200);
            $table->string('other_img_1')->nullable();
            $table->string('other_img_2')->nullable();
            $table->string('other_img_3')->nullable();
            $table->string('other_img_4')->nullable();
            $table->string('other_img_5')->nullable();
            $table->string('other_img_6')->nullable();
            $table->string('other_img_7')->nullable();
            $table->string('other_img_8')->nullable();
            $table->string('other_img_9')->nullable();
            $table->string('other_img_10')->nullable();
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
        Schema::dropIfExists('camps');
    }
};
