<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFermentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("fermentations", function (Blueprint $table) {
            $table->id();
            $table->foreignId("recipe_id")->constrained("recipes");
            $table->foreignId("brewed_by")->constrained("users");
            $table->foreignId("equipment_id")->nullable()->comment("Equipment Table is not implemented in MVP.")->constrained("equipment");
            $table->timestamp("started_at")->nullable();
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
        Schema::dropIfExists('fermentations');
    }
}
