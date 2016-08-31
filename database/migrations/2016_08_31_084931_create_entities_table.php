<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('address', 150)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('state', 45)->nullable();
            $table->bigInteger('zip')->nullable();
            $table->bigInteger('telephone')->nullable();
            $table->string('email', 60)->nullable();
            $table->string('logo', 200)->nullable();
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
        Schema::drop('entities');
    }
}
