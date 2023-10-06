<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPcsInCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('carts', function (Blueprint $table) {
            $table->string('pcs')->nullable()->after('cleaerty');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('pcs')->nullable()->after('cleaerty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('pcs');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('pcs');            
        });
    }
}
