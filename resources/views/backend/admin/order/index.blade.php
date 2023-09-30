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
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="form-group col-md-12 col-sm-12">
                    {!! Form::select('user_id', $users ?? [],  $item->catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'user_id']) !!}
                    <span id="error_email" class="has-error"></span>
                </div>
                <div class="form-group col-md-12 col-sm-12">
                    {!! Form::select('order_status', $orderStatus ?? [],  $item->sub_catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id' => 'order_status']) !!}
                    <span id="error_email" class="has-error"></span>
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
                                <th>Order Date</th>
                                <th>Supplier</th>
                                <th>Order Number</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Clinet Name</th>
                                <th>Est. Price</th>
                                <th>Order Status</th>
                                <th>Action</th>
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
                        d.order_status = $('#order_status').val();
                    },
                    "dataType": 'json'
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'supplier_name', name: 'supplier_name'},
                    {data: 'order_number', name: 'order_number'},
                    {data: 'sku', name: 'sku'},
                    {data: 'category', name: 'category'},
                    {data: 'client_name', name: 'client_name'},
                    {data: 'tot_est_price', name: 'tot_est_price'},
                    {data: 'order_status', name: 'order_status'},
                    {data: 'action', name: 'action'}
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

        });

        $("body").on("change","#user_id",function(e){
            table.draw();
        // var sub_catalogue = {!! json_encode(config('params.')) !!};
        });

        $("body").on("change","#order_status",function(e){
            table.draw();    
        });

    </script>
@stop
