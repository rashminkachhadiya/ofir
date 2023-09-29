<form id='edit' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
      novalidate>
    {{method_field('PATCH')}}
    <div class="form-row">
        <div id="status"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Status </label>
            {!! Form::select('status', config('params.order_status') ?? [],  $order->order_status ?? '', ['class' => 'form-control select2','data-control'=>"select2", 'id'=>'status']) !!}
            <span id="error_title" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Status Notes </label>
            <textarea type="text" class="form-control" id="notes" name="status_notes" value="" placeholder="">{{ $order->status_notes }}</textarea>
            <span id="error_item_code" class="has-error"></span>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success button-submit"
                data-loading-text="Loading..."><span class="fa fa-save fa-fw"></span> Save
        </button>
    </div>
</form>
<script>

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
                title: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                name: {
                    required: 'Enter Title Name'
                }
            },
            submitHandler: function (form) {

                var list_id = [];

                var myData = new FormData($("#edit")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);
                myData.append('roles', list_id);

                $.ajax({
                        url: 'order/' + '{{ $order->id }}',
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