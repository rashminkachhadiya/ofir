@extends('backend.layouts.master')
@section('title', ' All Order')
@section('content')
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
            <div class="page-title-heading" style="display: block !important;">
                <div class="d-flex" style="justify-content: space-between;">
                    <div class="d-flex">
                        <div class="form-group col-md-6 col-sm-12">
                            {!! Form::select('user_id', $users ?? [],  $item->catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'user_id']) !!}
                            <span id="error_email" class="has-error"></span>
                        </div>
                        <div class="form-group col-md-9 col-sm-12">
                            {!! Form::select('order_status[]', $orderStatus ?? [],  $item->sub_catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id' => 'order_status', 'multiple'=>'multiple']) !!}
                            <span id="error_email" class="has-error"></span>
                        </div>
                        <input type="hidden" id="supplier_id" name="supplier_id" value="">
                    </div>
                    <div class="d-flex">
                        <div>
                            <form action="{{ URL :: to('/admin/pdf-download') }}" id="form-print" method="get">
                                <input type="hidden" name="ids" id="print_ids">
                                <input type="hidden" name="flag" value="view">
                                <div class="mr-1">
                                    <a class="btn btn-xs btn-info" href="javascript:void(0)" onclick="printLabel(0)">View</a>
                                </div>
                            </form>
                        </div>
                        <div>
                            <form action="{{ URL :: to('/admin/pdf-download') }}" id="form-print" method="get">
                                <input type="hidden" name="ids" id="print_ids">
                                <div class="mr-1">
                                    <a class="btn btn-xs btn-success" href="javascript:void(0)" onclick="printLabel(1)">View All</a>
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
                               class="align-middle mb-0 table table-borderless table-striped table-hover table-dark">
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
        function printLabel(tag)
        {
            if(tag == 0)
            {
                var allVals = [];
                $("input[name='ids[]']:checked").each(function() {
                    allVals.push($(this).attr('value'));
                });
                $("#print_ids").val(allVals.join(', ')); 
                table.draw();
            }else{
                location.reload();
            }
            
        }
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
                        d.ids = $("#print_ids").val();
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
                    {data: 'carat', name: 'carat'},

                    {data: 'ref', name: 'ref'},
                    {data: 'tot_est_price', name: 'tot_est_price'},
                    {data: 'order_status', name: 'order_status'},
                    {data: 'action', name: 'action'},
                    {data: 'checkbox', name: 'checkbox', searchable: false, orderable: false}
                ],
                "autoWidth": false,
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
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            $('#user_id').val(urlParams.get('user_id'));
            $('#supplier_id').val(urlParams.get('supplier_id'));
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

        $('body').on("change",".master-checkbox",function(e){
            $(".child-checkbox:not(:disabled)").prop('checked', $(this).prop('checked'));
        });

    </script>
@stop
