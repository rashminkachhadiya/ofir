<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSuEstCurrencyInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('su_est_currency')->nullable()->after('su_pcs');
            $table->string('su_est_price')->nullable()->after('su_est_currency');
            $table->string('su_tot_est_price')->nullable()->after('su_est_price');
            $table->string('su_carat_price')->nullable()->after('su_tot_est_price');

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
            $table->dropColumn('su_est_currency');
            $table->dropColumn('su_est_price');
            $table->dropColumn('su_tot_est_price');
            $table->dropColumn('su_carat_price');
        });
    }
}
