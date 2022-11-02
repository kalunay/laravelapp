<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('mark', 55);
            $table->string('model', 55);
            $table->string('generation', 155)->nullable();
            $table->integer('year');
            $table->integer('run');
            $table->string('color', 25)->nullable();
            $table->string('body_type', 55)->nullable();
            $table->string('engine_type', 25);
            $table->string('transmission', 25);
            $table->string('gear_type', 25);
            $table->string('generation_id', 25)->nullable();
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
        Schema::dropIfExists('cars');
    }
}
