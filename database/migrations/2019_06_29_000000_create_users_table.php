<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable()->index(); // required
            $table->string('name');
            $table->string('governorate')->index();
            $table->string('city')->index();
            $table->string('result')->nullable();
            $table->string('email')->nullable()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile_number')->index()->nullable(); //required
            $table->string('password')->nullable(); //required
            $table->rememberToken();
            $table->string('confirm_token', 190)->nullable();
            $table->string('profile_picture', 190)->nullable();
            $table->date('birth_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
