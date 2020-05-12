<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_review', function (Blueprint $table) {
            $table->id();
            $table->string('review_comments');
            $table->integer('review_stars');
            $table->foreignId('vendor_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });

        Schema::table('vendor_review', function (Blueprint $table) {
            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendor')
                ->onDelete('cascade');

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
        Schema::dropIfExists('vendor_review');
    }
}
