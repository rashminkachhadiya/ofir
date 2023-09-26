<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index()->comment('id of users table');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('item_id')->index()->comment('id of items table');
            $table->foreign('item_id')->references('id')->on('items');
            $table->string('quantity')->nullable();
            $table->string('size')->nullable();
            $table->decimal('price',10,4)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
