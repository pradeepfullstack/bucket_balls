<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balls', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->integer('size');
            $table->unsignedBigInteger('bucket_id');
            $table->foreign('bucket_id')->references('id')->on('buckets')->onDelete('cascade');
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
        Schema::dropIfExists('balls');
    }
}
