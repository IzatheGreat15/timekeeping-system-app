<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOvertimeEmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtime_emp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_ID')->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('date');
            $table->timeTz('start_time');
            $table->timeTz('end_time');
            $table->longText('reason');
            $table->foreignId('comment_ID')->constrained('comments')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->enum('status1', ['PENDING', 'APPROVED', 'SENT BACK', 'REJECTED'])->default('PENDING');
            $table->enum('status2', ['PENDING', 'APPROVED', 'SENT BACK', 'REJECTED'])->default('PENDING');
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
        Schema::dropIfExists('overtime_emp');
    }
}
