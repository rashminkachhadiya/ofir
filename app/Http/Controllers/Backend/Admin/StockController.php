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
        $itemStatus = ['0'=>'Apro','1'=>'Sold','2' => 'In Stock'];
        $catalogues = config('params.catalogue');
        $catalogues[''] = 'All Catalogue';
        $subCatalogue = config('params.1');
        $subCatalogue[''] = 'All Sub Catalogue';
        return view('backend.admin.stock.index',compact('itemStatus','catalogues','subCatalogue'));
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

      $items = ItemStock::select('item_stocks.*','items.sku')
            ->leftjoin('items','items.id','=','item_stocks.item_id');
        if(!is_null($request['item_status']))
        {
            $array = $request['item_status'];
            if(in_array(2, $array))
            {
                $items->orWhere('qty','>',0);
                if (($key = array_search(2, $array)) !== false) {
                    unset($array[$key]);
                }
            }
            $items->orWhereIn('item_status',$array);
        }
        if(!is_null($request['catalogue_id']))
        {
          $items->where('items.catalogue_id', '=', $request['catalogue_id']);
        }
        if(!is_null($request['sub_catalogue_id']))
        {
          $items->where('items.sub_catalogue_id', '=', $request['sub_catalogue_id']);
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
            return '<a href="' . \URL :: to('admin/catalogue') .  '/' . $items->item_id . '/edit" target="_blank">'. $items->sku .'</a>';
        })
        ->addColumn('item_status', function ($items) {
            if(!is_null($items->item_status))
            {
               if($items->item_status == '0')
               {
                    return "Apro";
               }elseif ($items->item_status == '1') {
                   return "Sold";
               }
            }
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
