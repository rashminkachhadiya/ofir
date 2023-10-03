<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCaratInCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('carat')->nullable()->after('cleaerty');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('carat')->nullable()->after('cleaerty');
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
            $table->dropColumn('carat');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('carat');            
        });
    }
}
