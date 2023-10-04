<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnGemInItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('weight')->nullable()->after('metal_type');
            $table->string('gem')->nullable()->after('weight');
            $table->string('shape')->nullable()->after('gem');
            $table->string('cleaerty')->nullable()->after('shape');
            $table->string('carat')->nullable()->after('cleaerty');
            $table->string('colour')->nullable()->after('carat');
            $table->string('pcs')->nullable()->after('colour');
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
            $table->dropColumn('weight');
            $table->dropColumn('gem');
            $table->dropColumn('shape');
            $table->dropColumn('cleaerty');
            $table->dropColumn('carat');
            $table->dropColumn('colour');
            $table->dropColumn('pcs');
        });
    }
}
