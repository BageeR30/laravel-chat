<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('from_user');
            $table->foreign('from_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('to_user');
            $table->foreign('to_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->longText('text');

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
        Schema::dropIfExists('messages');
    }
};
