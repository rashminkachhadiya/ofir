<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnItemTitleGramInItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('sku', 255)->nullable()->after('id');
            $table->string('item_title_gram', 255)->nullable()->after('item_title');
            $table->string('size')->nullable()->after('is_available');
            $table->tinyInteger('metal_colour')->nullable()->comment('0=white,1=yellow,2=red,3-mix')->after('size');
            $table->tinyInteger('metal_type')->nullable()->comment('0=9K,1=18K,2=platinum')->after('metal_colour');
            $table->string('gram')->nullable()->after('metal_type');
            $table->string('quantity')->nullable()->after('gram');
            $table->string('ct')->nullable()->after('quantity');
             
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
            $table->dropColumn('sku');
            $table->dropColumn('item_title_gram');
            $table->dropColumn('size');
            $table->dropColumn('metal_colour');
            $table->dropColumn('metal_type');
            $table->dropColumn('gram');
            $table->dropColumn('quantity');
            $table->dropColumn('ct');

        });
    }
}
