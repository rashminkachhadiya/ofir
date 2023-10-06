<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    public function orderUser()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public static function autoGenerateOrderNumber() {
        $po_detail = self::select('order_number')->orderBy('id', 'desc')->first();
        if (!empty($po_detail)) {
            $expNum = explode('-', $po_detail->order_number);

            for($i=1;$i<=100;$i++)
            {
              $poNum= sprintf("%05d", $expNum[1] + $i);
              $poExists = self::select('order_number')->where('order_number',$poNum)->first();
              if(is_null($poExists))
              {
                return $poNum;
              }
            }
            return sprintf("%05d", $expNum[1] + 1);
        }
        else {
            return 'O-0000001';
        }
    }

    public function orderPicture()
    {
    	return $this->hasMany(OrderImage::class, 'order_id','id');
    }

    public function next(){
    // get next user
    return Order::select('id')->where('id', '>', $this->id)->orderBy('id','asc')->first()->id ?? NULL;

    }
    public  function previous(){
        // get previous  user
        return Order::where('id', '<', $this->id)->orderBy('id','desc')->first()->id ?? NULL;

    }
}
