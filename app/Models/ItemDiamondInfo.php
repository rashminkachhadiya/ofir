<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDiamondInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'shape',
        'carat',
        'pcs',
        'colour',
        'cleaerty',
        'sort_order',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
