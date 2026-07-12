<link href="{{ asset('/assets/datatables/css/dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>

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
    /*
     * Admin DataTables
     * - Single table (no scrollX clone) so headers ALWAYS align with data
     * - All columns visible; horizontal scroll on table area only
     */
    .app-container,
    .app-main,
    .app-main__outer,
    .app-main__inner {
        max-width: 100%;
    }

    .app-main__inner {
        overflow-x: hidden;
    }

    .app-main__inner > .row,
    .app-main__inner > .row > [class*="col-"],
    .main-card,
    .main-card .card-body,
    .admin-datatable-card {
        min-width: 0;
        max-width: 100%;
    }

    .admin-datatable-scroll-hint {
        font-size: 0.75rem;
        color: #6c757d;
        text-align: center;
        padding: 0.35rem 0.5rem;
        margin-bottom: 0.5rem;
        background: #f0f4ff;
        border-radius: 6px;
        border: 1px dashed #c5d0f0;
    }

    .admin-datatable-wrap .dataTables_wrapper {
        width: 100% !important;
        max-width: 100% !important;
        min-width: 0;
    }

    /* Only the table area scrolls — controls stay full-width */
    .admin-dt-table-scroll {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
    }

    .admin-dt-table-scroll.is-scrollable {
        box-shadow: inset -10px 0 10px -10px rgba(0, 0, 0, 0.06);
    }

    .admin-dt-table-scroll table.dataTable {
        width: auto !important;
        min-width: 100%;
        margin: 0 !important;
        table-layout: auto !important;
    }

    .admin-dt-table-scroll table.dataTable thead th {
        position: sticky;
        top: 0;
        z-index: 2;
        background: #f8f9fa;
        vertical-align: middle;
        white-space: nowrap;
        padding: 0.55rem 0.75rem;
    }

    .admin-dt-table-scroll table.dataTable tbody td {
        vertical-align: middle;
        white-space: nowrap;
        padding: 0.55rem 0.75rem;
    }

    .admin-dt-table-scroll table.dataTable tbody td .d-flex {
        flex-wrap: nowrap;
        align-items: center;
        gap: 0.35rem;
    }

    .admin-dt-table-scroll table.dataTable img {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 4px;
        display: block;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 0.75rem;
    }

    .dataTables_wrapper .dataTables_filter input {
        min-height: 36px;
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 0.35rem 0.65rem;
    }

    .dataTables_wrapper .dataTables_info {
        padding-top: 0.75rem;
        font-size: 0.875rem;
        color: #6c757d;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 0.75rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        min-width: 36px;
        min-height: 36px;
        line-height: 36px;
        padding: 0 0.5rem;
        margin-left: 2px;
        border-radius: 6px !important;
    }

    @media (max-width: 991.98px) {
        .app-main .app-main__outer {
            padding-left: 0 !important;
            width: 100% !important;
        }

        .app-main__inner {
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
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            text-align: left !important;
            float: none !important;
            width: 100%;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 100% !important;
            max-width: 100%;
            margin-left: 0 !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination {
            justify-content: center;
            flex-wrap: wrap;
        }
    }
</style>

<script>
    (function ($) {
        if (!$.fn.dataTable) {
            return;
        }

        /*
         * scrollX: false — critical. scrollX clones thead into a separate table
         * which causes header/body column misalignment with HTML cell content.
         */
        $.extend(true, $.fn.dataTable.defaults, {
            autoWidth: false,
            scrollX: false,
            scrollCollapse: false,
            responsive: false,
            lengthMenu: [25, 50, 100],
            dom:
                "<'row align-items-center mb-2'<'col-sm-6'l><'col-sm-6'f>>" +
                "<'admin-dt-table-scroll'tr>" +
                "<'row align-items-center mt-2'<'col-sm-5'i><'col-sm-7'p>>",
            language: {
                lengthMenu: 'Show _MENU_',
                searchPlaceholder: 'Type here to search...'
            }
        });

        function markScrollable(settings) {
            if (!settings || !settings.nTable) {
                return;
            }

            var $scroll = $(settings.nTable).closest('.admin-dt-table-scroll');
            if (!$scroll.length) {
                return;
            }

            var table = settings.nTable;
            $scroll.toggleClass('is-scrollable', table.scrollWidth > $scroll.innerWidth() + 2);
        }

        function styleSearchInput(api) {
            $(api.table().container())
                .find('.dataTables_filter input[type="search"]')
                .attr('placeholder', 'Type here to search...');
        }

        $(document).on('init.dt draw.dt', function (event, settings) {
            if (!settings || !settings.nTable) {
                return;
            }

            window.setTimeout(function () {
                var api = new $.fn.dataTable.Api(settings);
                styleSearchInput(api);
                markScrollable(settings);
            }, 50);
        });

        var resizeTimer;
        $(window).on('resize orientationchange', function () {
            clearTimeout(resizeTimer);
            resizeTimer = window.setTimeout(function () {
                $.fn.dataTable.tables({ visible: true, api: true }).every(function () {
                    markScrollable(this.settings()[0]);
                });
            }, 150);
        });

        $(document).on('click', '.close-sidebar-btn', function () {
            window.setTimeout(function () {
                $.fn.dataTable.tables({ visible: true, api: true }).every(function () {
                    markScrollable(this.settings()[0]);
                });
            }, 350);
        });
    })(jQuery);
</script>
