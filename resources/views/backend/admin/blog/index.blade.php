@extends('backend.layouts.master')
@section('title', __('Blogs'))
@section('content')
    <x-admin.page-header title="{{ __('All Blogs') }}" icon="bookmarks">
        <x-slot name="actions">
            @can('blogs-create')
                <button class="btn btn-success" onclick="create()">
                    <i class="fa fa-plus"></i> {{ __('New Blog') }}
                </button>
            @endcan
        </x-slot>
    </x-admin.page-header>

    <x-admin.data-table-card>
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Image') }}</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
    </x-admin.data-table-card>

    <script>
        $(function () {
            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/allBlogs',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'file_path', name: 'file_path'},
                    {data: 'title', name: 'title'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'}
                ],
                "columnDefs": [
                    {"className": "", "targets": "_all"}
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
            ajax_submit_create('blogs');
        }

        $(document).ready(function () {
            // View Form
            $("#manage_all").on("click", ".view", function () {
                var id = $(this).attr('id');
                ajax_submit_view('blogs', id)
            });

            // Edit Form
            $("#manage_all").on("click", ".edit", function () {
                var id = $(this).attr('id');
                ajax_submit_edit('blogs', id)
            });


            // Delete
            $("#manage_all").on("click", ".delete", function () {
                var id = $(this).attr('id');
                ajax_submit_delete('blogs', id)
            });

        });

    </script>
@stop
