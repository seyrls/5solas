<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('family_id')->unsigned();
            $table->foreign('family_id')->references('id')->on('families');
            $table->string('name', 100);
            $table->date('birthday')->nullable();
            $table->integer('telephone')->nullable();
            $table->integer('cellphone')->nullable();
            $table->string('email', 60)->nullable();
            $table->char('gender',1)->nullable();
            $table->boolean('status')->default('1');
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
        Schema::drop('members');
    }
}
