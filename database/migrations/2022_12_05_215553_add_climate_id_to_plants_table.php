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
        //create table plants
        Schema::table('plants', function (Blueprint $table) {
            //define climate_id as foreign key
            $table->unsignedBigInteger('climate_id');
            $table->foreign('climate_id')->references('id')->on('climates')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //if table deleted - drop foreign keys
        Schema::table('plants', function (Blueprint $table) {
            $table->dropForeign(['climate_id']);
            $table->dropColumn('climate_id');
        });
        Schema::dropIfExists('category_plant');
    }
};
