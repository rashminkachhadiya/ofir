<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPhoto2InItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('photo_2')->nullable()->after('photo');
            $table->string('photo_3')->nullable()->after('photo_2');
            $table->string('photo_4')->nullable()->after('photo_3');
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
            $table->dropColumn('photo_2');
            $table->dropColumn('photo_3');
            $table->dropColumn('photo_4');
        });
    }
}
