@extends('backend.layouts.master')
@section('title', __('Cart'))
@section('content')
    <x-admin.page-header title="{{ __('Cart') }}" icon="shopbag" />

    <x-admin.filters-bar>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                {!! Form::select('user_id', $users ?? [], $item->catalogue_id ?? '', ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'user_id']) !!}
                <span id="error_email" class="has-error"></span>
            </div>
        </div>
    </x-admin.filters-bar>

    <x-admin.data-table-card table-class="align-middle mb-0 table table-borderless table-striped table-hover w-100">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Client') }}</th>
            <th>{{ __('Code') }}</th>
            <th>{{ __('Category') }}</th>
            <th>{{ __('Qty') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
    </x-admin.data-table-card>

    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        $(function () {

            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('admin.allCarts') !!}',
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
                    {data: 'client_name', name: 'client_name'},
                    {data: 'sku', name: 'sku'},
                    {data: 'category', name: 'category'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'action', name: 'action'},
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
