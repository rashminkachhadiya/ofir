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
}
