<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProbeStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('probe_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId("probe_id")->constrained("probes");
            $table->timestamp("recorded_at")->useCurrent();
            $table->float("battery");
            $table->bigInteger("signal_strength")->comment("The current RSSI (Received Signal Strength) in dBm.");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('probe_stats');
    }
}
