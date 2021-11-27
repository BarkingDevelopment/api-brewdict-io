<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("fermentation_id")->constrained("fermentations");
            $table->enum("type", ["temperature", "density", "ph", "ferm_pressure", "ambient_temp", "altitude"]);
            $table->timestamp("recorded_at")->useCurrent();
            $table->foreignId("probe_id")->nullable()->comment("Nullable to allow for manual records.")->constrained("probes");
            $table->decimal("value", 10, 5);
            $table->char("units", 8)->nullable();
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
        Schema::dropIfExists('readings');
    }
}
