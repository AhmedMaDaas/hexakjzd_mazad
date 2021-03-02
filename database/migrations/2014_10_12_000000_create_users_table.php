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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->boolean('fake')->default(0);
            //$table->longtext('commint')->nullable();
            $table->boolean('approval')->default(0);
            $table->enum('attention',['attention1','attention2','expulsion'])->nullable();
            $table->boolean('blocked')->default(0);
            $table->boolean('shared_winner')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
