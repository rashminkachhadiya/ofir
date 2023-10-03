<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMetalTypeInCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('metal_type')->nullable()->after('ref');
            $table->string('weight')->nullable()->after('metal_type');
            $table->string('gem')->nullable()->after('weight');
            $table->string('shape')->nullable()->after('gem');
            $table->string('metal_colour')->nullable()->after('shape');
            $table->string('cleaerty')->nullable()->after('metal_colour');
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
            $table->dropColumn('metal_type');
            $table->dropColumn('weight');
            $table->dropColumn('gem');
            $table->dropColumn('shape');
            $table->dropColumn('metal_colour');
            $table->dropColumn('cleaerty');

        });
    }
}
