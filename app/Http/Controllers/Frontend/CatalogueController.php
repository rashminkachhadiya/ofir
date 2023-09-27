<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use View;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;


class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.catalogue.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSubCatalogue(Request $request)
    {
        $catalogueTitle = config('params.catalogue')[$request->sub_catalogue];
        $catalogueId = $request->sub_catalogue;
        $subCatalogue = config('params.'.$request->sub_catalogue);
        return view('frontend.catalogue.sub_catalogue',compact('subCatalogue','catalogueTitle','catalogueId'));
    }

    public function getItems(Request $request)
    {
        $previousURL = url()->previous();
        $last_url = explode('?',str_replace(url('/'), '', $previousURL));
        if(isset($last_url[1]))
        {
            if($last_url[1] != 'all_product=yes' && $last_url[1] != 'all_product=no')
            {
                Session::put('previousURL',url()->previous());
            }
        }
        $pagination = 9;
        $mainCatalogue = $request->main_catalogue;
        $subCatelogue = $request->sub_catalogue;
        if(config('params.'.$request->main_catalogue)[$request->sub_catalogue] == 'ALL COLLECTIONS'){
            $items = Item::where('catalogue_id',$request->main_catalogue)->where('is_allcollection',1)->where('is_active',1);
        }elseif(config('params.'.$request->main_catalogue)[$request->sub_catalogue] == 'AVAILABLE'){
            $items = Item::where('catalogue_id',$request->main_catalogue)->where('is_available',1)->where('is_active',1);
        }else{
            $items = Item::where('catalogue_id',$request->main_catalogue)->where('sub_catalogue_id',$request->sub_catalogue)->where('is_active',1);
        }

        if($request->all_product == 'yes')
        {
            $items = $items->get();
            $page = 'all_product';
        }else{
            $items = $items->paginate($pagination);
            $page = '1';
        }    
        return view('frontend.catalogue.items',compact('items','page','mainCatalogue','subCatelogue'));
    }

    public function itemDetails(Request $request)
    {
        $item = Item::where('id',$request->item_id)->first();
        $view = View::make('frontend.catalogue.quick_view', compact('item'))->render();
        return response()->json(['html' => $view]);
    }

    public function addToCart(Request $request)
    {
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->item_id = $request->item_id;
        $cart->quantity = $request->item_qty;
        $cart->size = $request->size;
        $cart->ref = $request->ref;
        $cart->notes = $request->notes;
        $cart->save();
        return true;
    }

    public function cart(Request $request)
    {   
        $cartItem = Cart::select('items.*','carts.*','carts.id as cart_id','carts.size as cart_size')->join('items','carts.item_id','items.id')->where('user_id',Auth::user()->id)->get()->toArray();

        // echo "<pre>";
        // print_r($cartItem);
        // die;
        return view('frontend.myaccount.cart',compact('cartItem'));
    }

    public function removeToCart(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        $cart->delete();
        return true;
    }

    public function createOrder(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->order_number = Order::autoGenerateOrderNumber();
        $order->sku = $cart->itemDetails->sku;
        $order->category_id = $cart->itemDetails->sub_catalogue_id;
        if(!is_null($cart->itemDetails->photo))
        {
            $image = explode('assets/images/items/',$cart->itemDetails->photo);
        }
        if(!is_null($image[1]))
        {
            $order->images = $image[1];
        }
        $order->metal_type = $cart->itemDetails->metal_type;
        $order->metal_colour = $cart->itemDetails->metal_colour;
        $order->size = $cart->size;
        $order->quantity = $cart->quantity;
        $order->notes = $cart->notes;
        $order->ref = $cart->ref;
        $order->save();
        $cart->delete();
        return true;
    }
}
