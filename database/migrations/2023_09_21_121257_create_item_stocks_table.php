<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->index()->comment('id of items table');
            $table->foreign('item_id')->references('id')->on('items');
            $table->decimal('qty',10,2)->nullable();
            $table->decimal('gram',10,2)->nullable();
            $table->decimal('ct',10,2)->nullable();
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
        Schema::dropIfExists('item_stocks');
    }
}
