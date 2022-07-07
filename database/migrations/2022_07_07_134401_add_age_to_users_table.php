<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lang_age')->nullable();
            $table->string('move_age')->nullable();
            $table->string('think_age')->nullable();
            $table->string('social_age')->nullable();
            $table->string('self_age')->nullable();
            $table->string('test_age')->nullable();
            $table->string('age')->nullable();
            $table->string('birth_date')->nullable();
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
            $table->dropColumn('lang_age');
            $table->dropColumn('move_age');
            $table->dropColumn('think_age');
            $table->dropColumn('social_age');
            $table->dropColumn('self_age');
            $table->dropColumn('test_age');
            $table->dropColumn('age');
            $table->dropColumn('birth_date');

        });
    }
}
