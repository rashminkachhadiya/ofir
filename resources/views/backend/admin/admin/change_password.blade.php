@extends('backend.layouts.master')
@section('title', __('Change Password'))
@section('content')
    <x-admin.page-header title="{{ __('Change Password') }}" icon="lock" />

    <div class="row">
        <div class="col-lg-6">
            <x-admin.form-card>
                <form id="edit" action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div id="status"></div>
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <label for="password">{{ __('New Password') }}</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="{{ __('Type new password') }}" required autocomplete="new-password">
                        <span id="error_password" class="has-error"></span>
                    </div>

                    <button type="submit" class="btn btn-success" id="submit">
                        <i class="fa fa-save"></i> {{ __('Save') }}
                    </button>
                </form>
            </x-admin.form-card>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#loader').hide();

            $('#edit').validate({
                submitHandler: function (form) {
                    var myData = new FormData($("#edit")[0]);
                    myData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                    swal({
                        title: "{{ __('Are you sure to submit?') }}",
                        text: "{{ __('Submit Form') }}",
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "{{ __('Yes, Submit!') }}"
                    }, function () {
                        $.ajax({
                            url: 'change_password',
                            type: 'POST',
                            data: myData,
                            dataType: 'json',
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                if (data.type === 'success') {
                                    $('#myModal').modal('hide');
                                    swal("Done!", "{{ __('It was successfully done!') }}", "success");
                                    if (typeof reload_table === 'function') reload_table();
                                } else if (data.type === 'error') {
                                    if (data.errors) {
                                        $.each(data.errors, function (key, val) {
                                            $('#error_' + key).html(val);
                                        });
                                    }
                                    $("#status").html(data.message);
                                    swal("Error!", "{{ __('Please fix the errors') }}", "error");
                                }
                            }
                        });
                    });
                }
            });
        });
    </script>
@endsection
