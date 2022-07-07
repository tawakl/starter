<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('lang_age');
            $table->dropColumn('move_age');
            $table->dropColumn('think_age');
            $table->dropColumn('social_age');
            $table->dropColumn('self_age');
            $table->dropColumn('test_age');
            $table->dropColumn('age');
            $table->dropColumn('birth_date')->nullable();

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
            $table->float('lang_age')->nullable();
            $table->float('move_age')->nullable();
            $table->float('think_age')->nullable();
            $table->float('social_age')->nullable();
            $table->float('self_age')->nullable();
            $table->float('test_age')->nullable();
            $table->float('age')->nullable();
            $table->date('birth_date')->nullable();
        });
    }
}
