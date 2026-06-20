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
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="icon-gradient bg-mean-fruit"> </i>
                </div>
                <div>All Orders</div>
                <div class="d-inline-block ml-2">
                    <!-- @can('user-create')
                        <button class="btn btn-success" onclick="create()"><i
                                class="glyphicon glyphicon-plus"></i>
                            New User
                        </button>
                    @endcan -->
                </div>
            </div>
        </div>
    </div>
    <div class="app-page-title mt-1">
        <div class="page-title-wrapper" style="display: block !important;">
            <div class="page-title-heading" style="display: block !important; justify-content: space-between;">
                <div class="row">
                        <div class="col-md-2">
                            {!! Form::select('user_id', $users ?? [],  $item->catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'user_id']) !!}
                            <span id="error_email" class="has-error"></span>
                        </div>
                        <div class="col-md-2">
                             {!! Form::select('supplier_id', $suppliers ?? [],  $item->supplier_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'supplier_id']) !!}
                            <span id="error_email" class="has-error"></span>
                        </div>
                        <div class="col-md-2">
                            {!! Form::select('order_status[]', $orderStatus ?? [],  $item->sub_catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id' => 'order_status', 'multiple'=>'multiple']) !!}
                            <span id="error_email" class="has-error"></span>
                        </div>
                        <div class="col-md-2">
                            <input type="text" id="ref" class="form-control" name="ref" value="" placeholder="Ref">
                        </div>
                        <div class="col-md-1">
                            
                        </div>
                        <div class="col-md-1">
                            
                        </div>
                    <div class="mr-1 p-0">
                        <div>
                            <form action="{{ URL :: to('/admin/excel-download') }}" id="export-form" method="get">
                                <input type="hidden" name="ids" id="export_ids">
                                <input type="hidden" name="flag" value="view">
                                <div>
                                    <button class="btn btn-xs btn-info" type="button" onclick="Export()">Export</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mr-1 p-0">
                        <div>
                            <form action="{{ URL :: to('/admin/pdf-download') }}" id="pdf-form" method="get">
                                <input type="hidden" name="ids" id="pdf_ids">
                                <input type="hidden" name="flag" value="pdf">
                                <div>
                                    <button class="btn btn-xs btn-success" type="button" onclick="downloadSelectedPdf()">PDF</button>
                                </div>
                            </form>
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
                               class="align-middle mb-0 table table-borderless table-striped table-hover table-color">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Image</th>
                                <th>Supplier</th>
                                <th>Number</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Qty</th>
                                <th>Colour</th>
                                <th>MLT</th>
                                <th>Carat</th>
                                <th>Ref.</th>
                                <th>Est.</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th><div class="btn-group"><div class="form-check form-check-custom form-check-sm">
                                  <input style="width:30px; height:23px;" class=" master-checkbox me-9" style="margin-left: 8px;" type="checkbox" name="ids[]"/>
                               </div></div></th>
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
        function getSelectedOrderIds()
        {
            var allVals = [];
            $(".child-checkbox:checked").each(function() {
                var checkboxValue = $(this).val();
                if (checkboxValue) {
                    allVals.push($.trim(checkboxValue));
                }
            });

            return allVals;
        }

        function downloadSelectedPdf()
        {
            var allVals = getSelectedOrderIds();
            if (allVals.length === 0) {
                alert('Please select at least one order.');
                return;
            }

            $("#pdf_ids").val(allVals.join(','));
            $('#pdf-form').submit();
        }

        function Export()
        {
            var allVals = getSelectedOrderIds();
            if (allVals.length === 0) {
                alert('Please select at least one order.');
                return;
            }

            $("#export_ids").val(allVals.join(',')); 
            $('#export-form').submit();
        }
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        $(function () {

            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('admin.allOrders') !!}',
                    "type": "GET",
                    headers: {
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                    },
                    data: function(d) {
                        d.user_id = $('#user_id').val();
                        d.supplier_id = $('#supplier_id').val();
                        d.order_status = $('#order_status').val();
                        d.ref = $("#ref").val();
                        d.param = urlParams.get('param');
                    },
                    "dataType": 'json'
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'image', name:'image'},
                    {data: 'supplier_name', name: 'supplier_name'},
                    {data: 'order_number', name: 'order_number'},
                    {data: 'sku', name: 'sku'},
                    {data: 'category', name: 'category'},
                    {data: 'client_name', name: 'client_name'},
                    {data: 'size', name: 'size'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'metal_colour', name: 'metal_colour'},
                    {data: 'metal_type', name: 'metal_type'},
                    {data: 'carat', name: 'carat'},
                    {data: 'ref', name: 'ref'},
                    {data: 'tot_est_price', name: 'tot_est_price'},
                    {data: 'order_status', name: 'order_status'},
                    {data: 'action', name: 'action'},
                    {data: 'checkbox', name: 'checkbox', searchable: false, orderable: false}
                ],
                "autoWidth": false,
                "scrollX": true,
                "scrollY": 450,
                "alwaysCloneTop": true,
                "lengthMenu": [25, 50, 100],
                "language": {
                    "lengthMenu": "Show _MENU_ "
                },
                "rowCallback": function(row, data, index)
                { 
                    console.log(data);
                    if(data['order_status']=='Done')
                    { 
                        $(row).css('color', 'red'); 
                    }
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
        function receiveSupplier(val) {
            var orderId = $(val).attr('value');
            $.ajax({
                type: "GET",
                url: '{{ url("admin/receive-supplier") }}?order_id='+orderId,
                datatype: 'html',
                success: function (data) {
                    table.draw();
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });
        }
        $(document).ready(function () {
            // View Form
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            $('#user_id').val(urlParams.get('user_id'));
            $('#supplier_id').val(urlParams.get('supplier_id'));
            $('#order_status').val(urlParams.get('order_status'));

            table.draw();
            // console.log(urlParams.get('user_id'));
            $("#manage_all").on("click", ".view", function () {
                var id = $(this).attr('id');
                ajax_submit_view('order', id)
            });

            // Edit Form
            $("#manage_all").on("click", ".edit", function () {
                var id = $(this).attr('id');
                ajax_submit_edit('order', id)
            });

            $("#manage_all").on("click", ".supplier-edit", function () {
                var id = $(this).attr('id');
                $("#modal_data").empty();
                $('.modal-title').text('Supplier Information');

                $.ajax({
                    url: '{{ url("admin/update-supplier-information") }}?id='+id,
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


            // Delete
            $("#manage_all").on("click", ".delete", function () {
                var id = $(this).attr('id');
                ajax_submit_delete('order', id)
            });

            $("body").on("change","#user_id",function(e){
                table.draw();
            // var sub_catalogue = {!! json_encode(config('params.')) !!};
            });

            $('#order_status').select2({
                placeholder: "All Status",
                allowClear: true
            });
            jQuery(" .select2-results__group").css("-webkit-text-fill-color", "#00ff7b");
        });


        $("body").on("change","#order_status",function(e){
            table.draw();    
        });

        $("body").on("change","#supplier_id",function(e){
            table.draw();    
        });

        $("body").on("keyup","#ref",function(e){
            table.draw();    
        });

        $('body').on("change",".master-checkbox",function(e){
            $(".child-checkbox:not(:disabled)").prop('checked', $(this).prop('checked'));
        });

    </script>
@stop
