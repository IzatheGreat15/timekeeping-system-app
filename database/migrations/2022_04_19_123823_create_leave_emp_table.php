<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveEmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_emp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_ID')->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('main_leave_ID')->constrained('main_leaves')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('sub_leave_ID')->constrained('sub_leaves')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('leave_emp');
    }
}
