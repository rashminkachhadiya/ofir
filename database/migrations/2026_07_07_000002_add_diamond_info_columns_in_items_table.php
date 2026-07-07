<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiamondInfoColumnsInItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('diamond_shape')->nullable()->after('diamond_note');
            $table->string('diamond_carat')->nullable()->after('diamond_shape');
            $table->string('diamond_pcs')->nullable()->after('diamond_carat');
            $table->string('diamond_colour')->nullable()->after('diamond_pcs');
            $table->string('diamond_cleaerty')->nullable()->after('diamond_colour');
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
            $table->dropColumn('diamond_shape');
            $table->dropColumn('diamond_carat');
            $table->dropColumn('diamond_pcs');
            $table->dropColumn('diamond_colour');
            $table->dropColumn('diamond_cleaerty');
        });
    }
}
