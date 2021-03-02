<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longtext('description')->nullable();
            $table->bigInteger('views')->default(0);
            $table->bigInteger('cheat_views')->default(0);
            $table->bigInteger('likes')->default(0);
            $table->bigInteger('cheat_likes')->default(0);
            $table->enum('live_status',['not_yet','started','finished'])->default('not_yet');
            $table->string('timer');
            $table->string('timer_pause')->nullable();
            $table->integer('min_value');
            $table->dateTime('live_start');
            $table->integer('bargaining_value');
            $table->boolean('hide_live')->default(1);
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
        //
    }
}
