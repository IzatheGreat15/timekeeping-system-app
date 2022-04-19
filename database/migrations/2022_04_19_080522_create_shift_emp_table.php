<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftEmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_emp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_ID')->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('shift_ID')->constrained('shifts')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('shift_emp');
    }
}
