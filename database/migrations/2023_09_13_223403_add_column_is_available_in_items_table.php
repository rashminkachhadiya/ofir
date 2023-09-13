<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsAvailableInItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->tinyInteger('is_allcollection')->default(0)->comment('0-no,1-yes')->after('photo');
            $table->tinyInteger('is_available')->default(0)->comment('0-no,1-yes')->after('is_allcollection');
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
            $table->dropColumn('is_allcollection');
            $table->dropColumn('is_available');
        });
    }
}
