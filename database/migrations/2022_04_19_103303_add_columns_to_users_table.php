<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('dept_ID')->constrained('departments')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('approval_ID')->constrained('approvals')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('sub_ID')->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('dept_ID');
            $table->dropColumn('approval_ID');
            $table->dropColumn('sub_ID');
        });
    }
}
