<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_leave_ID')->constrained('main_leaves')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('leave_name');
            $table->longText('description');
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
        Schema::dropIfExists('sub_leaves');
    }
}
