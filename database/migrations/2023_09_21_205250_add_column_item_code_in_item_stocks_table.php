<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnItemCodeInItemStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_stocks', function (Blueprint $table) {
            $table->string('item_code')->nullable()->after('item_id');
            $table->string('notes')->nullable()->after('total_ct');
            $table->string('item_status')->nullable()->after('notes');
            $table->datetime('date')->nullable()->after('item_status');
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
            $table->dropColumn('item_code');
            $table->dropColumn('notes');
            $table->dropColumn('item_status');
            $table->dropColumn('date');
        });
    }
}
