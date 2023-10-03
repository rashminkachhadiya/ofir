<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cart extends Model
{
    use HasFactory,SoftDeletes;

    public function itemDetails()
    {
        return $this->belongsTo(Item::class, 'item_id','id');
    }

    public function orderUser()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
