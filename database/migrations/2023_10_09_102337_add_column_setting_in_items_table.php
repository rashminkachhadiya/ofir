<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSettingInItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('setting')->nullable()->after('total_ct');
            $table->string('diamond')->nullable()->after('setting');
            $table->string('loss')->nullable()->after('diamond');
            $table->string('diamond_note')->nullable()->after('loss');

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
            $table->dropColumn('setting');            
            $table->dropColumn('diamond');            
            $table->dropColumn('loss');            
            $table->dropColumn('diamond_note');            
            
        });
    }
}
