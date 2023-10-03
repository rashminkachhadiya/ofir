<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderImage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = config('params.categories');
        $metalType = config('params.metal_type');
        $metalColour = config('params.metal_colour');
        return view('frontend.order.index',compact('categories','metalType','metalColour'));
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
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->order_number = Order::autoGenerateOrderNumber();
        $order->category_id = $request->category_id;
        $order->metal_type = $request->metal_type;
        $order->metal_colour = $request->metal_colour;
        $order->size = $request->size;
        $order->quantity = $request->quantity;
        $order->notes = $request->notes;
        $order->save();

        foreach ($request->file('file') as $image) {
            $orderImage = new OrderImage();
            $orderImage->order_id = $order->id;
            $destinationPath = public_path('assets/images/users/order');
            $imageName = $image->getClientOriginalName();
            $image->move($destinationPath,$imageName);
            $orderImage->images = $imageName;
            $orderImage->save();
        }

        return response()->json(['type' => 'success', 'message' => "Successfully Created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
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
    public function update(Request $request, Order $order)
    {
        
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
}
