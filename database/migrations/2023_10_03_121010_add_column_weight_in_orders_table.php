<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnWeightInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('weight')->nullable()->after('metal_colour');
            $table->string('gem')->nullable()->after('weight');
            $table->string('shape')->nullable()->after('gem');
            $table->string('cleaerty')->nullable()->after('shape');
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
            $table->dropColumn('weight');
            $table->dropColumn('gem');
            $table->dropColumn('shape');
            $table->dropColumn('cleaerty');            
        });
    }
}
