<link href="{{ asset('/assets/datatables/css/dataTables.min.css') }}" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('/assets/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
      type="text/css"/>


<script src="{{ asset('/assets/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/js/jszip.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('/assets/datatables/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('/assets/datatables/js/dataTables.select.min.js') }}"></script>

<style>
    .admin-datatable-scroll,
    .admin-datatable-scroll .dataTables_scroll,
    .admin-datatable-scroll .dataTables_scrollHead,
    .admin-datatable-scroll .dataTables_scrollBody {
        max-width: 100% !important;
        width: 100% !important;
    }

    .admin-datatable-container,
    .app-main__inner > .row > [class*="col-"],
    .main-card,
    .card-body {
        min-width: 0 !important;
    }

    .admin-datatable-container {
        max-width: 100% !important;
        overflow-x: hidden !important;
    }

    .admin-datatable-scroll .dataTables_scrollBody {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch;
    }

    .admin-datatable-scroll .dataTables_scrollHeadInner,
    .admin-datatable-scroll .dataTables_scrollHeadInner table,
    .admin-datatable-scroll .dataTables_scrollBody table {
        min-width: var(--admin-datatable-width, 1100px) !important;
        width: var(--admin-datatable-width, 1100px) !important;
    }

    .admin-datatable-scroll table.dataTable {
        white-space: nowrap;
    }

    @media (max-width: 991.98px) {
        body {
            overflow-x: hidden;
        }

        .app-container,
        .app-main,
        .app-main__outer,
        .app-main__inner,
        .main-card,
        .card-body,
        .table-responsive {
            min-width: 0 !important;
            max-width: 100% !important;
        }

        .app-main .app-main__outer {
            padding-left: 0 !important;
            width: 100% !important;
        }

        .app-main .app-main__inner {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        .app-main__inner > .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .app-main__inner > .row > [class*="col-"] {
            padding-left: 0 !important;
            padding-right: 0 !important;
            min-width: 0 !important;
        }

        .table-responsive {
            overflow-x: hidden !important;
        }
    }
</style>

<script>
    (function ($) {
        if (!$.fn.dataTable) {
            return;
        }

        $.extend(true, $.fn.dataTable.defaults, {
            autoWidth: false,
            scrollX: true,
            scrollXInner: '1100px'
        });

        function getAdminTableWidth(settings) {
            var columnCount = settings && settings.aoColumns ? settings.aoColumns.length : 0;
            var width = 0;

            $(settings.nTHead).find('tr:first th').each(function () {
                var title = $.trim($(this).text()).toLowerCase();

                if (title === '#') {
                    width += 60;
                } else if (title.indexOf('email') !== -1) {
                    width += 240;
                } else if (title.indexOf('action') !== -1) {
                    width += 120;
                } else {
                    width += 110;
                }
            });

            return Math.max(width, columnCount * 105, 900);
        }

        function applyAdminDataTableScroll(settings) {
            if (!settings || !settings.nTable || settings.nTable.id !== 'manage_all') {
                return;
            }

            var width = getAdminTableWidth(settings) + 'px';
            var $wrapper = $(settings.nTableWrapper || settings.nTable).closest('.dataTables_wrapper');

            if (!$wrapper.length) {
                return;
            }

            $wrapper
                .addClass('admin-datatable-scroll')
                .css('--admin-datatable-width', width);

            $wrapper.closest('.table-responsive')
                .addClass('admin-datatable-container');

            $wrapper.find('.dataTables_scrollHeadInner, .dataTables_scrollHeadInner table, .dataTables_scrollBody table')
                .css({
                    minWidth: width,
                    width: width
                });

            $wrapper.find('.dataTables_scrollBody')
                .attr('tabindex', '0')
                .css('overflow-x', 'auto');
        }

        $(document).on('init.dt draw.dt column-sizing.dt', function (event, settings) {
            window.setTimeout(function () {
                applyAdminDataTableScroll(settings);
            }, 0);
        });

        $(window).on('resize orientationchange', function () {
            $.fn.dataTable
                .tables({visible: true, api: true})
                .columns.adjust();
        });
    })(jQuery);
</script>
