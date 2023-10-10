<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStocknoteInItemStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_stocks', function (Blueprint $table) {
            $table->string('stocknotes')->nullable()->after('date');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_stocks', function (Blueprint $table) {
            $table->dropColumn('stocknotes');
        });
    }
}
