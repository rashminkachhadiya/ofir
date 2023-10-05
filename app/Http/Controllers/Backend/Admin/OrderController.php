<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\Role;
use App\Models\User;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use View;
use DB;
use URL;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderStatus = config('params.order_status');
        $orderStatus[''] = 'All Status';
        $users = User::pluck('f_name','id')->toArray();
        $users[''] = 'All Users';
        return view('backend.admin.order.index',compact('orderStatus','users'));
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
      $orders = Order::select('*');
      $supplier = Supplier::pluck('f_name','id')->toArray();
      if(!is_null($request['user_id']))
      {
        $orders->where('orders.user_id', '=', $request['user_id']);
      }
      if(!empty($request['user_id']))
      {
        $orders->where('orders.user_id', '=', $request['user_id']);
      }
      if(!empty($request['supplier_id']))
      {
        $orders->where('orders.supplier_name', '=', $request['supplier_id']);
      }
      if(!is_null($request['order_status']))
      {
        $orders->where('orders.order_status', '=', $request['order_status']);
      }
      if(!is_null($request['search']['value']))
      {
        $orders->orWhere('orders.order_number', 'LIKE', '%'. $request['search']['value'] .'%');
      }
      return Datatables::of($orders,$supplier)
        ->addColumn('created_at', function ($orders) {
          return Carbon::parse($orders->created_at)->format('d/m/Y');
           // return $orders->created_at;
        })
        ->addColumn('order_number', function ($orders) {
           return $orders->order_number;
        })
        ->addColumn('order_status', function ($orders) {
           return config('params.order_status')[$orders->order_status];
        })
        ->addColumn('supplier_name', function ($orders) use ($supplier) {
           return isset($supplier[$orders->supplier_name]) ? $supplier[$orders->supplier_name] : "";
        })
        ->addColumn('category', function ($orders) {
           return config('params.categories')[$orders->category_id];
        })
        ->addColumn('client_name', function ($orders) {
           return $orders->orderUser->f_name;
        })
        ->addColumn('tot_est_price', function ($orders) {
          if(!is_null($orders->est_price_currency))
          {
           return  config('params.currency')[$orders->est_price_currency] . $orders->tot_est_price;
          }
        })
        ->addColumn('action', function ($orders) use ($can_edit, $can_delete) {
           $html = '<div class="btn-group">';
           
           if($orders->order_status == '0'){
            $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $orders->id . '" class="btn btn-xs btn-secondary edit" title="Edit"><i class="fa fa-clock"></i> </a>';
           }elseif($orders->order_status == '1'){
            $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $orders->id . '" class="btn btn-xs btn-secondary edit" title="Edit"><i class="fas fa-shipping-fast"></i> </a>';
           }elseif($orders->order_status == '2'){
            $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $orders->id . '" class="btn btn-xs btn-secondary edit" title="Edit"><i class="fa fa-check"></i> </a>';
           }
           elseif($orders->order_status == '3'){
            $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $orders->id . '" class="btn btn-xs btn-secondary edit" title="Edit"><i class="fa fa-shopping-cart"></i></a>';
           }

           $html .= '<a href="' . \URL :: to('admin/order') .  '/' . $orders->id . '?next=' .$orders->next() .'"  id="' . $orders->id . '" class="btn btn-xs btn-success margin-r-5" title="View"><i class="fa fa-eye fa-fw"></i> </a>';
           $html .= '<a href="' . \URL :: to('admin/order') .  '/' . $orders->id . '/edit" id="' . $orders->id . '" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-edit"></i> </a>';

           $html .= '<a id="' . $orders->id . '" class="btn btn-xs btn-danger margin-r-5 delete" title="Delete"><i class="fa fa-times"></i> </a>';
           // $html .= '<a data-toggle="tooltip" ' . $can_delete . ' id="' . $orders->id . '" class="btn btn-xs btn-danger mr-1 delete" title="Delete"><i class="fa fa-trash"></i> </a>';
           $html .= '</div>';
           return $html;
        })
        ->rawColumns(['action', 'order_type', 'order_status', 'order_total', 'shipping_address_first_name'])
        ->addIndexColumn()
        ->setRowClass(function ($orders) {
              if($orders->order_status == 3){
                return 'confirm';
              }
          })
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
    public function show($id, Request $request)
    {
        $order = Order::find($id);
        $nextOrder = $order->next();
        $preOrder = $order->previous();
        return view('backend.admin.order.view',compact('order','nextOrder','preOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $haspermision = auth()->user()->can('user-edit');
        if ($request->ajax()) {
             $haspermision = auth()->user()->can('user-edit');
             if ($haspermision) {
                $order = Order::where('id', $id)->first();
                $roles = Role::all(); //Get all roles
                $view = View::make('backend.admin.order.edit', compact('order', 'roles'))->render();
                return response()->json(['html' => $view]);
             } else {
                abort(403, 'Sorry, you are not authorized to access the page');
             }
          }
        if ($haspermision) {
          $order = Order::where('id',$id)->first();
          $supplier = Supplier::all()->pluck('f_name','id')->toArray();
          $supplier[''] = 'Select Supplier';
          $metalType = config('params.metal_type');
          $metalColour = config('params.metal_colour');
          $currency = config('params.currency');
          return view('backend.admin.order.edit_order',compact('order','metalType','metalColour','supplier', 'currency'));
       } else {
          abort(403, 'Sorry, you are not authorized to access the page');
       }
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
        if ($request->ajax()) {
                
        Order::findOrFail($order->id);

        DB::beginTransaction();
        try {
           $order->order_status = $request->input('status');
           $order->status_notes = $request->input('status_notes');

           // $order->updated_by = Auth::user()->id;
           $order->save();

           DB::commit();
           return response()->json(['type' => 'success', 'message' => "Successfully Updated"]);

        } catch (\Exception $e) {
           DB::rollback();
           return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
        }
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->ajax()) {
         $haspermision = auth()->user()->can('user-delete');
         if ($haspermision) {
            $order = Order::findOrFail($id); //Get user with specified id
            $order->delete();
            return response()->json(['type' => 'success', 'message' => "Successfully Deleted"]);
         } else {
            abort(403, 'Sorry, you are not authorized to access the page');
         }
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
    }

    public function updateOrder(Request $request)
    {
      $order = Order::find($request->order_id);
      $order->supplier_name = $request->supplier_name;
      $order->metal_type = $request->metal_type;
      $order->metal_colour = $request->metal_colour;
      $order->size = $request->size;

      $order->weight = $request->weight;
      $order->shape = $request->shape;
      $order->carat = $request->carat;
      $order->cleaerty = $request->cleaerty;
      $order->gem = $request->gem;

      $order->quantity = $request->quantity;
      $order->est_price = $request->est_price;
      $order->est_price_currency = $request->est_currency;
      $order->tot_est_price = $request->tot_est_price;
      $order->admin_notes = $request->admin_notes;
      $order->save();
      return response()->json(['type' => 'success', 'message' => "Successfully Updated"]);
    }
}
