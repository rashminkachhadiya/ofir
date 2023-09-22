<form id='edit' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
      novalidate>
    {{method_field('PATCH')}}
    <div class="form-row">
        <div id="status"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> First Name </label>
            <input type="text" class="form-control" id="f_name" name="f_name" value="{{$user->f_name}}" placeholder=""
                   required>
            <span id="f_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Last Name </label>
            <input type="text" class="form-control" id="l_name" name="l_name" value="{{$user->l_name}}" placeholder=""
                   required>
            <span id="l_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Email </label>
            <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder=""
                   readonly>
            <span id="error_email" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> User Name </label>
            <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" placeholder=""
                   required>
            <span id="error_username" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Password </label>
            <input type="text" class="form-control" id="password" name="password" value="{{ $user->password }}" placeholder=""
                   required>
            <span id="error_password" class="has-error"></span>
        </div>

        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Exp. Time </label>
            <input type="text" class="form-control" id="datepicker" name="exp_date" value="{{ $user->exp_time}}" placeholder=""
                   required>
            <span id="error_password" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Mobile </label>
            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}" placeholder=""
                   required>
            <span id="error_mobile" class="has-error"></span>
        </div>

        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Address 1 </label>
            <input type="text" class="form-control" id="address_1" name="address_1" value="{{ $user->address_1 }}" placeholder=""
                   required>
            <span id="error_address_1" class="has-error"></span>
        </div>

        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Address 2 </label>
            <input type="text" class="form-control" id="address_2" name="address_2" value="{{ $user->address_1 }}" placeholder=""
                   required>
            <span id="error_address_2" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4">
            <label for=""> Is Approved ? </label><br/>
            <input type="radio" name="is_approved" class="flat-green"
                   value="1" {{ ( $user->is_approved == 1 ) ? 'checked' : '' }} /> Yes
            <input type="radio" name="is_approved" class="flat-green"
                   value="0" {{ ( $user->is_approved == 0 ) ? 'checked' : '' }}/> No
        </div>
        <div class="form-group col-md-4">
            <label for=""> Status </label><br/>
            <input type="radio" name="status" class="flat-green"
                   value="1" {{ ( $user->status == 1 ) ? 'checked' : '' }} /> Active
            <input type="radio" name="status" class="flat-green"
                   value="0" {{ ( $user->status == 0 ) ? 'checked' : '' }}/> In Active
        </div>
        <div class="form-group col-md-4">
            <label for=""> Catalogue Visible </label><br/>
            <input type="radio" name="is_visible" class="flat-green"
                   value="1" {{ ( $user->is_visible == 1 ) ? 'checked' : '' }} /> Yes
            <input type="radio" name="is_visible" class="flat-green"
                   value="0" {{ ( $user->is_visible == 0 ) ? 'checked' : '' }}/> No
        </div>
        <div class="col-md-12 mt-2 mb-2">
        <strong><label>Catalogue Store</label></strong>
        </div>
        @foreach(config('params.catalogue') as $key => $value)
        <div class="form-group col-md-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="catalogue_store[{{$key}}]" id="flexCheckDefault" {{ ( json_decode($user->catalogue_store)[$key] == 1 ) ? 'checked' : '' }}>
              <label class="form-check-label mt-2" for="flexCheckDefault">
                {{ $value }}
              </label>
            </div>
        </div>
        @endforeach
        <div class="clearfix"></div>
        <div class="col-md-12 mb-3 mt-3">
            <button type="submit" class="btn btn-success button-submit"
                    data-loading-text="Loading..."><span class="fa fa-save fa-fw"></span> Save
            </button>
        </div>
    </div>
</form>

<script>
    var dateToday = new Date(); 
    $( "#datepicker" ).datetimepicker({
        dateFormat: 'dd/mm/yy',
        showSecond: true,
        timeFormat: 'HH:mm:ss',
      changeMonth: true,
      changeYear: true,
      autoClose: true,
      pick12HourFormat: false,
    });
    $(document).ready(function () {

        $('input[type="checkbox"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green',
        });
        $('input[type="radio"].flat-green').iCheck({
            radioClass: 'iradio_flat-green'
        });

        $('#edit').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                name: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                name: {
                    required: 'Enter Role Name'
                }
            },
            submitHandler: function (form) {

                var list_id = [];
                $(".data-check:checked").each(function () {
                    list_id.push(this.value);
                });

                var myData = new FormData($("#edit")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);
                myData.append('roles', list_id);

                $.ajax({
                    url: 'users/' + '{{ $user->id }}',
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {

                        if (data.type === 'success') {
                            swal("Done!", "It was succesfully done!", "success");
                            reload_table();
                            notify_view(data.type, data.message);
                            $('#loader').hide();
                            $("#submit").prop('disabled', false); // disable button
                            $("html, body").animate({scrollTop: 0}, "slow");
                            $('#myModal').modal('hide'); // hide bootstrap modal

                        } else if (data.type === 'error') {
                            if (data.errors) {
                                $.each(data.errors, function (key, val) {
                                    $('#error_' + key).html(val);
                                });
                            }
                            $("#status").html(data.message);
                            $('#loader').hide();
                            $("#submit").prop('disabled', false); // disable button
                            swal("Error sending!", "Please try again", "error");

                        }

                    }
                });

            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });
</script>