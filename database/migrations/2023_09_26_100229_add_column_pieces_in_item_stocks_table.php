<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPiecesInItemStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_stocks', function (Blueprint $table) {
            $table->string('pieces')->nullable()->after('ct');
            $table->string('size')->nullable()->after('pieces');
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
            $table->dropColumn('pieces');
            $table->dropColumn('size');
        });
    }
}
