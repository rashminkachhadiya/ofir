@extends('backend.layouts.master')
@section('title', __('Settings'))
@section('content')
    <x-admin.page-header title="{{ __('Settings') }}" icon="tools" />

    <x-admin.data-table-card>
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Layout') }}</th>
            <th>{{ __('Running Year') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
    </x-admin.data-table-card>

    <script>
        $(function () {
            table = $('#manage_all').DataTable({

                processing: true,
                serverSide: true,
                ajax: '/admin/allSettings',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'layout', name: 'layout'},
                    {data: 'running_year', name: 'running_year'},
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

        $(document).ready(function () {
            // View Form
            $("#manage_all").on("click", ".view", function () {
                var id = $(this).attr('id');
                ajax_submit_view('settings', id)
            });

            // Edit Form
            $("#manage_all").on("click", ".edit", function () {
                var id = $(this).attr('id');
                ajax_submit_edit('settings', id)
            });

        });

    </script>
@stop
