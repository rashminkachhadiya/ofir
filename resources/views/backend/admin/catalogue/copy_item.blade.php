<form id='edit' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
      novalidate>
      <div class="form-row">
    @foreach(config('params.catalogue') as $key => $value)
    <div class="form-group col-md-2">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" name="catalogue_store[{{$key}}]" id="flexCheckDefault">
          <label class="form-check-label mt-2" for="flexCheckDefault">
            {{ $value }}
          </label>
        </div>
    </div>
    @endforeach
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
                    url: 'catalogue-save/' + '{{ $item->id }}',
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