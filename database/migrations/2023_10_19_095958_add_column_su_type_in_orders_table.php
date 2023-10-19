<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSuTypeInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('su_metal_type')->nullable()->comment('0=9K,1=18K,2=platinum')->after('admin_notes');
            $table->tinyInteger('su_metal_colour')->nullable()->comment('0=white,1=yellow,2=red,3-mix')->after('su_metal_type');
            $table->string('su_size')->nullable()->after('su_metal_colour');
            $table->string('su_weight')->nullable()->after('su_size');          
            $table->string('su_quantity')->nullable()->after('su_weight');
            $table->string('su_admin_notes',255)->nullable()->after('su_quantity');
            $table->string('su_gem')->nullable()->after('su_admin_notes');
            $table->string('su_shape')->nullable()->after('su_gem');
            $table->string('su_cleaerty')->nullable()->after('su_shape');
            $table->string('su_carat')->nullable()->after('su_cleaerty');
            $table->string('su_colour')->nullable()->after('su_carat');
            $table->string('su_pcs')->nullable()->after('su_colour');
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
            $table->dropColumn('su_metal_type');
            $table->dropColumn('su_metal_colour');
            $table->dropColumn('su_size');
            $table->dropColumn('su_weight');
            $table->dropColumn('su_quantity');
            $table->dropColumn('su_admin_notes');
            $table->dropColumn('su_gem');
            $table->dropColumn('su_shape');
            $table->dropColumn('su_cleaerty');
            $table->dropColumn('su_carat');
            $table->dropColumn('su_colour');
            $table->dropColumn('su_pcs');
        });
    }
}
