<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_adjustments', function (Blueprint $table) {
            $table->id();
            $table->timeTz('time_in1');
            $table->timeTz('time_out1');
            $table->timeTz('time_in2');
            $table->timeTz('time_out2');
            $table->timeTz('time_in3');
            $table->timeTz('time_out3');
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
        Schema::dropIfExists('time_adjustments');
    }
}
