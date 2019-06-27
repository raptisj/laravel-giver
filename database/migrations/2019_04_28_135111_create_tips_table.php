<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tips', function (Blueprint $table) {
            $table->bigIncrements('id');

            // $table->unsignedInteger('history_id')->default(0);
            // $table->foreign('history_id')->references('id')->on('histories');
            $table->unsignedInteger('tips_id')->default(0);
            $table->string('name');
            $table->float('hours', 0, 2);
            $table->integer('ammount')->default(0);
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
        Schema::dropIfExists('tips');
    }
}
