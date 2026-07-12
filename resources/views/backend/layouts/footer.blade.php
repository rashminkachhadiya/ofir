<div class="app-footer">
    
</div>
<script src="{{ asset('/assets/js/main.js') }}"></script>
<script src="{{ asset('/assets/js/admin-sidebar.js') }}"></script>
<script src="{{ asset('/assets/js/ajax_submit.js') }}"></script>
<script src="{{ asset('/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/js/jquery.plainoverlay.min.js') }}"></script>

<!-- Sweet Alert library -->
<link rel="stylesheet" href="{{ asset('/assets/plugins/sweet-alert/sweetalert.css') }}">
<script src="{{ asset('/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>

<link rel="stylesheet" href="{{ asset('/assets/plugins/select2/select2.min.css') }}">
<script src="{{ asset('/assets/plugins/select2/select2.full.min.js') }}"></script>


<!-- Toastr  library -->
<link rel="stylesheet" href="{{ asset('/assets/plugins/toastr/toastr.min.css') }}">
<script src="{{ asset('/assets/plugins/toastr/toastr.min.js') }}"></script>

<!-- icheck  library -->
<link rel="stylesheet" href="{{ asset('/assets/plugins/iCheck/all.css') }}">
<script src="{{ asset('/assets/plugins/iCheck/icheck.min.js') }}"></script>

<!-- Datepicker library -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<!-- <link rel="stylesheet" href="{{ asset('/assets/plugins/datepicker/datepicker3.css') }}"> -->
<!-- <script src="{{ asset('/assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script> -->
<script src="{{ asset('assets/js/jquery.printElement.min.js') }}"></script>

<script>
    $.fn.modal.Constructor.prototype.enforceFocus = function () {
    };
</script>
<script>

    function notify_view(type, message) {

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr[type](message);

    }
</script>