@extends('backend.layouts.master')
@section('title', 'All Users')
@section('content')
    <x-admin.page-header title="{{ __('All Users') }}" icon="users">
        <x-slot name="actions">
            @can('user-create')
                <button class="btn btn-success" onclick="create()">
                    <i class="fa fa-plus"></i> {{ __('New User') }}
                </button>
            @endcan
        </x-slot>
    </x-admin.page-header>

    <x-admin.data-table-card table-class="align-middle mb-0 table table-borderless table-striped table-hover table-color w-100">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('First Name') }}</th>
            <th>{{ __('Last Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Tot. Order') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Last Seen') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
    </x-admin.data-table-card>

    <script>
        $(function () {
            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('admin.allUser.users') !!}',
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                    },
                    dataType: 'json'
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'f_name', name: 'f_name'},
                    {data: 'l_name', name: 'l_name'},
                    {data: 'email', name: 'email'},
                    {data: 'tot_order', name: 'tot_order', searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'last_seen', name: 'last_seen'},
                    {data: 'action', name: 'action'}
                ],
                lengthMenu: [25, 50, 100],
                language: {
                    lengthMenu: 'Show _MENU_'
                }
            });
        });
    </script>

    <script type="text/javascript">
        function create() {
            ajax_submit_create('users');
        }

        $(document).ready(function () {
            $('#manage_all').on('click', '.view', function () {
                ajax_submit_view('users', $(this).attr('id'));
            });
            $('#manage_all').on('click', '.edit', function () {
                ajax_submit_edit('users', $(this).attr('id'));
            });
            $('#manage_all').on('click', '.delete', function () {
                ajax_submit_delete('users', $(this).attr('id'));
            });
        });
    </script>
@stop
