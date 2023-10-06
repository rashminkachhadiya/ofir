<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use View;
use DB;
use URL;
use App\Models\Role;
use App\Models\User;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.supplier.index');
    }

    public function getAll()
    {
        $can_edit = $can_delete = '';
      if (!auth()->user()->can('user-edit')) {
         $can_edit = "style='display:none;'";
      }
      if (!auth()->user()->can('user-delete')) {
         $can_delete = "style='display:none;'";
      }
      $users = Supplier::select('suppliers.*',DB::raw("COUNT(orders.id) as tot_order"))->leftjoin('orders','suppliers.id','=','orders.supplier_name')->groupBy('suppliers.id');
      return Datatables::of($users)
        // ->addColumn('file_path', function ($users) {
        //    return "<img src='" . asset($users->file_path) . "' class='img-thumbnail' width='50px'>";
        // })
        // ->addColumn('role', function ($user) {
        //    return '<label class="badge badge-secondary">' . ucfirst($user->roles->pluck('name')->implode(' , ')) . '</label>';
        // })
        // ->addColumn('last_seen', function ($user) {
        //    return Carbon::parse($user->last_seen)->diffForHumans();
        // })
        ->addColumn('tot_order', function ($users) {
           return '<a href="'. URL :: to('/admin/order'). "?supplier_id=" . $users->id .'">'. $users->tot_order .'</a>';
        })
        // ->addColumn('status', function ($users) {
        //    return $users->status ? '<label class="badge badge-success">Active</label>' : '<label class="badge badge-danger">Inactive</label>';
        // })
        ->addColumn('action', function ($user) use ($can_edit, $can_delete) {
           $html = '<div class="btn-group">';
           $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $user->id . '" class="btn btn-xs btn-info mr-1 edit" title="Edit"><i class="fa fa-edit"></i> </a>';
           if($user->tot_order == 0){
              $html .= '<a data-toggle="tooltip" ' . $can_delete . ' id="' . $user->id . '" class="btn btn-xs btn-danger mr-1 delete" title="Delete"><i class="fa fa-trash"></i> </a>';
           }
           $html .= '</div>';
           return $html;
        })
        ->rawColumns(['f_name','action','tot_order'])
        ->addIndexColumn()
        ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
         $haspermision = auth()->user()->can('user-create');
         if ($haspermision) {
            $roles = Role::all();
            $view = View::make('backend.admin.supplier.create',compact('roles'))->render();
            return response()->json(['html' => $view]);
         } else {
            abort(403, 'Sorry, you are not authorized to access the page');
         }
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
         // Setup the validator
         $rules = [
            'f_name' => 'required',
           'l_name' => 'required',
         ];

         $validator = Validator::make($request->all(), $rules);
         if ($validator->fails()) {
            return response()->json([
              'type' => 'error',
              'errors' => $validator->getMessageBag()->toArray()
            ]);
         } else {

            DB::beginTransaction();
            try {

               $user = new Supplier();
               $user->f_name = $request->input('f_name');
               $user->l_name = $request->input('l_name');
               // $user->username = $request->input('username');
               $user->email = $request->input('email');
               // $user->status = $request->input('status');
               // $user->exp_time = \DateTime::createFromFormat('d/m/Y H:i:s', $request->input('exp_date'));
               // $date1 = strtr($request->input('exp_date'), '/', '-');
               // $user->exp_time = date('Y-m-d H:i:s' , strtotime($date1));
               $user->mobile = $request->input('mobile');
               $user->address_1 = $request->input('address_1');
               $user->address_2 = $request->input('address_2');
               // $user->is_visible = $request->input('is_visible');
               // $user->stock_visible = $request->input('stock_visible');
               // $user->catalogue_store = json_encode($catalogueStore);  
               // $user->password = $request->password;
               $user->save();

               // // generate role
               // $roles = $request->input('roles');
               // if (isset($roles)) {
               //    $user->assignRole($roles);
               // }

               DB::commit();
               return response()->json(['type' => 'success', 'message' => "Successfully Created"]);

            } catch (\Exception $e) {
               DB::rollback();
               return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
            }

         }
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
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
    public function edit(Request $request,$id)
    {
         if ($request->ajax()) {
         $haspermision = auth()->user()->can('user-edit');
         if ($haspermision) {
            $user = Supplier::where('id', $id)->first();
            // $roles = Role::all(); //Get all roles
            $view = View::make('backend.admin.supplier.edit', compact('user'))->render();
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
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
         // Setup the validator
         $rules = [
            'f_name' => 'required',
           'l_name' => 'required',
         ];

         $validator = Validator::make($request->all(), $rules);
         if ($validator->fails()) {
            return response()->json([
              'type' => 'error',
              'errors' => $validator->getMessageBag()->toArray()
            ]);
         } else {

            DB::beginTransaction();
            try {

               $user = Supplier::find($id);
               $user->f_name = $request->input('f_name');
               $user->l_name = $request->input('l_name');
               // $user->username = $request->input('username');
               $user->email = $request->input('email');
               // $user->status = $request->input('status');
               // $user->exp_time = \DateTime::createFromFormat('d/m/Y H:i:s', $request->input('exp_date'));
               // $date1 = strtr($request->input('exp_date'), '/', '-');
               // $user->exp_time = date('Y-m-d H:i:s' , strtotime($date1));
               $user->mobile = $request->input('mobile');
               $user->address_1 = $request->input('address_1');
               $user->address_2 = $request->input('address_2');
               // $user->is_visible = $request->input('is_visible');
               // $user->stock_visible = $request->input('stock_visible');
               // $user->catalogue_store = json_encode($catalogueStore);  
               // $user->password = $request->password;
               $user->save();

               // // generate role
               // $roles = $request->input('roles');
               // if (isset($roles)) {
               //    $user->assignRole($roles);
               // }

               DB::commit();
               return response()->json(['type' => 'success', 'message' => "Successfully Created"]);

            } catch (\Exception $e) {
               DB::rollback();
               return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
            }

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
            $user = Supplier::findOrFail($id); //Get user with specified id
            $user->delete();
            return response()->json(['type' => 'success', 'message' => "Successfully Deleted"]);
         } else {
            abort(403, 'Sorry, you are not authorized to access the page');
         }
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
    }
}
