<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOneTwoThreeFourFiveToVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vote', function (Blueprint $table) {
            $table->string('one')->nullable();
            $table->string('two')->nullable();
            $table->string('three')->nullable();
            $table->string('four')->nullable();
            $table->string('five')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vote', function (Blueprint $table) {
            $table->string('one')->nullable();
            $table->string('two')->nullable();
            $table->string('three')->nullable();
            $table->string('four')->nullable();
            $table->string('five')->nullable();
        });
    }
}
