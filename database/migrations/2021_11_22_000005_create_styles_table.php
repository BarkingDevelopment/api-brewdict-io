<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->id();
            $table->string("name", 64);
            $table->foreignId("style_category_id")->constrained("style_categories");
            $table->char("style_letter", 1);
            $table->string("type", 16);
            $table->decimal("og_min", 6, 5, true);
            $table->decimal("og_max", 6, 5, true);
            $table->decimal("fg_min", 6, 5, true);
            $table->decimal("fg_max", 6, 5, true);
            $table->tinyInteger("ibu_min", false, true);
            $table->tinyInteger("ibu_max", false, true);
            $table->tinyInteger("srm_min", false, true);
            $table->tinyInteger("srm_max", false, true);
            $table->string("notes");
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
        Schema::dropIfExists('styles');
    }
}
