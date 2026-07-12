/**
 * Keep sidebar collapsed by default on desktop.
 * ArchitectUI main.js removes closed-sidebar on viewports >= 1250px — this overrides that.
 */
(function ($) {
    'use strict';

    var userExpanded = false;
    var MOBILE_BREAKPOINT = 1250;

    function syncToggleButtons() {
        var collapsed = $('.app-container').hasClass('closed-sidebar');
        $('.close-sidebar-btn').toggleClass('is-active', collapsed);
    }

    function applySidebarState() {
        var $container = $('.app-container');
        var isNarrow = window.innerWidth < MOBILE_BREAKPOINT;

        if (isNarrow) {
            $container.addClass('closed-sidebar-mobile');
            $container.addClass('closed-sidebar');
            return;
        }

        $container.removeClass('closed-sidebar-mobile');

        if (userExpanded) {
            $container.removeClass('closed-sidebar');
        } else {
            $container.addClass('closed-sidebar');
        }

        syncToggleButtons();
    }

    $(function () {
        // Run after ArchitectUI init (main.js also runs on document.ready).
        setTimeout(applySidebarState, 0);

        $(window).on('resize.lebarSidebar', function () {
            setTimeout(applySidebarState, 0);
        });

        $(document).on('click', '.close-sidebar-btn', function () {
            setTimeout(function () {
                userExpanded = !$('.app-container').hasClass('closed-sidebar');
                syncToggleButtons();
            }, 0);
        });
    });
})(jQuery);
