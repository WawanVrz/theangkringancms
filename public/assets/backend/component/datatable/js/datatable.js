$.fn.puzzdatatable = function(options) {

    var dt = this;
    var dtActionURL = dt.find('#datatable_action').attr('action');
    var dtToken = dt.find("[name='_token']").val();
    var select_all = false;
    var unselect_all = true;
    var selected_items = [''];
    var unselected_items = [''];
    var selected_items_num = 0;
    var bulk_action = false;

    dt.find('.datatable-datepicker-input').datepicker({
        changeMonth: true,
        changeYear: true
    });

    dt.find('input.number-only').keypress(function() {
        return event.charCode >= 48 && event.charCode <= 57
    });

    function dtAjax(data) {

        var isSearch = false;

        dtPopulateItems(data);

        $(dt).block({
            message: '<i class="icon-spinner2 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none'
            }
        });

        $.ajax({
            url: dtActionURL,
            type: 'POST',
            dataType: 'json',
            data: { datatable_id: $(dt).attr('id'), datatable_params: data, _token: dtToken },
            success: function(result) {
                // console.log(result);
                dt.find('#datatable_params').val(JSON.stringify(result.datatable_params));

                dt.find('#datatable_total_page').html(result.datatable_params.total_pages);
                dt.find('#datatable_total_rows').html(result.datatable_params.total_rows);
                if (result.datatable_params.total_pages == 1) {
                    dt.find('.datatable-btn-page-next').addClass('disabled');
                }

                dt.find('.datatable-filter .datatable-search-field').each(function() {
                    var column = $(this).attr('data-search');
                    var search_type = $(this).attr('data-search-type');
                    if (search_type == 'range') {
                        $(this).val(result.datatable_params.search[column].value[$(this).attr('data-search-base')]);
                    } else {
                        $(this).val(result.datatable_params.search[column].value[0]);
                    }
                    if ($(this).val() != '') isSearch = true;
                });

                if (isSearch) dt.find('.datatable-btn-reset').show();
                else dt.find('.datatable-btn-reset').hide();

                select_all = result.datatable_params.select_all;
                unselect_all = result.datatable_params.unselect_all;
                selected_items = result.datatable_params.selected_items;
                unselected_items = result.datatable_params.unselected_items;
                selected_items_num = result.datatable_params.selected_items_num;
                dt.find('#selected_items').html(selected_items_num);

                if (result.data.length > 0) {
                    rows = '';
                    for (i in result.data) {
                        rows += '<tr>';
                        if (result.datatable_params['bulk']) {
                            var checked = '';
                            if (result.datatable_params.select_all == 'true') {
                                if ($.inArray(result.data[i].id.toString(), result.datatable_params.unselected_items) == -1) checked = 'checked="checked"';
                            }
                            if (result.datatable_params.selected_items.length > 0) {
                                if ($.inArray(result.data[i].id.toString(), result.datatable_params.selected_items) > -1) checked = 'checked="checked"';
                            }
                            rows += '<td><input class="datatable-item-checkbox" type="checkbox" ' + checked + ' value="' + result.data[i].id + '"></td>';
                        }
                        for (var attr in result.data[i]) {
                            rows += '<td>' + result.data[i][attr] + '</td>';
                        }
                        if (result.datatable_params['action_column']) {
                            // rows += '<td>edit</td>';
                            // rows += '<td><a href="' + dt.find('#action_edit').val() + '/' + result.data[i]['id'] + '">Edit</a></td>';
                            rows += '<td class="datatable-action-single">' +
                                '<div class="btn-group">' +
                                '<a href="' + result.action_single[0]['callback'] + result.data[i].id.toString() + '" type="button" class="btn btn-default action-single-main-button"><i class="' + result.action_single[0]['icon'] + '"></i> ' + result.action_single[0]['label'] + '</a>';
                            if (result.action_single.length > 1) {
                                rows += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button><ul class="dropdown-menu dropdown-menu-right">';
                                for (var j = 1; j < result.action_single.length; j++) {
                                    var label = result.action_single[j]['label'];
                                    label = label.toLowerCase().replace(/\b[a-z]/g, function(letter) { return letter.toUpperCase(); });
                                    if (result.action_single[j]['spacer']) rows += '<li style="border-top: 1px solid #DDD;">';
                                    else rows += '<li>';
                                    if (result.action_single[j]['actionpage'] == 'newpage') rows += '<a target="_blank" ';
                                    else rows += '<a ';
                                    if (result.action_single[j]['alert']) rows += 'class="action-single-button" data-message="' + result.action_single[j]['alert_message'] + '" href="' + result.action_single[j]['callback'] + result.data[i].id.toString() + '">';
                                    else rows += 'href="' + result.action_single[j]['callback'] + result.data[i].id.toString() + '">';
                                    rows += '<i class="' + result.action_single[j]['icon'] + '"></i> ' + label + '</a></li>';
                                }
                            }
                            rows += '</div></td>';
                        }
                        rows += '</tr>';
                    }
                } else {
                    rows = '<tr><td id="no_data" class="data-align-center" colspan="' + dt.find('.datatable-column-name th').length + '">No Data Found</td></tr>';
                }
                dt.find('tbody').html(rows);
            }
        }).always(function() {
            $(dt).unblock();
            if (bulk_action) {
                setTimeout(function() {
                    swal({
                            title: dt.find('#bulk_action_message_success').val(),
                            confirmButtonColor: "#66BB6A",
                            type: "success",
                        },
                        function(isConfirm) {
                            location.reload();
                        }
                    );
                    bulk_action = false;
                }, 200);
            }
        });
    }

    function dtSearch() {

        // Get Datatable configuration
        var data = $.parseJSON(dt.find('#datatable_params').val());

        // Reset paging value
        dt.find('.datatable-btn-page').removeClass('disabled');
        dt.find('.datatable-btn-page').each(function() {
            if ($(this).attr('data-page') == 'prev') $(this).addClass('disabled');
        });
        data.current_page = 1;
        dt.find('#datatable_page').val(data.current_page);

        // Collect every search field value
        dt.find('.datatable-filter .datatable-search-field').each(function() {
            var column = $(this).attr('data-search');
            var search_type = $(this).attr('data-search-type');
            if (search_type == 'range') {
                data.search[column].value[$(this).attr('data-search-base')] = $(this).val();
            } else {
                data.search[column].value[0] = $(this).val();
            }
        });
        setSelectedItems('none');
        dtAjax(data);
    }

    function dtPopulateItems(data) {
        data.select_all = select_all;
        data.unselect_all = unselect_all;
        data.selected_items = selected_items;
        data.unselected_items = unselected_items;
        data.selected_items_num = selected_items_num;
    }

    function setSelectedItems(item) {
        if (item == 'all') {
            select_all = true;
            unselect_all = false;
            selected_items = [''];
            unselected_items = [''];
            selected_items_num = parseInt(dt.find('#datatable_total_rows').html());
            dt.find('#selected_items').html(selected_items_num);
            dt.find('.datatable-item-checkbox').each(function() {
                $(this).prop('checked', true);
            });
        } else {
            select_all = false;
            unselect_all = true;
            selected_items = [''];
            unselected_items = [''];
            selected_items_num = 0;
            dt.find('#selected_items').html(selected_items_num);
            dt.find('.datatable-item-checkbox').each(function() {
                $(this).prop('checked', false);
            });
        }
    }

    dt.find('.datatable-btn-search').click(function() {
        dtSearch();
    });

    dt.find('.datatable-btn-reset').click(function() {
        dt.find('.datatable-search-field').val('');
        dtSearch();
    });

    dt.find('.datatable-filter input').keypress(function() {
        // If press enter on textbox
        if (event.charCode == 13) dtSearch();
    });

    dt.find('#datatable_page').keypress(function() {
        // If press enter on textbox
        if (event.charCode == 13) {
            if (parseInt($(this).val()) > parseInt(dt.find('#datatable_total_page').html())) {
                $(this).val(parseInt(dt.find('#datatable_total_page').html()));
            }
            dt.find('.datatable-btn-page').removeClass('disabled');
            if (parseInt($(this).val()) == 1) dt.find('.datatable-btn-page-prev').addClass('disabled');
            if (parseInt($(this).val()) == parseInt(dt.find('#datatable_total_page').html())) dt.find('.datatable-btn-page-next').addClass('disabled');

            var data = $.parseJSON(dt.find('#datatable_params').val());
            data.current_page = parseInt($(this).val());
            dtAjax(data);
        }
    });

    dt.find('.datatable-btn-page').click(function() {
        if (!$(this).hasClass('disabled')) {
            var data = $.parseJSON(dt.find('#datatable_params').val());
            dt.find('.datatable-btn-page').removeClass('disabled');
            if ($(this).attr('data-page') == 'next') {
                data.current_page = parseInt(data.current_page) + 1;
                if (data.current_page == parseInt(dt.find('#datatable_total_page').html())) $(this).addClass('disabled');
            } else {
                data.current_page = parseInt(data.current_page) - 1;
                if (data.current_page == 1) $(this).addClass('disabled');
            }
            dt.find('#datatable_page').val(data.current_page);
            dtAjax(data);
        }
    });

    dt.find('.datatable-per-page').change(function() {
        var data = $.parseJSON(dt.find('#datatable_params').val());
        // Reset paging value
        dt.find('.datatable-btn-page').removeClass('disabled');
        dt.find('.datatable-btn-page').each(function() {
            if ($(this).attr('data-page') == 'prev') $(this).addClass('disabled');
        });
        data.current_page = 1;
        dt.find('#datatable_page').val(data.current_page);
        data.current_view_per_page = $(this).val();
        dtAjax(data);
    });

    dt.find('.datatable-sort-action').click(function() {
        var data = $.parseJSON(dt.find('#datatable_params').val());
        var field = $(this).attr('data-sort');
        var order = 'asc';
        $.each(data.order_by, function(key, value) {
            if (field == key && value == 'asc') order = 'desc';
        });
        data.order_by = {
            [field]: order
        };
        dt.find('.datatable-sort-action i').removeClass('enable');
        if (order == 'asc') $(this).find('i.sort-asc').addClass('enable');
        else $(this).find('i.sort-desc').addClass('enable');
        dtAjax(data);
    });

    dt.find('.datatable-select-all').click(function() {
        setSelectedItems('all');
    });

    dt.find('.datatable-unselect-all').click(function() {
        setSelectedItems('none');
    });

    dt.find('.datatable-select-visible').click(function() {
        dt.find('.datatable-item-checkbox').each(function() {
            if ($(this).prop('checked') == false) {
                if ($.inArray($(this).val().toString(), selected_items) == -1) {
                    selected_items.push($(this).val());
                    selected_items_num++;
                }
                for (var i = unselected_items.length - 1; i >= 0; i--) {
                    if (unselected_items[i] === $(this).val()) {
                        unselected_items.splice(i, 1);
                    }
                }
                $(this).prop('checked', true);
            }
        });
        dt.find('#selected_items').html(selected_items_num);
    });

    dt.find('.datatable-unselect-visible').click(function() {
        dt.find('.datatable-item-checkbox').each(function() {
            if ($(this).prop('checked') == true) {
                if ($.inArray($(this).val().toString(), unselected_items) == -1) {
                    unselected_items.push($(this).val());
                    selected_items_num--;
                }
                for (var i = selected_items.length - 1; i >= 0; i--) {
                    if (selected_items[i] === $(this).val()) {
                        selected_items.splice(i, 1);
                    }
                }
                $(this).prop('checked', false);
            }
        });
        dt.find('#selected_items').html(selected_items_num);
    });

    dt.on('click', '.datatable-item-checkbox', function() {
        if ($(this).prop('checked')) {
            if ($.inArray($(this).val().toString(), selected_items) == -1) selected_items.push($(this).val());
            for (var i = unselected_items.length - 1; i >= 0; i--) {
                if (unselected_items[i] === $(this).val()) {
                    unselected_items.splice(i, 1);
                }
            }
            selected_items_num++;
        } else {
            if ($.inArray($(this).val().toString(), unselected_items) == -1) unselected_items.push($(this).val());
            for (var i = selected_items.length - 1; i >= 0; i--) {
                if (selected_items[i] === $(this).val()) {
                    selected_items.splice(i, 1);
                }
            }
            selected_items_num--;
        }
        dt.find('#selected_items').html(selected_items_num);
    });

    dt.find('.datatable-bulk-action').change(function() {
        if ($(this).val() != '') {
            if (selected_items_num > 0) {
                dt.find('#bulk_action_method').val($(this).val());
                dt.find('#datatable_modal_confirm .datatable-notification-message').html(dt.find('.datatable-bulk-action :selected').attr('data-message'));
                dt.find('#datatable_modal_confirm').modal('show');
            } else {
                dt.find('#datatable_modal_notification').modal('show');
            }
        }
    });

    dt.find('#bulk_action_confirm').click(function() {
        bulk_action = true;
        var data = $.parseJSON(dt.find('#datatable_params').val());
        dtPopulateItems(data);
        $('#datatable_bulk_data').val(JSON.stringify(data));
        var action = dt.find('.datatable-bulk-action :selected').attr('data-callback');
        dt.find('.form-bulk-action').attr('action', action);
        dt.find('.form-bulk-action').submit();
    });

    dt.on('click', '.action-single-button', function(e) {
        e.preventDefault();
        dt.find('#datatable_modal_confirm_action_single .datatable-notification-message').html($(this).attr('data-message'));
        dt.find('#datatable_modal_confirm_action_single').modal('show');
        dt.find('#single_action_confirm').attr('data-action', $(this).attr('href'));
        dt.find('#single_action_confirm').attr('data-target', $(this).attr('target'));
    });

    dt.find('#single_action_confirm').click(function() {
        if ($(this).attr('data-target') == '_blank') window.open($(this).attr('data-action'), '_blank');
        else window.location.href = $(this).attr('data-action');
    });

    dt.find('#datatable_modal_notification').on('hidden.bs.modal', function() {
        dt.find('.datatable-bulk-action').val('');
        dt.find('.datatable-bulk-action').selectpicker('refresh');
    });

    dt.find('#datatable_modal_confirm').on('hidden.bs.modal', function() {
        dt.find('.datatable-bulk-action').val('');
        dt.find('.datatable-bulk-action').selectpicker('refresh');
    });

};