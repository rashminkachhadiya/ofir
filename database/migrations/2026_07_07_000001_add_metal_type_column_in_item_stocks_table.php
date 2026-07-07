<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetalTypeColumnInItemStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_stocks', function (Blueprint $table) {
            $table->tinyInteger('metal_type')->nullable()->comment('0=18K,1=Platinum,2=Platinum 950,3=14K,4=9K')->after('gram');
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
            $table->dropColumn('metal_type');
        });
    }
}
