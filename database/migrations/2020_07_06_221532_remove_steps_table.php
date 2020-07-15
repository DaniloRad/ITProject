<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('steps');
        Schema::dropIfExists('recipe_ingredients');
        Schema::dropIfExists('ingredients');

        Schema::table('recipes', function(Blueprint $table) {
            $table->text('ingredients');
            $table->text('steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('steps', function (Blueprint $table) {
            //
        });
    }
}
