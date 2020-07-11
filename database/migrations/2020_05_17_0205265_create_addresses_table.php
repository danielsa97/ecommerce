<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('district');
            $table->string('number', 8)->nullable();
            $table->string('zipcode', 11)->nullable();
            $table->string('complement');
            $table->morphs('addressable');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('city_id')->references('id')->on('cities');
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
        Schema::dropIfExists('addresses');
    }
}
