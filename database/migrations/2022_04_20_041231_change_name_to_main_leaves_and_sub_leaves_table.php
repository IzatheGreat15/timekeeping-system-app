<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNameToMainLeavesAndSubLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_leaves', function (Blueprint $table) {
            $table->renameColumn('leave_name', 'main_leave_name');
        });

        Schema::table('sub_leaves', function (Blueprint $table) {
            $table->renameColumn('leave_name', 'sub_leave_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main_leaves', function (Blueprint $table) {
            $table->dropColumn('leave_name');
        });

        Schema::table('sub_leaves', function (Blueprint $table) {
            $table->dropColumn('leave_name');
        });
    }
}
