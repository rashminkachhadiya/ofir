<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use View;

class MyAccountController extends Controller
{
    //

    public function index()
    {
    	$user = User::find(Auth::user()->id);
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $pendingOrders = Order::where('user_id',Auth::user()->id)->where('order_status',0)->orderBy('created_at','DESC')->get();
        $readyOrders = Order::where('user_id',Auth::user()->id)->where('order_status',1)->orderBy('created_at','DESC')->get();
        $cartItem = Cart::select('items.sku','items.item_title','items.photo','carts.*','carts.id as cart_id','carts.size as cart_size')->join('items','carts.item_id','items.id')->where('user_id',Auth::user()->id)->get()->toArray();
        return view('frontend.myaccount.index',compact('user','orders','pendingOrders','readyOrders','cartItem'));
    }

    public function orderDetails(Request $request)
    {
        $order = Order::find($request->order_id);
        $view = View::make('frontend.myaccount.order_view', compact('order'))->render();
        return response()->json(['html' => $view]);
    }

    public function orderConfirm(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->order_status = 3;
        $order->save();
        return true;
    }

    public function orderCancel(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->delete();
        return true;
    }

    public function userView(Request $request)
    {
        if(isset($request->ids)){
          $id = explode(',',$request->ids);
        }
        $orders = Order::whereIn('id',$id)->get();
        $supplier = Supplier::all()->pluck('f_name','id')->toArray();
        return view('frontend.myaccount.all_order_view',compact('orders','supplier'));
    }
}
