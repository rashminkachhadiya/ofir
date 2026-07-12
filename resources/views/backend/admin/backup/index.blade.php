@extends('backend.layouts.master')
@section('title', __('Backups'))
@section('content')
    <x-admin.page-header title="{{ __('All Backups') }}" icon="download">
        <x-slot name="actions">
            <button class="btn btn-success" onclick="create('db_backup')">
                <i class="fa fa-database"></i> {{ __('Database Backup') }}
            </button>
            <button class="btn btn-success ml-2" onclick="create('full_backup')">
                <i class="fa fa-archive"></i> {{ __('Full Backup') }}
            </button>
        </x-slot>
    </x-admin.page-header>

    <x-admin.data-table-card table-class="align-middle mb-0 table table-borderless table-striped table-hover w-100">
        <thead>
        <tr>
            <th>{{ __('File Name') }}</th>
            <th>{{ __('Size') }}</th>
            <th>{{ __('Created At') }}</th>
            <th>{{ __('Duration') }}</th>
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
                "order": [[4, "desc"]],
                ajax: '/admin/allBackups',
                columns: [
                    {data: 'file_name', name: 'file_name'},
                    {data: 'file_size', name: 'file_size'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'time_elapsed', name: 'time_elapsed'},
                    {data: 'time', name: 'time', visible: false},
                    {data: 'action', name: 'action'}
                ]
            });
        });
    </script>
    <script type="text/javascript">

        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax
        }


        function create(val) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: "Are you sure?",
                text: "Please wait untill backup response reply!",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Backup",
                cancelButtonText: "Cancel"
            }, function () {
                $.ajax({
                    url: 'backups/' + val,
                    data: {"_token": CSRF_TOKEN},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {

                        if (data.type === 'success') {

                            swal("Done!", data.message, "success");
                            reload_table();

                        } else if (data.type === 'danger') {

                            swal("Error!", data.message, "error");

                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error!", data.message, "error");
                    }
                });
            });

        }

    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            $("#manage_all").on("click", ".delete", function () {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var id = $(this).attr('id');
                swal({
                    title: "Are you sure",
                    text: "Deleted data cannot be recovered!!",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel"
                }, function () {
                    $.ajax({
                        url: 'backups/delete/' + id,
                        data: {"_token": CSRF_TOKEN},
                        type: 'DELETE',
                        dataType: 'json',
                        success: function (data) {

                            if (data.type === 'success') {

                                swal("Done!", "Successfully Deleted", "success");
                                reload_table();

                            } else if (data.type === 'danger') {

                                swal("Error deleting!", "Try again", "error");

                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Error deleting!", "Try again", "error");
                        }
                    });
                });
            });
        });

    </script>
@stop