<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_order', function (Blueprint $table) {
            $table->id();
            $table->string('progress_order');
            $table->foreignId('order_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });

        Schema::table('progress_order', function (Blueprint $column) {
            $column ->foreign('order_id')
                    ->references('id')
                    ->on('order')
                    ->onDelete('cascade');
            
            $column ->foreign('user_id')
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
        Schema::dropIfExists('progress_order');
    }
}
