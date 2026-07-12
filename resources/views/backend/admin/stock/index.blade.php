@extends('backend.layouts.master')
@section('title', __('Inventory'))
@section('content')
    <x-admin.page-header title="{{ __('Inventory / Stock') }}" icon="box2" />

    <x-admin.filters-bar>
        <div class="row">
            <div class="col-lg-5">
                <div class="row">
                    <div class="form-group col-md-4 col-6">
                        <label>{{ __('Sold') }}</label><br>
                        {!! Form::radio('item_status_sold', '1', false) !!} {{ __('Yes') }}
                        {!! Form::radio('item_status_sold', '0', false) !!} {{ __('No') }}
                    </div>
                    <div class="form-group col-md-4 col-6">
                        <label>{{ __('In Stock') }}</label><br>
                        {!! Form::radio('item_status_in_stock', '1', false) !!} {{ __('Yes') }}
                        {!! Form::radio('item_status_in_stock', '0', false) !!} {{ __('No') }}
                    </div>
                    <div class="form-group col-md-4 col-6">
                        <label>{{ __('Apro') }}</label><br>
                        {!! Form::radio('item_status_apro', '1', false) !!} {{ __('Yes') }}
                        {!! Form::radio('item_status_apro', '0', false) !!} {{ __('No') }}
                    </div>
                    <div class="form-group col-md-4 col-6">
                        <label>{{ __('UK') }}</label><br>
                        {!! Form::radio('item_status_uk', '1', false) !!} {{ __('Yes') }}
                        {!! Form::radio('item_status_uk', '0', false) !!} {{ __('No') }}
                    </div>
                    <div class="form-group col-md-4 col-6">
                        <label>{{ __('Israel') }}</label><br>
                        {!! Form::radio('item_status_israel', '1', false) !!} {{ __('Yes') }}
                        {!! Form::radio('item_status_israel', '0', false) !!} {{ __('No') }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    {!! Form::select('catalogue_id', $catalogues ?? [], $item->catalogue_id ?? '', ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'catalogue_id']) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('sub_catalogue_id', $subCatalogue ?? [], $item->sub_catalogue_id ?? '', ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'sub_catalogue_id']) !!}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center mb-2">
                    <span class="text-muted small mr-2">{{ __('Qty') }}:</span>
                    <strong id="total_qty">0</strong>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <span class="text-muted small mr-2">{{ __('Gr') }}:</span>
                    <strong id="total_gram_val">0.00</strong>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <span class="text-muted small mr-2">{{ __('Ct') }}:</span>
                    <strong id="total_ct_val">0.00</strong>
                </div>
                <a class="btn btn-sm btn-info" href="javascript:void(0)" onclick="resetStock()">{{ __('Reset') }}</a>
            </div>
        </div>
    </x-admin.filters-bar>

    <x-admin.data-table-card table-class="align-middle mb-0 table table-borderless table-striped table-hover w-100">
        <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th>Date</th>
            <th>Image</th>
            <th>Code</th>
            <th>Sub Code</th>
            <th>Qty</th>
            <th>Gram</th>
            <th>Size</th>
            <th>Color</th>
            <th>Ct</th>
            <th>Pcs.</th>
            <th>Location</th>
            <th>Status</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
        </thead>
    </x-admin.data-table-card>
    <script>
        function resetStock(){
           $.ajax({
                type: "GET",
                url: '{{ url("admin/stock-reset") }}',
                datatype: 'html',
                success: function (data) {
                    table.draw();
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            }); 
        }

        function checkStock(val)
        {
            var stockId = $(val).attr('value');
            $.ajax({
                type: "GET",
                url: '{{ url("admin/stock-check") }}?stock_id='+stockId,
                datatype: 'html',
                success: function (data) {
                    table.draw();
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });
        }


        $(function () {

            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('admin.allStock') !!}',
                    "type": "GET",
                    headers: {
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                    },
                    data: function(d) {
                        d.catalogue_id = $('#catalogue_id').val();
                        d.sub_catalogue_id = $('#sub_catalogue_id').val();
                        d.item_status_sold = $('input[name="item_status_sold"]:checked').val();
                        d.item_status_in_stock = $('input[name="item_status_in_stock"]:checked').val();
                        d.item_status_apro = $('input[name="item_status_apro"]:checked').val();
                        d.item_status_uk = $('input[name="item_status_uk"]:checked').val();
                        d.item_status_israel = $('input[name="item_status_israel"]:checked').val();
                    },
                    "dataType": 'json'
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'check', name: 'check', searchable: false, orderable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'image', name:'image'},
                    {data: 'sku', name: 'items.sku'},
                    {data: 'item_code', name: 'item_code'},
                    {data: 'tot_qty', name: 'tot_qty'},
                    {data: 'gram', name: 'gram'},
                    {data: 'size', name: 'size'},
                    {data: 'colour', name: 'colour'},
                    {data: 'ct', name:'ct'},
                    {data: 'pieces', name:'pieces'},
                    {data: 'location', name:'location'},
                    {data: 'item_status',name: 'item_status'},
                    {data: 'notes', name: 'notes'},
                    {data: 'date', name: 'date'},
                    {data: 'stocknotes', name: 'stocknotes'},
                    {data: 'action', name: 'action'},
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
                    qtyTotal = api
                        .column(6, { page: 'current' })
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);

                    gramTotal = api
                        .column(7, { page: 'current' })
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);

                    ctTotal = api
                        .column(10, { page: 'current' })
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);
                    $('#total_gram_val').html(gramTotal.toFixed(2));
                    $('#total_ct_val').html(ctTotal.toFixed(2));
                    $('#total_qty').html(qtyTotal.toFixed(0));
                },
                rowCallback: function(row, data, index)
                { 
                    console.log(data);
                    if(data['item_status']=='Sold')
                    { 
                        $(row).css('color', 'red'); 
                    }
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

            $("input[name='item_status_sold']").on('change',function(){
                table.draw();
            });

            $("input[name='item_status_in_stock']").on('change',function(){
                table.draw();
            });

            $("input[name='item_status_apro']").on('change',function(){
                table.draw();
            });

            $("input[name='item_status_uk']").on('change',function(){
                table.draw();
            });

            $("input[name='item_status_israel']").on('change',function(){
                table.draw();
            });

            $('input[type="checkbox"].flat-green').iCheck({
                checkboxClass: 'icheckbox_flat-green',
            });
            $('input[type="radio"].flat-green').iCheck({
                radioClass: 'iradio_flat-green'
            });

            $('input[type="checkbox"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-red',
            });
            $('input[type="radio"].flat-red').iCheck({
                radioClass: 'iradio_flat-red'
            });

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
                ajax_submit_delete('stock', id)
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

        $("body").on("change","#item_status_sold",function(e){

        table.draw();
        // var sub_catalogue = {!! json_encode(config('params.')) !!};
    });
        $("body").on("change","#catalogue_id",function(e){
        table.draw();
        // var sub_catalogue = {!! json_encode(config('params.')) !!};
    });
        $("body").on("change","#sub_catalogue_id",function(e){
            table.draw();    
        });

    </script>
@stop
