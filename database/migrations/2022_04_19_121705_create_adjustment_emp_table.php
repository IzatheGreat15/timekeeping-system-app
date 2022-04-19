<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustmentEmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjustment_emp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_ID')->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('time_ID')->constrained('time_adjustments')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('att_ID')->constrained('attendance')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
        Schema::dropIfExists('adjustment_emp');
    }
}
