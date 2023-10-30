<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDWeightPriceInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('d_weight_price')->nullable()->after('tot_p_price');
            $table->string('d_qty_price')->nullable()->after('d_weight_price');
            $table->string('p_weight_price')->nullable()->after('d_qty_price');
            $table->string('p_qty_price')->nullable()->after('p_weight_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('d_weight_price');
            $table->dropColumn('d_qty_price');
            $table->dropColumn('p_weight_price');
            $table->dropColumn('p_qty_price');
        });
    }
}
