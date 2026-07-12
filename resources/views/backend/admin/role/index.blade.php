@extends('backend.layouts.master')
@section('title', __('Roles'))
@section('content')
    <x-admin.page-header title="{{ __('All Roles') }}" icon="users">
        <x-slot name="actions">
            @can('role-create')
                <button class="btn btn-success" onclick="create()">
                    <i class="fa fa-plus"></i> {{ __('New Role') }}
                </button>
            @endcan
        </x-slot>
    </x-admin.page-header>

    <x-admin.data-table-card>
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Role Name') }}</th>
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
                ajax: '/admin/allRoles',
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
            ajax_submit_create('roles');
        }

        $(document).ready(function () {
            // View Form
            $("#manage_all").on("click", ".view", function () {
                var id = $(this).attr('id');
                ajax_submit_view('roles', id)
            });

            // Edit Form
            $("#manage_all").on("click", ".edit", function () {
                var id = $(this).attr('id');
                ajax_submit_edit('roles', id)
            });


            // Delete
            $("#manage_all").on("click", ".delete", function () {
                var id = $(this).attr('id');
                ajax_submit_delete('roles', id)
            });

        });

    </script>
@stop
