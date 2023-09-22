<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use View;
use DB;
use URL;

class UserController extends Controller
{
   /**
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('backend.admin.user.index');
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
      $users = User::select('users.*',DB::raw("COUNT(orders.id) as tot_order"))->leftjoin('orders','users.id','=','orders.user_id')->groupBy('users.id');
      return Datatables::of($users)
        ->addColumn('file_path', function ($users) {
           return "<img src='" . asset($users->file_path) . "' class='img-thumbnail' width='50px'>";
        })
        ->addColumn('role', function ($user) {
           return '<label class="badge badge-secondary">' . ucfirst($user->roles->pluck('name')->implode(' , ')) . '</label>';
        })
        ->addColumn('last_seen', function ($user) {
           return Carbon::parse($user->last_seen)->diffForHumans();
        })
        ->addColumn('tot_order', function ($users) {
           return '<a href="'. URL :: to('/admin/order'). "?user_id=" . $users->id .'">'. $users->tot_order .'</a>';
        })
        ->addColumn('status', function ($users) {
           return $users->status ? '<label class="badge badge-success">Active</label>' : '<label class="badge badge-danger">Inactive</label>';
        })
        ->addColumn('action', function ($user) use ($can_edit, $can_delete) {
           $html = '<div class="btn-group">';
           $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $user->id . '" class="btn btn-xs btn-info mr-1 edit" title="Edit"><i class="fa fa-edit"></i> </a>';
           if($user->tot_order == 0){
              $html .= '<a data-toggle="tooltip" ' . $can_delete . ' id="' . $user->id . '" class="btn btn-xs btn-danger mr-1 delete" title="Delete"><i class="fa fa-trash"></i> </a>';
           }
           $html .= '</div>';
           return $html;
        })
        ->rawColumns(['action', 'file_path', 'status', 'role', 'last_seen','tot_order'])
        ->addIndexColumn()
        ->make(true);
   }


   /**
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function create(Request $request)
   {
      if ($request->ajax()) {
         $haspermision = auth()->user()->can('user-create');
         if ($haspermision) {
            $roles = Role::all();
            $view = View::make('backend.admin.user.create', compact('roles'))->render();
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
    * @param  \Illuminate\Http\Request $request
    *
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

            $file_path = "assets/images/users/default.png";

            if ($request->hasFile('photo')) {
               if ($request->file('photo')->isValid()) {
                  $destinationPath = public_path('assets/images/users/');
                  $extension = $request->file('photo')->getClientOriginalExtension();
                  $fileName = time() . '.' . $extension;
                  $file_path = 'assets/images/users/' . $fileName;
                  $request->file('photo')->move($destinationPath, $fileName);
               } else {
                  return response()->json([
                    'type' => 'error',
                    'message' => "<div class='alert alert-warning'>Please! File is not valid</div>"
                  ]);
               }
            }

            $catalogueStore = [
          '0' => '0',
          '1' => '0',
          '2' => '0',
          '3' => '0',
          '4' => '0',
          '5' => '0',
          '6' => '0',
          '7' => '0',
          '8' => '0',
          '9' => '0',
          '10' => '0',
          '11' => '0',
        ];

        if(!is_null($request->input('catalogue_store')))
        {
          foreach ($request->input('catalogue_store') as $key => $value) {
            $catalogueStore[$key] = $value;
          }
        }
            DB::beginTransaction();
            try {

               $user = new User();
               $user->f_name = $request->input('f_name');
               $user->l_name = $request->input('l_name');
               $user->username = $request->input('username');
               $user->email = $request->input('email');
               $user->status = $request->input('status');
               // $user->exp_time = \DateTime::createFromFormat('d/m/Y H:i:s', $request->input('exp_date'));
               $date1 = strtr($request->input('exp_date'), '/', '-');
               $user->exp_time = date('Y-m-d H:i:s' , strtotime($date1));
               $user->mobile = $request->input('mobile');
               $user->address_1 = $request->input('address_1');
               $user->address_2 = $request->input('address_2');
               $user->is_approved = $request->input('is_approved');
               $user->is_visible = $request->input('is_visible');
               $user->catalogue_store = json_encode($catalogueStore);  
               $user->password = $request->password;
               $user->save();

               // generate role
               $roles = $request->input('roles');
               if (isset($roles)) {
                  $user->assignRole($roles);
               }

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
    * @param  int $id
    *
    * @return \Illuminate\Http\Response
    */
   public function show($id, Request $request)
   {
      if ($request->ajax()) {
         $user = User::findOrFail($id);
         $view = View::make('backend.admin.user.view', compact('user'))->render();
         return response()->json(['html' => $view]);
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int $id
    *
    * @return \Illuminate\Http\Response
    */
   public function edit($id, Request $request)
   {
      if ($request->ajax()) {
         $haspermision = auth()->user()->can('user-edit');
         if ($haspermision) {
            $user = User::with('roles')->where('id', $id)->first();
            $roles = Role::all(); //Get all roles
            $view = View::make('backend.admin.user.edit', compact('user', 'roles'))->render();
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
    * @param  \Illuminate\Http\Request $request
    * @param  int $id
    *
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, User $user)
   {
      if ($request->ajax()) {
        $catalogueStore = [
          '0' => '0',
          '1' => '0',
          '2' => '0',
          '3' => '0',
          '4' => '0',
          '5' => '0',
          '6' => '0',
          '7' => '0',
          '8' => '0',
          '9' => '0',
          '10' => '0',
          '11' => '0',
        ];

        if(!is_null($request->input('catalogue_store')))
        {
          foreach ($request->input('catalogue_store') as $key => $value) {
            $catalogueStore[$key] = $value;
          }
        }
         User::findOrFail($user->id);

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
               $user->f_name = $request->input('f_name');
               $user->l_name = $request->input('l_name');
               $user->username = $request->input('username');
               if(!is_null($request->input('email')))
               {
                $user->email = $request->input('email');                
               }
               $user->status = $request->input('status');
               // $user->exp_time = \DateTime::createFromFormat('d/m/Y H:i:s', $request->input('exp_date'));
               $date1 = strtr($request->input('exp_date'), '/', '-');
               $user->exp_time = date('Y-m-d H:i:s' , strtotime($date1));
               $user->mobile = $request->input('mobile');
               $user->address_1 = $request->input('address_1');
               $user->address_2 = $request->input('address_2');
               $user->is_approved = $request->input('is_approved');
               $user->is_visible = $request->input('is_visible');
               $user->catalogue_store = json_encode($catalogueStore);  
               $user->password = $request->password;
               $user->save();

               DB::commit();
              if(!is_null($user->email))
              {
               \Mail::to($user->email)->send(new \App\Mail\SendCredentialMail($user));
              }
               return response()->json(['type' => 'success', 'message' => "Successfully Updated"]);

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
    * @param  int $id
    *
    * @return \Illuminate\Http\Response
    */
   public function destroy($id, Request $request)
   {
      if ($request->ajax()) {
         $haspermision = auth()->user()->can('user-delete');
         if ($haspermision) {
            $user = User::findOrFail($id); //Get user with specified id
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
