@extends('backend.layouts.master')
@section('title', __('Suppliers'))
@section('content')
    <x-admin.page-header title="{{ __('All Suppliers') }}" icon="car">
        <x-slot name="actions">
            @can('user-create')
                <button class="btn btn-success" onclick="create()">
                    <i class="fa fa-plus"></i> {{ __('New Supplier') }}
                </button>
            @endcan
        </x-slot>
    </x-admin.page-header>

    <x-admin.data-table-card>
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('First Name') }}</th>
            <th>{{ __('Last Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Order') }}</th>
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
                    url: '{!! route('admin.allSupplier.users') !!}',
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
                    {data: 'action', name: 'action'}
                ]
            });
        });
    </script>

    <script type="text/javascript">
        function create() {
            ajax_submit_create('supplier');
        }

        $(document).ready(function () {
            $('#manage_all').on('click', '.view', function () {
                ajax_submit_view('supplier', $(this).attr('id'));
            });
            $('#manage_all').on('click', '.edit', function () {
                ajax_submit_edit('supplier', $(this).attr('id'));
            });
            $('#manage_all').on('click', '.delete', function () {
                ajax_submit_delete('supplier', $(this).attr('id'));
            });
        });
    </script>
@stop
