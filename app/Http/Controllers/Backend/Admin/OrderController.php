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
use PDF;
use URL;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $users = User::pluck('f_name','id')->toArray();
        $suppliers = Supplier::pluck('f_name','id')->toArray();

        $users[''] = 'All Users';
        $suppliers[''] = 'All Suppliers';

        return view('backend.admin.order.index',compact('orderStatus','users','suppliers'));
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

      if(!is_null($request['ids']))
      {
        $id = explode(',',$request->ids);
        $orders->whereIn('orders.id', $id);
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
        $orders->whereIn('orders.order_status', $request['order_status']);
      }
      if(!is_null($request['ref']))
      {
        $orders->orwhere('orders.ref', 'LIKE','%'. $request['ref'] .'%');
      }
      if(!is_null($request['search']['value']))
      {
        $orders->orWhere('orders.order_number', 'LIKE', '%'. $request['search']['value'] .'%');
      }
      if(!is_null($request['param']))
      {
        $orders->where('orders.created_at', '>=', Carbon::yesterday());
        $orders->orWhere('orders.created_at', '=',now());  
      }
      $orders->orderBy('created_at','DESC');
      return Datatables::of($orders,$supplier,$request)
        ->addColumn('created_at', function ($orders) {
          return Carbon::parse($orders->created_at)->format('d/m/Y');
           // return $orders->created_at;
        })
        ->addColumn('image', function ($orders) {
            return view('backend.admin.order.image', ['orders'=>$orders]) ;
           // return $orders->created_at;
        })
        ->addColumn('order_number', function ($orders) {
           return $orders->order_number;
        })
        ->addColumn('order_status', function ($orders) {
          if($orders->order_status == 3)
          {
            return "<div style='color:green;'>".config('params.order_status')[$orders->order_status]."</div>";
          }else{
           return config('params.order_status')[$orders->order_status]; 
          }
        })
        ->addColumn('supplier_name', function ($orders) use ($supplier) {
          $checked = ($orders->receive_supplier == 1) ? 'checked' : '';
           return isset($supplier[$orders->supplier_name]) && $orders->supplier_name != null ? '<div class="d-flex"><div><a data-toggle="tooltip" id="' . $orders->id . '" class="btn supplier-edit" title="Edit">'.$supplier[$orders->supplier_name].'</a></div><div><input style="width:30px; height:23px;" class="" type="checkbox" value="'.$orders->id.'" onchange="receiveSupplier(this)" name="id" '.$checked.'/></div>' : "";
        })

        ->addColumn('category', function ($orders) {
           return config('params.categories')[$orders->category_id];
        })
        ->addColumn('client_name', function ($orders) {
           return $orders->orderUser->f_name;
        })
        ->addColumn('metal_colour', function ($orders) {
           if(!is_null($orders->metal_colour))
            {
               return config('params.metal_colour')[$orders->metal_colour];
            }
        })
        ->addColumn('metal_type', function ($orders) {
           if(!is_null($orders->metal_type))
            {
               return config('params.metal_type')[$orders->metal_type];
            }
        })
        ->addColumn('tot_est_price', function ($orders) {
          if(!is_null($orders->est_price_currency))
          {
           return  config('params.currency')[$orders->est_price_currency] . $orders->tot_est_price;
          }
        })
        ->addColumn('action', function ($orders) use ($can_edit, $can_delete, $request) {
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
           }elseif($orders->order_status == '4'){
            $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $orders->id . '" class="btn btn-xs btn-secondary edit" title="re-open"><i class="fa fa-folder-open"></i></a>';
           }

           $html .= '<a href="' . \URL :: to('admin/order') .  '/' . $orders->id . '?next=' .$orders->next() .'"  id="' . $orders->id . '" class="btn btn-xs btn-success margin-r-5" title="View" target="_blank"><i class="fa fa-eye fa-fw"></i> </a>';
           $html .= '<a href="' . \URL :: to('admin/order') .  '/' . $orders->id . '/edit" id="' . $orders->id . '" target="_blank" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-edit"></i> </a>';

           $html .= '<a id="' . $orders->id . '" class="btn btn-xs btn-danger margin-r-5 delete" title="Delete"><i class="fa fa-times"></i> </a>';
            
           // $html .= '<a data-toggle="tooltip" ' . $can_delete . ' id="' . $orders->id . '" class="btn btn-xs btn-danger mr-1 delete" title="Delete"><i class="fa fa-trash"></i> </a>';
           $html .= '</div>';
           return $html;
        })
        ->addColumn('checkbox', function ($orders) {
          return '<div class="btn-group"><div class="form-check form-check-custom form-check-sm">
                                  <input style="width:30px; height:23px;" class=" child-checkbox me-9" type="checkbox" value="'.$orders->id.'" name="ids[]"/>
                               </div></div>';
        })
        ->rawColumns(['action', 'order_type', 'image','order_status', 'order_total', 'shipping_address_first_name','checkbox','metal_colour','supplier_name'])
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
        $nextOrder = $order->next();
        $preOrder = $order->previous();
        $supplier = Supplier::pluck('f_name','id')->toArray();
        return view('backend.admin.order.view',compact('order','nextOrder','preOrder','supplier'));
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
      $order->order_status = $request->status;
      $order->ref = $request->ref;
      $order->size = $request->size;

      $order->weight = $request->weight;
      $order->shape = $request->shape;
      $order->carat = $request->carat;
      $order->colour = $request->gem_colour;
      $order->cleaerty = $request->cleaerty;
      $order->pcs = $request->pcs;
      $order->gem = $request->gem;

      $order->quantity = $request->quantity;
      $order->est_price = $request->est_price;
      $order->est_price_currency = $request->est_currency;
      $order->tot_est_price = $request->tot_est_price;
      $order->admin_notes = $request->admin_notes;
      $order->save();
      return response()->json(['type' => 'success', 'message' => "Successfully Updated"]);
    }

    public function pdfDownload(Request $request)
    {
      if(isset($request->id) && !is_null($request->id))
      {
          $ids[] = $request->id;
      }else if(isset($request->ids)){
          $ids = explode(', ',$request->ids);
      }
      $orders = Order::whereIn('id',$ids)->get();
      $supplier = Supplier::all()->pluck('f_name','id')->toArray();
      return view('frontend.myaccount.all_order_view',compact('orders','supplier'));
      $mpdf = new \Mpdf\Mpdf();
      $html = view('backend.admin.order.pdf_supplier',compact('orders','supplier'))->render();
      $mpdf->autoScriptToLang = true;
      $mpdf->autoLangToFont = true;
      $mpdf->WriteHTML($html);
      // $pdf = PDF::loadView('backend.admin.order.pdf_supplier',compact('orders','supplier'));
      // $mpdf->autoLangToFont = true;
      if($request->flag == 'view')
      {
        return $mpdf->Output();
      }else{
        return $mpdf->Output('supplier.pdf','D');
      }
    }

    public function receiveSupplier(Request $request)
    {
        $id = $request->order_id;
        $order = Order::find($id);
        if($order->receive_supplier == 0)
        {
            $order->receive_supplier = 1;
        }else{
            $order->receive_supplier = 0;
        }
        $order->save();
        return true;
    }

    public function updateSupplierInformation(Request $request)
    {
        $id = $request->id;
        $order = Order::where('id', $id)->first();
        $roles = Role::all(); //Get all roles
        $view = View::make('backend.admin.order.supplier_edit', compact('order', 'roles'))->render();
        return response()->json(['html' => $view]);
    }

    public function receiveSupplierSave(Request $request)
    {
      if ($request->ajax()) {
                
        $order = Order::findOrFail($request->id);

        DB::beginTransaction();
        try {
            $order->su_metal_type = $request->su_metal_type;
            $order->su_metal_colour = $request->su_metal_colour;
            $order->su_weight = $request->su_weight;
            $order->su_size = $request->su_size;
            $order->su_shape = $request->su_shape;
            $order->su_carat = $request->su_carat;
            $order->su_colour = $request->su_gem_colour;
            $order->su_cleaerty = $request->su_cleaerty;
            $order->su_pcs = $request->su_pcs;
            $order->su_gem = $request->su_gem;
            $order->su_quantity = $request->su_quantity;
            $order->su_admin_notes = $request->su_admin_notes;
            $order->receive_supplier = $request->receive_supplier;

            $order->su_est_currency = $request->su_est_currency;
            $order->su_est_price = $request->su_est_price;
            $order->su_tot_est_price = $request->su_tot_est_price;
            $order->su_carat_price = $request->su_carat_price;
            $order->tot_su_carat_price = $request->tot_su_carat_price;

            $order->su_pcs_price = $request->su_pcs_price;
            $order->tot_su_pcs_price = $request->tot_su_pcs_price;

            $order->su_work = $request->su_work;
            $order->su_final_total = $request->su_final_total;

            $order->su_shipping = $request->su_shipping;
            $order->su_other_1 = $request->su_other_1;
            $order->su_other_2 = $request->su_other_2;
            $order->d_price = $request->d_price;
            $order->tot_d_price = $request->tot_d_price;
            $order->p_price = $request->p_price;
            $order->tot_p_price = $request->tot_p_price;

            $order->d_weight_price = $request->d_weight_price;
            $order->d_qty_price = $request->d_qty_price;
            $order->p_weight_price = $request->p_weight_price;
            $order->p_qty_price = $request->p_qty_price;



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

    public function getCustomer(Request $request)
    {
        $item = User::where('f_name','LIKE',"%".$request['term']['term']."%")
                    ->get()->toArray();

        return response()->json(['data' => $item]);
    }

    public function excelDownload(Request $request) 
    {
      if(isset($request->id) && !is_null($request->id))
      {
          $ids[] = $request->id;
      }else if(isset($request->ids)){
          $ids = explode(', ',$request->ids);
      }

      return Excel::download(new OrderExport($ids), 'order.xlsx');
    }
}
