<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateItemDiamondAndGemInfoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_diamond_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->string('shape')->nullable();
            $table->string('carat')->nullable();
            $table->string('pcs')->nullable();
            $table->string('colour')->nullable();
            $table->string('cleaerty')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->index(['item_id', 'sort_order']);
        });

        Schema::create('item_gem_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->string('gem')->nullable();
            $table->string('shape')->nullable();
            $table->string('carat')->nullable();
            $table->string('colour')->nullable();
            $table->string('cleaerty')->nullable();
            $table->string('pcs')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->index(['item_id', 'sort_order']);
        });

        $this->migrateExistingItemData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_gem_infos');
        Schema::dropIfExists('item_diamond_infos');
    }

    private function migrateExistingItemData(): void
    {
        if (!Schema::hasTable('items')) {
            return;
        }

        $items = DB::table('items')->get();

        foreach ($items as $item) {
            if ($this->hasDiamondData($item)) {
                DB::table('item_diamond_infos')->insert([
                    'item_id' => $item->id,
                    'shape' => $item->diamond_shape,
                    'carat' => $item->diamond_carat,
                    'pcs' => $item->diamond_pcs,
                    'colour' => $item->diamond_colour,
                    'cleaerty' => $item->diamond_cleaerty,
                    'sort_order' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            if ($this->hasGemData($item)) {
                DB::table('item_gem_infos')->insert([
                    'item_id' => $item->id,
                    'gem' => $item->gem,
                    'shape' => $item->shape,
                    'carat' => $item->carat,
                    'colour' => $item->colour,
                    'cleaerty' => $item->cleaerty,
                    'pcs' => $item->pcs,
                    'sort_order' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function hasDiamondData($item): bool
    {
        return !empty($item->diamond_shape)
            || !empty($item->diamond_carat)
            || !empty($item->diamond_pcs)
            || !empty($item->diamond_colour)
            || !empty($item->diamond_cleaerty);
    }

    private function hasGemData($item): bool
    {
        return !empty($item->gem)
            || !empty($item->shape)
            || !empty($item->carat)
            || !empty($item->colour)
            || !empty($item->cleaerty)
            || !empty($item->pcs);
    }
}
