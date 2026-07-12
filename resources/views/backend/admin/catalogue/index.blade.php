@extends('backend.layouts.master')
@section('title', __('Catalogue'))
@section('content')
    <x-admin.page-header title="{{ __('All Catalogue') }}" icon="albums">
        <x-slot name="actions">
            @can('user-create')
                <a href="{{ URL::to('/admin/catalogue/create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i> {{ __('Add New Item') }}
                </a>
            @endcan
        </x-slot>
    </x-admin.page-header>

    <x-admin.filters-bar>
        <div class="row align-items-end">
            <div class="col-md-6 col-lg-3 mb-2">
                {!! Form::select('catalogue_id', $catalogues ?? [], $item->catalogue_id ?? '', ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'catalogue_id']) !!}
            </div>
            <div class="col-md-6 col-lg-3 mb-2">
                {!! Form::select('sub_catalogue_id', $subCatalogue ?? [], $item->sub_catalogue_id ?? '', ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'sub_catalogue_id']) !!}
            </div>
            <div class="col-md-6 col-lg-3 mb-2">
                {!! Form::select('in_stock', $inStock ?? [], $item->in_stock ?? '', ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'in_stock']) !!}
            </div>
            <div class="col-md-3 col-lg-1 mb-2 d-flex align-items-center">
                <span class="text-muted small mr-1">Gr:</span>
                <strong id="total_gram_val">0.00</strong>
            </div>
            <div class="col-md-3 col-lg-1 mb-2 d-flex align-items-center">
                <span class="text-muted small mr-1">Ct:</span>
                <strong id="total_ct_val">0.00</strong>
            </div>
        </div>
    </x-admin.filters-bar>

    <x-admin.data-table-card table-class="align-middle mb-0 table table-borderless table-striped table-hover table-color w-100">
        <thead>
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Date</th>
            <th>Image</th>
            <th>Catalogue</th>
            <th>Product</th>
            <th>Item Title</th>
            <th>Color</th>
            <th>Metal</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Gram</th>
            <th>Ct</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
    </x-admin.data-table-card>
    <script>
        $(function () {

            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('admin.allCatalogue') !!}',
                    "type": "GET",
                    headers: {
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                    },
                    data: function(d) {
                        d.catalogue_id = $('#catalogue_id').val();
                        d.sub_catalogue_id = $('#sub_catalogue_id').val();
                        d.in_stock = $('#in_stock').val();
                    },
                    "dataType": 'json'
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'sku', name: 'sku'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'image', name:'image'},
                    {data: 'catalogue_id', name: 'catalogue_id'},
                    {data: 'sub_catalogue_id', name: 'sub_catalogue_id'},
                    {data: 'item_title', name: 'item_title'},
                    {data: 'metal_colour', name: 'metal_colour'},
                    {data: 'metal_type', name: 'metal_type'},
                    {data: 'size', name: 'size'},
                    {data: 'tot_qty', name: 'tot_qty', searchable: false},
                    {data: 'tot_gram', name: 'tot_gram', searchable: false},
                    {data: 'tot_ct', name: 'tot_ct', searchable: false},
                    {data: 'is_active',name: 'is_active'},
                    {data: 'action', name: 'action'}
                ],
                footerCallback: function (row, data, start, end, display) {
                    let api = this.api();
             
                    // Remove the formatting to get integer data for summation
                    let intVal = function (i) {
                        return typeof i === 'string'
                            ? i.replace(/[\$,]/g, '') * 1
                            : typeof i === 'number'
                            ? i
                            : 0.00;
                    };
             
                    // Total over all pages
                    total = api
                        .column(4)
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);
             
                    // Total over this page
                    gramTotal = api
                        .column(10, { page: 'current' })
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);

                    ctTotal = api
                        .column(11, { page: 'current' })
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);
                    $('#total_gram_val').html(gramTotal.toFixed(2));
                    $('#total_ct_val').html(ctTotal.toFixed(2));
                },
                lengthMenu: [25, 50, 100],
                language: {
                    lengthMenu: "Show _MENU_ "
                }
            });
        });
    </script>
    <script type="text/javascript">
        function create() {
            ajax_submit_create('users');
        }

        $(document).ready(function () {
            // View Form
            
            $("#manage_all").on("click", ".view", function () {
                var id = $(this).attr('id');
                ajax_submit_view('order', id)
            });

            // Edit Form
            $("#manage_all").on("click", ".edit", function () {
                var id = $(this).attr('id');
                ajax_submit_edit('order', id)
            });


            // Delete
            $("#manage_all").on("click", ".delete", function () {
                var id = $(this).attr('id');
                ajax_submit_delete('catalogue', id)
            });

            $("#manage_all").on("click", ".copy-product", function () {
                var id = $(this).attr('id');
                $("#modal_data").empty();
                $('.modal-title').text('Copy Product');

                $.ajax({
                    url: 'catalogue' + '/' + id + '/copy-product',
                    type: 'get',
                    success: function (data) {
                        $("#modal_data").html(data.html);
                        $('#myModal').modal('show'); // show bootstrap modal
                    },
                    error: function (result) {
                        $("#modal_data").html("Sorry Cannot Load Data");
                    }
                });
            });
            
        });

        $("body").on("change","#catalogue_id",function(e){
        table.draw();
        // var sub_catalogue = {!! json_encode(config('params.')) !!};
    });
        $("body").on("change","#sub_catalogue_id",function(e){
            table.draw();    
        });

        $("body").on("change","#in_stock",function(e){
            table.draw();    
        });

    </script>
@stop
