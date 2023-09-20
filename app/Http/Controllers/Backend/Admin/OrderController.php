<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Role;
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
        return view('backend.admin.order.index');
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
      if(!empty($request['user_id']))
      {
        $orders = Order::where('user_id',$request['user_id'])->get(); 
        $return = "style='display:none;'";
        $status = "style='display:none;'";

        // $invoices->;
      }else{
        $orders = Order::select('*');
        if(!empty($request['param']))
        {
          $orders->where('orders.created_at', '>=', Carbon::yesterday());
          $orders->orWhere('orders.created_at', '=',now());  
        }
        $orders->get();
      }
      return Datatables::of($orders)
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
        ->addColumn('category', function ($orders) {
           return config('params.categories')[$orders->category_id];
        })
        ->addColumn('client_name', function ($orders) {
           return $orders->orderUser->username;
        })
        ->addColumn('action', function ($orders) use ($can_edit, $can_delete) {
           $html = '<div class="btn-group">';
           $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $orders->id . '" class="btn btn-xs btn-info edit" title="Edit"><i class="fa fa-edit"></i> </a>';
           $html .= '<a href="' . \URL :: to('admin/order') .  '/' . $orders->id . '"  id="' . $orders->id . '" class="btn btn-xs btn-success margin-r-5" title="View"><i class="fa fa-eye fa-fw"></i> </a>';
           // $html .= '<a data-toggle="tooltip" ' . $can_delete . ' id="' . $orders->id . '" class="btn btn-xs btn-danger mr-1 delete" title="Delete"><i class="fa fa-trash"></i> </a>';
           $html .= '</div>';
           return $html;
        })
        ->rawColumns(['action', 'order_type', 'order_status', 'order_total', 'shipping_address_first_name'])
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
    public function show($id, Request $request)
    {
        $order = Order::find($id);
        return view('backend.admin.order.view',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
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
          } else {
             return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
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
    public function destroy($id)
    {
        //
    }
}
