<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSuShippingInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('su_shipping')->nullable()->after('su_final_total');
            $table->string('su_other_1')->nullable()->after('su_shipping');
            $table->string('su_other_2')->nullable()->after('su_other_1');
            $table->string('d_price')->nullable()->after('su_other_2');
            $table->string('tot_d_price')->nullable()->after('d_price');
            $table->string('p_price')->nullable()->after('tot_d_price');
            $table->string('tot_p_price')->nullable()->after('p_price');

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
            $table->dropColumn('su_shipping');
            $table->dropColumn('su_other_1');
            $table->dropColumn('su_other_2');
            $table->dropColumn('d_price');
            $table->dropColumn('tot_d_price');
            $table->dropColumn('p_price');
            $table->dropColumn('tot_p_price');
            
        });
    }
}
