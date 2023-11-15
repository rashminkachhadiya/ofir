@extends('backend.layouts.master')
@section('title', ' All Order')
@section('content')
<style type="text/css">
    .thead tr:first-child th {
    position: sticky;
    z-index: 12;
    top: 0;
    background: white;
}
#manage_all{
    color: black !important;
 }
</style>
    <div class="app-page-title mt-1">
        <div class="page-title-wrapper" style="display: block !important;">
            <div class="page-title-heading" style="display: block !important;">
                <div class="row">
                    <div class="col-md-4 row" style="border-right:1px solid">
                        <div class="form-group col-md-4">
                            <label for=""> Sold </label><br/>
                            {!! Form::radio('item_status_sold', '1',false,['class' => '']) !!} Yes
                            {!! Form::radio('item_status_sold', '0',false,['class' => '']) !!} No
                        </div>
                        <div class="form-group col-md-4">
                            <label for=""> In Stock </label><br/>
                            {!! Form::radio('item_status_in_stock', '1',false,['class' => '']) !!} Yes
                            {!! Form::radio('item_status_in_stock', '0',false,['class' => '']) !!} No
                        </div>
                        <div class="form-group col-md-4">
                            <label for=""> Apro </label><br/>
                            {!! Form::radio('item_status_apro', '1',false,['class' => '']) !!} Yes
                            {!! Form::radio('item_status_apro', '0',false,['class' => '']) !!} No
                        </div>  
                    </div>
                    <div class="col-md-4">
                        <div class="form-group col-md-6 col-sm-6">
                            {!! Form::select('catalogue_id', $catalogues ?? [],  $item->catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'catalogue_id']) !!}
                            <span id="error_email" class="has-error"></span>
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            {!! Form::select('sub_catalogue_id', $subCatalogue ?? [],  $item->sub_catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id' => 'sub_catalogue_id']) !!}
                            <span id="error_email" class="has-error"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                       <div class="d-flex col-md-12" style="align-items: center">
                            <div>
                                <p>Qty: &nbsp;</p>
                            </div>
                            <div>
                                <p id="total_qty">0</p>                        
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex col-md-12" style="align-items: center">
                            <div>
                                <p>Gr: &nbsp;</p>
                            </div>
                            <div>
                                <p id="total_gram_val">0.00</p>                        
                            </div>
                        </div>
                        <div class="d-flex col-md-12" style="align-items: center">
                            <div>
                                <p>Ct: &nbsp;</p>
                            </div>
                            <div>
                                <p id="total_ct_val">0.00</p>                        
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="manage_all"
                               class="align-middle mb-0 table table-borderless table-striped table-hover" style="color: black;">
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
                                <th>Status</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Note</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @media screen and (min-width: 768px) {
            #myModal .modal-dialog {
                width: 85%;
                border-radius: 5px;
            }
        }
    </style>
    <script>
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
                    {data: 'item_status',name: 'item_status'},
                    {data: 'notes', name: 'notes'},
                    {data: 'date', name: 'date'},
                    {data: 'stocknotes', name: 'stocknotes'},
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
                        .column(5, { page: 'current' })
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);

                    gramTotal = api
                        .column(6, { page: 'current' })
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);

                    ctTotal = api
                        .column(9, { page: 'current' })
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);
                    $('#total_gram_val').html(gramTotal.toFixed(2));
                    $('#total_ct_val').html(ctTotal.toFixed(2));
                    $('#total_qty').html(qtyTotal.toFixed(0));

                    // console.log(pageTotal);
                },
                "rowCallback": function(row, data, index)
                { 
                    console.log(data);
                    if(data['item_status']=='Sold')
                    { 
                        $(row).css('color', 'red'); 
                    }
                },
                "autoWidth": false,
                "scrollX": true,
                "scrollY": 450,
                "alwaysCloneTop": true,
                "lengthMenu": [25, 50, 100],
                "language": {
                    "lengthMenu": "Show _MENU_ "
                }
            });
            $('.dataTables_filter input[type="search"]').attr('placeholder', 'Type here to search...').css({
                'width': '220px',
                'height': '30px'
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
