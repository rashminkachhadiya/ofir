@extends('backend.layouts.master')
@section('title', __('Edit Profile'))
@section('content')
    <x-admin.page-header title="{{ __('Update Profile') }}" icon="user" />

    <div class="row">
        <div class="col-lg-8">
            <x-admin.form-card>
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form id="edit" action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div id="status"></div>
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ $user->name }}" required>
                        <span id="error_name" class="has-error"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ $user->email }}">
                        <span id="error_email" class="has-error"></span>
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
                rules: {
                    name: { required: true }
                },
                messages: {
                    name: { required: '{{ __('Enter name') }}' }
                },
                submitHandler: function (form) {
                    var myData = new FormData($("#edit")[0]);
                    myData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                    $.ajax({
                        url: 'edit_profile',
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
                                $('#myModal').modal('hide');
                                $('.has-error').html('');
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
