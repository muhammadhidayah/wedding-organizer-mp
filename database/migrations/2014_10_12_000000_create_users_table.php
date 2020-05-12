<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('usertype', ['admin', 'member'])->default('member');
            $table->enum('status_user', ['registered', 'unregistered'])->default('unregistered');
            $table->string('mobile_phone')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_verification', function (Blueprint $table) {
            $table->id();
            $table->string('token_short');
            $table->string('token_long');
            $table->foreignId('user_id');
            $table->bigInteger('expired_token');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
