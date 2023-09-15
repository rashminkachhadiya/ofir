<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use App\Models\Item;
use DB;
use URL;
use Carbon\Carbon;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('backend.admin.catalogue.index');
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

      $items = Item::all();
      return Datatables::of($items)
        ->addColumn('created_at', function ($orders) {
          return Carbon::parse($orders->created_at)->format('d/m/Y');
        })
        ->addColumn('catalogue_id', function ($items) {
           return config('params.catalogue')[$items->catalogue_id];
        })
        ->addColumn('sub_catalogue_id', function ($items) {
           return config('params.'.$items->catalogue_id)[$items->sub_catalogue_id];
        })
        ->addColumn('action', function ($items) use ($can_edit, $can_delete) {
           $html = '<div class="btn-group">';
           $html .= '<a href="' . \URL :: to('admin/catalogue') .  '/' . $items->id . '/edit"  id="' . $items->id . '" class="btn btn-xs btn-info margin-r-5" title="View"><i class="fa fa-edit"></i> </a>';
           // $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $items->id . '" class="btn btn-xs btn-info mr-1 edit" title="Edit"><i class="fa fa-edit"></i> </a>';
           $html .= '<a data-toggle="tooltip" ' . $can_delete . ' id="' . $items->id . '" class="btn btn-xs btn-danger mr-1 delete" title="Delete"><i class="fa fa-trash"></i> </a>';
           $html .= '</div>';
           return $html;
        })
        ->rawColumns(['action', 'category_id', 'sub_catalogue_id', 'item_title'])
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
        $haspermision = auth()->user()->can('user-create');
       if ($haspermision) {
            $catalogues = config('params.catalogue');
            $catalogues[''] = 'Select Catalogue';
          return view('backend.admin.catalogue.create',compact('catalogues'));
       } else {
          abort(403, 'Sorry, you are not authorized to access the page');
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
           'catalogue_id' => 'required',
           'sub_catalogue_id' => 'required',
           'item_title' => 'required|max:255',
           'photo_1' => 'required',
         ];

         $validator = Validator::make($request->all(), $rules);
         if ($validator->fails()) {
            return response()->json([
              'type' => 'error',
              'errors' => $validator->getMessageBag()->toArray()
            ]);
         } else {

            if ($request->hasFile('photo_1')) {
               if ($request->file('photo_1')->isValid()) {
                  $destinationPath = public_path('assets/images/items/');
                  $extension = $request->file('photo_1')->getClientOriginalExtension();
                  $fileName = time() . '.' . $extension;
                  $file_path_1 = 'assets/images/items/' . $fileName;
                  $request->file('photo_1')->move($destinationPath, $fileName);
               } else {
                  return response()->json([
                    'type' => 'error',
                    'message' => "<div class='alert alert-warning'>Please! File is not valid</div>"
                  ]);
               }
            }

            DB::beginTransaction();
            try {

               $item = new Item();
               $item->catalogue_id = $request->input('catalogue_id');
               $item->sub_catalogue_id = $request->input('sub_catalogue_id');
               $item->item_title = $request->input('item_title');
               $item->description = $request->input('description');
               if(isset($file_path_1)){
                $item->photo = $file_path_1;                
               }
               $item->is_allcollection = $request->input('is_allcollection');
               $item->is_available = $request->input('is_available');
               $item->created_by = Auth::user()->id;
               $item->updated_by = Auth::user()->id;
               $item->save();

               DB::commit();
               $returnURL = URL::to('/admin/catalogue') . '/' . $item->id . '/edit';
               return response()->json(['type' => 'success', 'message' => "Successfully Created", 'returnURL' => $returnURL]);

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
    public function edit($id, Request $request)
    {
        $item = Item::where('id', $id)->first();
        $catalogues = config('params.catalogue');
        $catalogues[''] = 'Select Catalogue';
        $subCatalogue = config('params.'.$item->catalogue_id);
        return view('backend.admin.catalogue.edit',compact('item','catalogues','subCatalogue'));
       //  $haspermision = auth()->user()->can('user-edit');
       // if ($haspermision) {
       //    $item = Item::where('id', $id)->first();
       //    if($request->tab == 'tab-size-stock')
       //    {
       //      $itemStock = ItemStock::where('item_id',$id)->get();
       //      $view = View::make('backend.admin.catelogue.tab_size_stock', compact('item', 'itemStock','roles'))->render();
       //      return response()->json(['html' => $view]);
       //      // return view('backend.admin.catelogue.tab_size_stock',compact('item','itemStock','roles'));
       //    }else{
       //      $categories = Category::pluck('title','id')->toArray();
       //      $categories[''] = 'Select Category';
       //      return view('backend.admin.catelogue.edit',compact('item','categories'));
       //    }
       // } else {
       //    abort(403, 'Sorry, you are not authorized to access the page');
       // }
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
        
        $item = Item::find($id);
        
         $rules = [
           'catalogue_id' => 'required',
           'sub_catalogue_id' => 'required',
           'item_title' => 'required|max:255',
         ];

         $validator = Validator::make($request->all(), $rules);
         if ($validator->fails()) {
            return response()->json([
              'type' => 'error',
              'errors' => $validator->getMessageBag()->toArray()
            ]);
         } else {
              
            if ($request->hasFile('photo_1')) {
               if ($request->file('photo_1')->isValid()) {
                  $destinationPath = public_path('assets/images/items/');
                  $extension = $request->file('photo_1')->getClientOriginalExtension();
                  $fileName = time() . '1' . '.' . $extension;
                  $file_path_1 = 'assets/images/items/' . $fileName;
                  $request->file('photo_1')->move($destinationPath, $fileName);
               } else {
                  return response()->json([
                    'type' => 'error',
                    'message' => "<div class='alert alert-warning'>Please! File is not valid</div>"
                  ]);
               }
            }

            DB::beginTransaction();
            try {
               $item->catalogue_id = $request->input('catalogue_id');
               $item->sub_catalogue_id = $request->input('sub_catalogue_id');
               $item->item_title = $request->input('item_title');
               $item->description = $request->input('description');
               if(isset($file_path_1)){
                $item->photo = $file_path_1;                
               }
               $item->is_allcollection = $request->input('is_allcollection');
               $item->is_available = $request->input('is_available');
               $item->created_by = Auth::user()->id;
               $item->updated_by = Auth::user()->id;
               $item->save();

               DB::commit();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->ajax()) {
        $haspermision = auth()->user()->can('user-delete');
        if ($haspermision) {
            $item = Item::find($id); //Get user with specified id
            $item->delete();
            return response()->json(['type' => 'success', 'message' => "Successfully Deleted"]);
        } else {
            abort(403, 'Sorry, you are not authorized to access the page');
        }
          } else {
             return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
          }
    }

    public function getSubCatalogue(Request $request)
    {
        $subCatalogue = config('params.'.$request->catalogue_id);
        return response()->json(['data' => $subCatalogue]);
    }
}
