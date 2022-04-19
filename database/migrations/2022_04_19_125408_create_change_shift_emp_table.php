<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeShiftEmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_shift_emp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_ID')->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('shift_emp_ID')->constrained('shift_emp')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('shift_ID')->constrained('shifts')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
        Schema::dropIfExists('change_shift_emp');
    }
}
