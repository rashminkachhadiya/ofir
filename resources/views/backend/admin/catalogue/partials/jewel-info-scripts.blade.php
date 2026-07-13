<script>
(function ($) {
    function initJewelSelect2($container) {
        $container.find('select.jewel-select2, select[data-control="select2"]').each(function () {
            var $select = $(this);

            if ($select.hasClass('select2-hidden-accessible')) {
                $select.select2('destroy');
            }

            $select.select2({
                width: '100%',
                minimumResultsForSearch: 10
            });
        });
    }

    function resetClonedJewelRow($row) {
        $row.find('.select2-container').remove();
        $row.find('.jewel-field-error').remove();

        $row.find('select.jewel-select2, select[data-control="select2"]').each(function () {
            var $select = $(this);
            $select.removeClass('select2-hidden-accessible');
            $select.removeAttr('data-select2-id aria-hidden tabindex');
            $select.val('');
        });

        $row.find('input[type="text"]').val('');
    }

    function updateJewelRowLabels($container) {
        $container.find('.jewel-repeat-row').each(function (index) {
            $(this).find('.jewel-repeat-row__label').text('Entry ' + (index + 1));
        });
    }

    function updateJewelRemoveButtons($container) {
        var $rows = $container.find('.jewel-repeat-row');
        var showRemove = $rows.length > 1;

        $rows.each(function () {
            $(this).find('.jewel-remove-row').toggle(showRemove);
        });
    }

    function reindexJewelRows($container) {
        var prefix = $container.data('name-prefix');

        $container.find('.jewel-repeat-row').each(function (index) {
            var $row = $(this);
            $row.attr('data-index', index);

            $row.find('[name]').each(function () {
                var $field = $(this);
                var name = $field.attr('name');

                if (!name || name.indexOf(prefix + '[') !== 0) {
                    return;
                }

                $field.attr('name', name.replace(
                    new RegExp('^' + prefix.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '\\[\\d+\\]'),
                    prefix + '[' + index + ']'
                ));
            });
        });

        updateJewelRowLabels($container);
        updateJewelRemoveButtons($container);
    }

    function appendJewelRow($container) {
        var $source = $container.find('.jewel-repeat-row').first();

        if (!$source.length) {
            return;
        }

        var $row = $source.clone();
        resetClonedJewelRow($row);
        $container.append($row);
        reindexJewelRows($container);
        initJewelSelect2($row);
    }

    function applyJewelValidationErrors(errors) {
        if (!errors) {
            return;
        }

        $('.jewel-field-error').remove();

        $.each(errors, function (key, message) {
            if (key.indexOf('diamond_info.') !== 0 && key.indexOf('gem_info.') !== 0) {
                return;
            }

            var match = key.match(/^(diamond_info|gem_info)\.(\d+)\.(.+)$/);
            if (!match) {
                return;
            }

            var prefix = match[1];
            var index = match[2];
            var field = match[3];
            var $input = $('[name="' + prefix + '[' + index + '][' + field + ']"]');
            var messageText = Array.isArray(message) ? message[0] : message;

            if ($input.length) {
                $input.closest('.form-jewel-field').append(
                    '<span class="jewel-field-error">' + messageText + '</span>'
                );
            }
        });
    }

    window.applyJewelValidationErrors = applyJewelValidationErrors;

    $(document).ready(function () {
        initJewelSelect2($('.jewel-repeat-section'));

        $('body').on('click', '.jewel-add-row', function () {
            var targetId = $(this).data('target');
            var $container = $('#' + targetId);

            if ($container.length) {
                appendJewelRow($container);
            }
        });

        $('body').on('click', '.jewel-remove-row', function () {
            var $container = $(this).closest('.jewel-repeat-rows');

            if ($container.find('.jewel-repeat-row').length <= 1) {
                return;
            }

            var $row = $(this).closest('.jewel-repeat-row');
            $row.find('select.jewel-select2').each(function () {
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2('destroy');
                }
            });

            $row.remove();
            reindexJewelRows($container);
        });
    });
})(jQuery);
</script>
