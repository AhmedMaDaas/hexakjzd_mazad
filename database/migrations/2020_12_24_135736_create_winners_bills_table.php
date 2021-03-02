<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinnersBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winners_bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('live_id')->unsigned();
            $table->foreign('live_id')->references('id')->on('lives')->onDelete('cascade');

            $table->bigInteger('auction_id')->unsigned();
            $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');

            $table->double('final_price');
            $table->enum('payment_method', ['visa_card','paypal']);
            $table->string('id_payment')->nullable();
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
        Schema::dropIfExists('winners_bills');
    }
}
