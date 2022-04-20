<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddColumnsToRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('change_shift_emp', function (Blueprint $table) {
            $table->timestamp('updated_at1')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at2')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('leave_emp', function (Blueprint $table) {
            $table->timestamp('updated_at1')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at2')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('adjustment_emp', function (Blueprint $table) {
            $table->timestamp('updated_at1')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at2')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('overtime_emp', function (Blueprint $table) {
            $table->timestamp('updated_at1')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at2')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('change_shift_emp', function (Blueprint $table) {
            $table->dropColumn('updated_at1');
            $table->dropColumn('updated_at2');
        });

        Schema::table('leave_emp', function (Blueprint $table) {
            $table->dropColumn('updated_at1');
            $table->dropColumn('updated_at2');
        });

        Schema::table('adjustment_emp', function (Blueprint $table) {
            $table->dropColumn('updated_at1');
            $table->dropColumn('updated_at2');
        });

        Schema::table('overtime_emp', function (Blueprint $table) {
            $table->dropColumn('updated_at1');
            $table->dropColumn('updated_at2');
        });
    }
}
