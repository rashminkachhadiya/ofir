@extends('backend.layouts.master')
@section('title', ' All Order')
@section('content')
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
                                <th>Created At</th>
                                <th>Catalogue</th>
                                <th>Sub Catalogue</th>
                                <th>Item Title</th>
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
                    "dataType": 'json'
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'catalogue_id', name: 'catalogue_id'},
                    {data: 'sub_catalogue_id', name: 'sub_catalogue_id'},
                    {data: 'item_title', name: 'item_title'},
                    {data: 'action', name: 'action'}
                ],
                "autoWidth": false,
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

        });

    </script>
@stop
