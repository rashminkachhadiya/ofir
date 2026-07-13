<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemStock;

class Item extends Model
{
    use HasFactory;

    public function itemStock()
    {
        return $this->hasMany(ItemStock::class,'item_id','id');
    }

    public function diamondInfos()
    {
        return $this->hasMany(ItemDiamondInfo::class)->orderBy('sort_order');
    }

    public function gemInfos()
    {
        return $this->hasMany(ItemGemInfo::class)->orderBy('sort_order');
    }
}
