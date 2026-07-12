@extends('backend.layouts.master')
@section('title', __('Permissions'))
@section('content')
    <x-admin.page-header title="{{ __('All Permissions') }}" icon="lock">
        <x-slot name="actions">
            @can('permission-create')
                <button class="btn btn-success" onclick="create()">
                    <i class="fa fa-plus"></i> {{ __('New Permission') }}
                </button>
            @endcan
        </x-slot>
    </x-admin.page-header>

    <x-admin.data-table-card>
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Permission Name') }}</th>
            <th>{{ __('Guard Name') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
    </x-admin.data-table-card>

    <script>
        $(function () {
            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 50,
                ajax: '/admin/allPermissions',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'guard_name', name: 'guard_name'},
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
            ajax_submit_create('permissions');
        }

        $(document).ready(function () {
            // View Form
            $("#manage_all").on("click", ".view", function () {
                var id = $(this).attr('id');
                ajax_submit_view('permissions', id)
            });

            // Edit Form
            $("#manage_all").on("click", ".edit", function () {
                var id = $(this).attr('id');
                ajax_submit_edit('permissions', id)
            });


            // Delete
            $("#manage_all").on("click", ".delete", function () {
                var id = $(this).attr('id');
                ajax_submit_delete('permissions', id)
            });

        });

    </script>
@stop
