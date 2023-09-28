<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPriceInItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('price_usd')->nullable()->after('is_available');
            $table->string('price_pound')->nullable()->after('price_usd');
            $table->string('price_eur')->nullable()->after('price_pound');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('price_usd');
            $table->dropColumn('price_pound');
            $table->dropColumn('price_eur');

        });
    }
}
