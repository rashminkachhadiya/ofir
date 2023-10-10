<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemStock;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;


class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemStatus = ['0'=>'Apro','1'=>'Sold'];
        $itemStatus[''] = 'All Status';
        return view('backend.admin.stock.index',compact('itemStatus'));
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

      $items = ItemStock::select('item_stocks.*');
        if(!is_null($request['item_status']))
        {
          $items->where('item_status','=',$request['item_status']);
        }
      return Datatables::of($items)
        ->addColumn('created_at', function ($items) {
          return Carbon::parse($items->created_at)->format('d/m/Y');
        })
        ->addColumn('date', function ($items) {
          return Carbon::parse($items->date)->format('d/m/Y');
        })
        ->addColumn('qty', function ($items) {
          return number_format((float)$items->qty, 0, '.', '');
        })
        ->addColumn('sku', function ($items) {
            return $items->item['sku'];
        })
        ->rawColumns(['created_at', 'date','sku'])
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
}
