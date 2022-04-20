<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNullableToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('approval_ID')->nullable()->change();
            $table->foreignId('sub_ID')->nullable()->change();
        });

        Schema::table('leave_emp', function (Blueprint $table) {
            $table->foreignId('sub_leave_ID')->nullable()->change();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->longText('comment1')->nullable()->change();
            $table->longText('comment2')->nullable()->change();
        });

        Schema::table('time_adjustments', function (Blueprint $table) {
            $table->time('time_in1')->nullable()->change();
            $table->time('time_out1')->nullable()->change();
            $table->time('time_in2')->nullable()->change();
            $table->time('time_out2')->nullable()->change();
            $table->time('time_in3')->nullable()->change();
            $table->time('time_out3')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('approval_ID');
            $table->dropColumn('sub_ID');
        });

        Schema::table('leave_emp', function (Blueprint $table) {
            $table->dropColumn('sub_leave_ID');
            $table->dropColumns('document_file');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('comment1');
            $table->dropColumn('comment2');
        });

        Schema::table('time_adjustments', function (Blueprint $table) {
            $table->dropColumn('time_in1');
            $table->dropColumn('time_out1');
            $table->dropColumn('time_in2');
            $table->dropColumn('time_out2');
            $table->dropColumn('time_in3');
            $table->dropColumn('time_out3');
        });
    }
}
