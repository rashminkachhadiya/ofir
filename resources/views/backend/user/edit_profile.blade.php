@extends('backend.layouts.user_master')
@section('title', __('Edit Profile'))
@section('content')
    <x-admin.page-header title="{{ __('Edit Profile') }}" icon="user" />

    <div class="row">
        <div class="col-lg-8">
            <x-admin.form-card>
                <form id="edit" action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation" novalidate>
                    {{ method_field('PATCH') }}
                    <div id="status"></div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            <span id="error_name" class="has-error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly required>
                            <span id="error_email" class="has-error"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo">{{ __('Upload Image') }}</label>
                        <input id="photo" type="file" name="photo" class="d-none" accept="image/jpeg,image/png,image/jpg">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-success" onclick="$('input[id=photo]').click();">{{ __('Browse') }}</button>
                            </div>
                            <input type="text" name="SelectedFileName" class="form-control" id="SelectedFileName" value="{{ $user->file_path }}" readonly>
                        </div>
                        <small class="form-text text-muted">{{ __('File must be jpg, jpeg, png.') }}</small>
                        <span id="error_photo" class="has-error"></span>
                    </div>

                    <button type="submit" class="btn btn-success button-submit">
                        <i class="fa fa-save"></i> {{ __('Save') }}
                    </button>
                </form>
            </x-admin.form-card>
        </div>
    </div>

    <script>
        $('input[id=photo]').change(function () {
            $('#SelectedFileName').val($(this).val().split('\\').pop());
        });

        $(document).ready(function () {
            $('#loader').hide();

            $('#edit').validate({
                rules: { name: { required: true } },
                messages: { name: { required: '{{ __('Enter name') }}' } },
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
                            $(".button-submit").prop('disabled', true);
                        },
                        success: function (data) {
                            if (data.type === 'success') {
                                notify_view(data.type, data.message);
                                $('#loader').hide();
                                $(".button-submit").prop('disabled', false);
                                $("html, body").animate({scrollTop: 0}, "slow");
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
                                $(".button-submit").prop('disabled', false);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
