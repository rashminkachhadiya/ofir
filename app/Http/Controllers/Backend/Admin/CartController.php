<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::pluck('f_name','id')->toArray();
        $users[''] = 'All Users';
        return view('backend.admin.cart.index',compact('users'));
    }

    public function getAll(Request $request)
    {   
        $can_edit = $can_delete = '';
      if (!auth()->user()->can('user-edit')) {
         $can_edit = "style='display:none;'";
      }
      if (!auth()->user()->can('user-delete')) {
         $can_delete = "style='display:none;'";
      }

      $carts = Cart::select('carts.*');
      if(!empty($request['user_id']))
      {
        $carts->where('carts.user_id', '=', $request['user_id']);
      }
      return Datatables::of($carts)
        ->addColumn('created_at', function ($carts) {
          return Carbon::parse($carts->created_at)->format('d/m/Y');
        })
        ->addColumn('client_name', function ($carts) {
           return $carts->orderUser->f_name;
        })
        ->addColumn('sku', function ($carts) {
           return $carts->itemDetails->sku;
        })
        ->addColumn('category', function ($carts) {
           return config('params.categories')[$carts->itemDetails->sub_catalogue_id];
        })
        ->addColumn('action', function ($carts) use ($can_edit, $can_delete) {
           $html = '<div class="btn-group">';
           
           $html .= '<a href="' . \URL :: to('admin/cart') .  '/' . $carts->id . '"  id="' . $carts->id . '" class="btn btn-xs btn-success margin-r-5" title="View"><i class="fa fa-eye fa-fw"></i> </a>';
           $html .= '</div>';
           return $html;
        })
        ->rawColumns(['created_at','client_name','action'])
        ->addIndexColumn()
        ->make(true);
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
        $order = Cart::find($id);
        return view('backend.admin.cart.view',compact('order'));
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
}
