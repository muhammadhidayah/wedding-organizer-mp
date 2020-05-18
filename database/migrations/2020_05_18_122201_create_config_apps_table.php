<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_apps', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('app_description')->nullable();
            $table->text('app_about')->nullable();
            $table->text('app_address')->nullable();
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
        Schema::dropIfExists('config_apps');
    }
}
