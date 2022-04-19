<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveBalEmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_bal_emp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_ID')->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('main_leave_ID')->constrained('main_leaves')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('balance');
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
        Schema::dropIfExists('leave_bal_emp');
    }
}
