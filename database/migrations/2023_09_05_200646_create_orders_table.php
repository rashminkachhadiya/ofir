<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index()->comment('id of users table');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('category_id')->index()->comment('id of categories table');
            $table->text('images')->nullable();
            $table->tinyInteger('metal_type')->nullable()->comment('0=9K,1=18K,2=platinum');
            $table->tinyInteger('metal_colour')->nullable()->comment('0=white,1=yellow,2=red,3-mix');
            $table->string('size')->nullable();
            $table->string('quantity')->nullable();
            $table->string('notes',255)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
