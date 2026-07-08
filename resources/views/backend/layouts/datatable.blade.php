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
    .app-main__inner > .row > [class*="col-"],
    .main-card,
    .card-body {
        min-width: 0 !important;
    }

    .dataTables_wrapper {
        max-width: 100% !important;
        width: 100% !important;
    }

    .table-responsive > .dataTables_wrapper {
        overflow: visible !important;
    }

    .dataTables_wrapper .dataTables_scroll {
        max-width: 100% !important;
        width: 100% !important;
    }

    .dataTables_wrapper .dataTables_scrollBody {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch;
    }

    .dataTables_wrapper .dataTables_scrollHeadInner,
    .dataTables_wrapper .dataTables_scrollHeadInner table,
    .dataTables_wrapper .dataTables_scrollBody table {
        max-width: none !important;
    }

    .dataTables_wrapper table.dataTable {
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
            scrollCollapse: true,
            orderCellsTop: true
        });

        function scheduleColumnAdjust(settings, api) {
            if (!api || !api.columns || !settings || settings._datatableAlignPending) {
                return;
            }

            settings._datatableAlignPending = true;

            window.requestAnimationFrame(function () {
                api.columns.adjust();

                if (api.responsive && typeof api.responsive.recalc === 'function') {
                    api.responsive.recalc();
                }

                window.setTimeout(function () {
                    settings._datatableAlignPending = false;
                }, 0);
            });
        }

        function bindImageAdjustments(api) {
            var tableNode = api.table().node();

            if (!tableNode) {
                return;
            }

            $(tableNode).find('img').each(function () {
                if (this.complete) {
                    return;
                }

                $(this).one('load.datatableAlign error.datatableAlign', function () {
                    scheduleColumnAdjust(api.settings()[0], api);
                });
            });
        }

        $(document).on('init.dt draw.dt column-sizing.dt', function (event, settings) {
            if (!settings || !settings.nTable) {
                return;
            }

            window.setTimeout(function () {
                var api = new $.fn.dataTable.Api(settings);
                bindImageAdjustments(api);
                scheduleColumnAdjust(settings, api);
            }, 0);
        });

        $(window).on('resize orientationchange', function () {
            window.setTimeout(function () {
                $.fn.dataTable
                    .tables({visible: true, api: true})
                    .columns.adjust();
            }, 0);
        });
    })(jQuery);
</script>
