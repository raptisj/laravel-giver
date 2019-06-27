<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tip_rounds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('days_total');
            $table->unsignedBigInteger('historie_id')->default(0);
            $table->timestamps();
            $table->foreign('historie_id')->references('id')->on('histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tip_rounds');
    }
}
