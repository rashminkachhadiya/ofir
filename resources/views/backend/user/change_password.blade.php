@extends('backend.layouts.user_master')
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
                rules: { password: { required: true } },
                submitHandler: function (form) {
                    var myData = new FormData($("#edit")[0]);
                    myData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                    $.ajax({
                        url: 'change_password',
                        type: 'POST',
                        data: myData,
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $('#loader').show();
                            $("#submit").prop('disabled', true);
                        },
                        success: function (data) {
                            if (data.type === 'success') {
                                notify_view(data.type, data.message);
                                $('#loader').hide();
                                $("#submit").prop('disabled', false);
                                $("html, body").animate({scrollTop: 0}, "slow");
                                $('.has-error').html('');
                                $('#edit')[0].reset();
                            } else if (data.type === 'error') {
                                $('.has-error').html('');
                                if (data.errors) {
                                    $.each(data.errors, function (key, val) {
                                        $('#error_' + key).html(val);
                                    });
                                }
                                $("#status").html(data.message);
                                $('#loader').hide();
                                $("#submit").prop('disabled', false);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
