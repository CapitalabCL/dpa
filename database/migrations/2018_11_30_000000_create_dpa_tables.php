<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDPATables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regiones', function(Blueprint $table) {
            $table->id();
            $table->string('nombre', 64);
            $table->string('ordinal', 4);
        });

        Schema::create('provincias', function(Blueprint $table) {
            $table->id();
            $table->string('nombre', 64);
            $table->unsignedInteger('region_id');

            $table->foreign('region_id')->references('id')->on('regiones');
        });

        Schema::create('comunas', function(Blueprint $table) {
            $table->id();
            $table->string('nombre', 64);
            $table->unsignedInteger('provincia_id');

            $table->foreign('provincia_id')->references('id')->on('provincias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regiones');
        Schema::dropIfExists('provincias');
        Schema::dropIfExists('comunas');
    }
}
