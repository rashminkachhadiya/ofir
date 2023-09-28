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
</style>
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="icon-gradient bg-mean-fruit"> </i>
                </div>
                <div>All Catalogue</div>
                <div class="d-inline-block ml-2">
                    @can('user-create')
                        <a href="{{ URL :: to('/admin/catalogue/create') }}" class="btn btn-success"><i
                                class="glyphicon glyphicon-plus"></i>
                            Add New Item
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="app-page-title mt-1">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="form-group col-md-6 col-sm-6">
                    {!! Form::select('catalogue_id', $catalogues ?? [],  $item->catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'catalogue_id']) !!}
                    <span id="error_email" class="has-error"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    {!! Form::select('sub_catalogue_id', $subCatalogue ?? [],  $item->sub_catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id' => 'sub_catalogue_id']) !!}
                    <span id="error_email" class="has-error"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    {!! Form::select('in_stock', $inStock ?? [],  $item->in_stock ?? '', ['class' => 'form-control','data-control'=>"select2", 'id' => 'in_stock']) !!}
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
                                <th>Code</th>
                                <th>Date</th>
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
