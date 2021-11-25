<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProbeAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('probe_assignment', function (Blueprint $table) {
            $table->id();
            $table->foreignId("fermentation_id")->constrained("fermentations");
            $table->foreignId("probe_id")->constrained("probes");
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
        Schema::dropIfExists('probe_assignment');
    }
}
