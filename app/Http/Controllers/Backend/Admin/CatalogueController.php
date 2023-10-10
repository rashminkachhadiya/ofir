<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use App\Models\Item;
use App\Models\ItemStock;
use DB;
use URL;
use Carbon\Carbon;
use View;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $catalog = 1;
      //   $allCatalogue = Item::where('catalogue_id',0)->where('sub_catalogue_id',0)->get();
      //   foreach ($allCatalogue as $itemCat) {
      //     $itemCat->sku = 'CARG'.$number = sprintf('%03d',$catalog);
      //     $itemCat->save();
      //     $catalog++;
      //   }
      //   die;
      //   echo "<pre>";
      //   print_r($allCatalogue);
      //   die;
        $catalogues = config('params.catalogue');
        $catalogues[''] = 'All Catalogue';
        $subCatalogue = config('params.1');
        $subCatalogue[''] = 'All Sub Catalogue';
        $inStock = config('params.in_stock');
        $inStock[''] = 'All Stock';
        return view('backend.admin.catalogue.index',compact('catalogues', 'subCatalogue','inStock'));
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

      $items = Item::select('items.*', DB::raw("SUM(CASE WHEN item_stocks.item_status IS NULL THEN item_stocks.qty ELSE 0 END) as tot_qty"), DB::raw("SUM(CASE WHEN item_stocks.item_status IS NULL THEN item_stocks.gram ELSE 0 END) as tot_gram"), DB::raw("SUM(CASE WHEN item_stocks.item_status IS NULL THEN item_stocks.ct ELSE 0 END) as tot_ct"))->leftjoin('item_stocks','items.id','=','item_stocks.item_id')->groupBy('items.id');
      if(!is_null($request['catalogue_id']))
        {
          $items->where('items.catalogue_id', '=', $request['catalogue_id']);
        }
      if(!is_null($request['sub_catalogue_id']))
        {
          $items->where('items.sub_catalogue_id', '=', $request['sub_catalogue_id']);
        }
        if(!is_null($request['in_stock']))
        {
          if($request['in_stock'] == 1)
          {
            $items->having('tot_qty','>',0);
          }elseif($request['in_stock'] == 2){
            $items->where('item_stocks.item_status','=','0');
          }else{
            $items->having('tot_qty','=',0);
          }
        }
      return Datatables::of($items)
        ->addColumn('created_at', function ($orders) {
          return Carbon::parse($orders->created_at)->format('d/m/Y');
        })
        ->addColumn('catalogue_id', function ($items) {
           return config('params.catalogue')[$items->catalogue_id];
        })
        ->addColumn('metal_colour', function ($items) {
            if(!is_null($items->metal_colour))
            {
               return config('params.metal_colour')[$items->metal_colour];
            }
        })
        ->addColumn('metal_type', function ($items) {
            if(!is_null($items->metal_type))
            {
               return config('params.metal_type')[$items->metal_type];
            }
        })
        ->addColumn('sub_catalogue_id', function ($items) {
           return config('params.'.$items->catalogue_id)[$items->sub_catalogue_id];
        })
        ->addColumn('is_active', function ($items) {
           return $items->is_active ? '<label class="badge badge-success">Active</label>' : '<label class="badge badge-danger">Inactive</label>';
        })
        ->addColumn('tot_qty', function ($items) {
          return number_format((float)$items->tot_qty, 0, '.', '');
        })
        ->addColumn('action', function ($items) use ($can_edit, $can_delete) {
           $html = '<div class="btn-group">';
           $html .= '<a href="' . \URL :: to('admin/catalogue') .  '/' . $items->id . '/edit"  id="' . $items->id . '" class="btn btn-xs btn-info margin-r-5" title="View"><i class="fa fa-edit"></i></a>';
           // $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $items->id . '" class="btn btn-xs btn-info mr-1 edit" title="Edit"><i class="fa fa-edit"></i> </a>';
           $html .= '<a data-toggle="tooltip" ' . $can_delete . ' id="' . $items->id . '" class="btn btn-xs btn-danger mr-1 delete" title="Delete"><i class="fa fa-trash"></i> </a>';
           $html .= '<a data-toggle="tooltip" ' . $can_delete . ' id="' . $items->id . '" class="btn btn-xs btn-primary mr-1 copy-product" title="Copy Product"><i class="fa fa-plus"></i> </a>';
           $html .= '</div>';
           return $html;
        })
        ->rawColumns(['action', 'category_id', 'sub_catalogue_id', 'item_title','is_active','tot_qty'])
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
            $subCatalogue = config('params.1');
            $subCatalogue[''] = 'Select Sub Catalogue';
          return view('backend.admin.catalogue.create',compact('catalogues','subCatalogue'));
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

            if ($request->hasFile('photo_2')) {
               if ($request->file('photo_2')->isValid()) {
                  $destinationPath = public_path('assets/images/items/');
                  $extension = $request->file('photo_2')->getClientOriginalExtension();
                  $fileName = time() . '2' . '.' . $extension;
                  $file_path_2 = 'assets/images/items/' . $fileName;
                  $request->file('photo_2')->move($destinationPath, $fileName);
               } else {
                  return response()->json([
                    'type' => 'error',
                    'message' => "<div class='alert alert-warning'>Please! File is not valid</div>"
                  ]);
               }
            }

            if ($request->hasFile('photo_3')) {
               if ($request->file('photo_3')->isValid()) {
                  $destinationPath = public_path('assets/images/items/');
                  $extension = $request->file('photo_3')->getClientOriginalExtension();
                  $fileName = time() . '3' . '.' . $extension;
                  $file_path_3 = 'assets/images/items/' . $fileName;
                  $request->file('photo_3')->move($destinationPath, $fileName);
               } else {
                  return response()->json([
                    'type' => 'error',
                    'message' => "<div class='alert alert-warning'>Please! File is not valid</div>"
                  ]);
               }
            }

            if ($request->hasFile('photo_4')) {
               if ($request->file('photo_4')->isValid()) {
                  $destinationPath = public_path('assets/images/items/');
                  $extension = $request->file('photo_4')->getClientOriginalExtension();
                  $fileName = time() . '4' . '.' . $extension;
                  $file_path_4 = 'assets/images/items/' . $fileName;
                  $request->file('photo_4')->move($destinationPath, $fileName);
               } else {
                  return response()->json([
                    'type' => 'error',
                    'message' => "<div class='alert alert-warning'>Please! File is not valid</div>"
                  ]);
               }
            }

            DB::beginTransaction();
            try {
              foreach($request->input('catalogue_id') as $item_store){
                $item = new Item();
               $item->catalogue_id = $item_store;
               $item->sku = $request->input('sku');
               $item->item_title_gram = $request->input('item_title_gram');
               $item->sub_catalogue_id = $request->input('sub_catalogue_id');
               $item->item_title = $request->input('item_title');
               $item->description = $request->input('description');
               if(isset($file_path_1)){
                $item->photo = $file_path_1;                
               }
               if(isset($file_path_2)){
                $item->photo_2 = $file_path_2;                
               }
               if(isset($file_path_3)){
                $item->photo_3 = $file_path_3;                
               }
               if(isset($file_path_4)){
                $item->photo_4 = $file_path_4;                
               }
               $item->is_allcollection = $request->input('is_allcollection');
               $item->is_available = $request->input('is_available');
               $item->size = $request->input('size');
               $item->metal_colour = $request->input('metal_colour');
               $item->metal_type = $request->input('metal_type');

               $item->weight = $request->input('weight');
               $item->gem = $request->input('gem');
               $item->shape = $request->input('shape');
               $item->carat = $request->input('carat');
               $item->colour = $request->input('gem_colour');
               $item->cleaerty = $request->input('cleaerty');
               $item->pcs = $request->input('pcs');

               $item->is_active = $request->input('is_active');
               $item->cost_fee = $request->input('cost_fee');
               $item->price_usd = $request->input('price_usd');
               $item->price_pound = $request->input('price_pound');
               $item->price_eur = $request->input('price_eur');
               $item->price_notes = $request->input('price_notes');
               // $item->in_stock = $request->input('in_stock');

               $item->setting = $request->input('setting');
               $item->diamond = $request->input('diamond');
               $item->loss = $request->input('loss');
               $item->diamond_note = $request->input('diamond_note');

               $item->created_by = Auth::user()->id;
               $item->updated_by = Auth::user()->id;
               $item->save();
              }

              if(!empty($request->new_stock))
              {
                  foreach ($request->new_stock as $key => $value) {
                        $itemStock = new ItemStock();
                        $itemStock->item_id = $item->id;
                        $itemStock->item_code = $request->new_code[$key];
                        $itemStock->qty = $value;
                        $itemStock->gram = $request->new_gram[$key];
                        $itemStock->ct = $request->new_ct[$key];
                        $itemStock->pieces = $request->new_pieces[$key];
                        $itemStock->size = $request->new_size[$key];
                        $itemStock->total_gram = $value * $request->new_gram[$key];
                        $itemStock->total_ct = $value * $request->new_ct[$key];
                        $itemStock->notes = $request->new_notes[$key];
                        $itemStock->stocknotes = $request->new_stocknotes[$key];
                        $itemStock->item_status = $request->new_item_status[$key];
                        $itemStock->date = !is_null($request->new_date[$key]) ? date('Y-m-d H:i:s' , strtotime($request->new_date[$key])) : NULL;
                        $itemStock->save();
                  }
              }

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
        $itemStock = ItemStock::where('item_id',$id)->get();
        return view('backend.admin.catalogue.edit',compact('item','catalogues','subCatalogue','itemStock'));
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

            if ($request->hasFile('photo_2')) {
               if ($request->file('photo_2')->isValid()) {
                  $destinationPath = public_path('assets/images/items/');
                  $extension = $request->file('photo_2')->getClientOriginalExtension();
                  $fileName = time() . '2' . '.' . $extension;
                  $file_path_2 = 'assets/images/items/' . $fileName;
                  $request->file('photo_2')->move($destinationPath, $fileName);
               } else {
                  return response()->json([
                    'type' => 'error',
                    'message' => "<div class='alert alert-warning'>Please! File is not valid</div>"
                  ]);
               }
            }

            if ($request->hasFile('photo_3')) {
               if ($request->file('photo_3')->isValid()) {
                  $destinationPath = public_path('assets/images/items/');
                  $extension = $request->file('photo_3')->getClientOriginalExtension();
                  $fileName = time() . '3' . '.' . $extension;
                  $file_path_3 = 'assets/images/items/' . $fileName;
                  $request->file('photo_3')->move($destinationPath, $fileName);
               } else {
                  return response()->json([
                    'type' => 'error',
                    'message' => "<div class='alert alert-warning'>Please! File is not valid</div>"
                  ]);
               }
            }

            if ($request->hasFile('photo_4')) {
               if ($request->file('photo_4')->isValid()) {
                  $destinationPath = public_path('assets/images/items/');
                  $extension = $request->file('photo_4')->getClientOriginalExtension();
                  $fileName = time() . '4' . '.' . $extension;
                  $file_path_4 = 'assets/images/items/' . $fileName;
                  $request->file('photo_4')->move($destinationPath, $fileName);
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
               $item->sku = $request->input('sku');
               $item->item_title_gram = $request->input('item_title_gram');
               $item->sub_catalogue_id = $request->input('sub_catalogue_id');
               $item->item_title = $request->input('item_title');
               $item->description = $request->input('description');
               if(isset($file_path_1)){
                $item->photo = $file_path_1;                
               }
               if(isset($file_path_2)){
                $item->photo_2 = $file_path_2;                
               }
               if(isset($file_path_3)){
                $item->photo_3 = $file_path_3;                
               }
               if(isset($file_path_4)){
                $item->photo_4 = $file_path_4;                
               }
               $item->is_allcollection = $request->input('is_allcollection');
               $item->is_available = $request->input('is_available');
               $item->size = $request->input('size');
               $item->metal_colour = $request->input('metal_colour');
               $item->metal_type = $request->input('metal_type');

               $item->weight = $request->input('weight');
               $item->gem = $request->input('gem');
               $item->shape = $request->input('shape');
               $item->carat = $request->input('carat');
               $item->colour = $request->input('gem_colour');
               $item->cleaerty = $request->input('cleaerty');
               $item->pcs = $request->input('pcs');

               $item->is_active = $request->input('is_active');
               $item->cost_fee = $request->input('cost_fee');
               $item->price_usd = $request->input('price_usd');
               $item->price_pound = $request->input('price_pound');
               $item->price_eur = $request->input('price_eur');
               $item->price_notes = $request->input('price_notes');

               $item->setting = $request->input('setting');
               $item->diamond = $request->input('diamond');
               $item->loss = $request->input('loss');
               $item->diamond_note = $request->input('diamond_note');

               // $item->in_stock = $request->input('in_stock');
               $item->created_by = Auth::user()->id;
               $item->updated_by = Auth::user()->id;
               $item->save();

               $itemStock = ItemStock::where('item_id',$item->id)->get();

                if(!empty($request->stock))
                {
                    foreach ($request->stock as $key => $value) 
                    {
                        $itemStock = ItemStock::find($key);
                        $itemStock->item_code = $request->code[$key];
                        $itemStock->qty = $value;
                        $itemStock->gram = $request->gram[$key];
                        $itemStock->ct = $request->ct[$key];
                        $itemStock->pieces = $request->pieces[$key];
                        $itemStock->size = $request->q_size[$key];
                        $itemStock->colour = $request->colour[$key];
                        $itemStock->total_gram = $value * $request->gram[$key];
                        $itemStock->total_ct = $value * $request->ct[$key];
                        $itemStock->notes = $request->notes[$key];
                        $itemStock->stocknotes = $request->stocknotes[$key];
                        $itemStock->item_status = $request->item_status[$key];
                        $itemStock->date = !is_null($request->date[$key]) ? date('Y-m-d H:i:s' , strtotime($request->date[$key])) : NULL;
                        $itemStock->save();
                    }
                    $itemStockDelete = ItemStock::where('item_id',$item->id)->whereNotIn('id',array_keys($request->stock))->delete();
                }
                
                if(!empty($request->new_stock))
                {
                    foreach ($request->new_stock as $key => $value) {
                        $itemStock = new ItemStock();
                        $itemStock->item_id = $item->id;
                        $itemStock->item_code = $request->new_code[$key];
                        $itemStock->qty = $value;
                        $itemStock->gram = $request->new_gram[$key];
                        $itemStock->ct = $request->new_ct[$key];
                        $itemStock->pieces = $request->new_pieces[$key];
                        $itemStock->size = $request->new_q_size[$key];
                        $itemStock->colour = $request->new_colour[$key];
                        $itemStock->total_gram = $value * $request->new_gram[$key];
                        $itemStock->total_ct = $value * $request->new_ct[$key];
                        $itemStock->notes = $request->new_notes[$key];
                        $itemStock->stocknotes = $request->new_stocknotes[$key];
                        $itemStock->item_status = $request->new_item_status[$key];
                        $itemStock->date = !is_null($request->new_date[$key]) ? date('Y-m-d H:i:s' , strtotime($request->new_date[$key])) : NULL;
                        $itemStock->save();
                    }
                }

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

    public function copyProduct(Request $request)
    {
      $item = Item::find($request->id);
      $view = View::make('backend.admin.catalogue.copy_item', compact('item'))->render();
      return response()->json(['html' => $view]);
    }

    public function copyProductSave(Request $request)
    {
        DB::beginTransaction();
            try {
              $itemDetails = Item::find($request->id);
              foreach($request->input('catalogue_store') as $key => $value){
                $item = new Item();
               $item->catalogue_id = $key;
               $item->sku = $itemDetails->sku;
               $item->item_title_gram = $itemDetails->item_title_gram;
               $item->sub_catalogue_id = $itemDetails->sub_catalogue_id;
               $item->item_title = $itemDetails->item_title;
               $item->description = $itemDetails->description;
                $item->photo = $itemDetails->photo;                
               $item->is_allcollection = $itemDetails->is_allcollection;
               $item->is_available = $itemDetails->is_available;
               $item->size = $itemDetails->size;
               $item->metal_colour = $itemDetails->metal_colour;
               $item->metal_type = $itemDetails->metal_type;
               $item->gram = $itemDetails->gram;
               $item->total_gram = $itemDetails->total_gram;
               $item->quantity = $itemDetails->quantity;
               $item->ct = $itemDetails->ct;
               $item->total_ct = $itemDetails->total_ct;
               $item->created_by = Auth::user()->id;
               $item->updated_by = Auth::user()->id;
               $item->save();
              }
               DB::commit();
               return response()->json(['type' => 'success', 'message' => "Successfully Updated"]);

            } catch (\Exception $e) {
               DB::rollback();
               return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
            }
    }
}
