<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProbesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("probes", function (Blueprint $table) {
            $table->id();
            $table->integer("chip_id")->unique()->nullable()->comment("Unique identifier for iSpindel probes.");
            $table->macAddress("mac")->unique()->nullable()->comment("Unique identifier for Tilt hydrometer and other hardware probes.");
            $table->string("name", 64);
            $table->string("colour", 16)->nullable()->comment("Colour identifier for Tilt hydrometers.");
            $table->foreignId("owner_id")->constrained("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('probes');
    }
}
