<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGemInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'gem',
        'shape',
        'carat',
        'colour',
        'cleaerty',
        'pcs',
        'sort_order',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
