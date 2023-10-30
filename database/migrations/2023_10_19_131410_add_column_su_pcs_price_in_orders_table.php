<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSuPcsPriceInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('su_pcs_price')->nullable()->after('su_carat_price');
            $table->string('tot_su_pcs_price')->nullable()->after('su_pcs_price');
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
            $table->dropColumn('su_pcs_price');
            $table->dropColumn('tot_su_pcs_price');
            
        });
    }
}
