function blockContainer(container) {
    $(container).find('.form-message').hide();
    $(container).block({
        message: $(container).find('.blockui-message'),
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            color: '#fff',
            border: 0,
            padding: 0,
            backgroundColor: 'transparent'
        }
    });
    var animation = "fadeInDown";
    $(container).find('.blockui-message').addClass("animated " + animation).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function() {
        $(this).removeClass("animated " + animation);
    });
}

function unBlockContainer(container, message, callback) {
    var default_message = $(container).find('.blockui-message-text').html();
    $(container).find('.blockui-message-text').html(message);
    setTimeout(function() {
        $(container).unblock({
            onUnblock: function() {
                $(container).find('.blockui-message-text').html(default_message);
            }
        });
    }, 1500);
}

function unBlockContainerWithSuccess(container, message, callback) {
    var default_message = $(container).find('.blockui-message-text').html();
    setTimeout(function() {
        $(container).unblock({
            onUnblock: function() {
                var msg = '<ul style="list-style:none;"><li>' + message + '</li></ul>';
                $(container).find('.blockui-message-text').html(default_message);
                $(container).find('.form-message.alert-success').show();
                $(container).find('.form-message').html(msg);
            }
        });
    }, 1500);
}

function unBlockContainerWithError(container, message, response, callback) {
    var default_message = $(container).find('.blockui-message-text').html();
    $(container).find('.blockui-message-text').html(message);
    setTimeout(function() {
        $(container).unblock({
            onUnblock: function() {
                if (response.message.length > 1) var msg = '<ul>';
                else var msg = '<ul style="list-style:none;">';
                $(response.message).each(function(k, v) { msg += '<li>' + v + '</li>'; });
                msg += '</ul>';
                $(container).find('.blockui-message-text').html(default_message);
                $(container).find('.form-message.alert-warning').show();
                $(container).find('.form-message').html(msg);
                console.log(response);
            }
        });
    }, 1500);
}

function getUrlVars() {
    var vars = {},
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        // vars.push(hash[0]);
        vars[hash[0]] = hash[1];
        // vars.hash[0] = hash[1];
    }
    return vars;
}

$(function() {

    // Select box style
    // Override defaults
    $.fn.selectpicker.defaults = {
        iconBase: '',
        tickIcon: 'icon-checkmark3'
    }
    $('.bootstrap-select').selectpicker();
    $('.bootstrap-select').show();

    $('.select').select2({
        minimumResultsForSearch: "-1"
    });
    $('.select-fixed').select2({
        minimumResultsForSearch: "-1",
        width: 250
    });
    $('.select-search').select2();

    // Checkbox style
    $(".control-info").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-info-600 text-info-800'
    });

    // Tags input
    $('.tags-input').tagsinput();

    // Max Length
    $('.maxlength-textarea').maxlength({
        alwaysShow: true
    });

    // Switch
    $('.switch').bootstrapSwitch();

    // Delete dialog
    $('.btn-delete').on('click', function() {
        var btn = $(this);
        bootbox.confirm({
            title: $(btn).attr('data-title'),
            message: $(btn).attr('data-message'),
            buttons: {
                confirm: {
                    label: $(btn).attr('data-label-confirm')
                },
                cancel: {
                    label: $(btn).attr('data-label-cancel')
                }
            },
            closeButton: false,
            size: $(btn).attr('data-size'), // large or small
            className: 'modal-dialog-confirm',
            callback: function(result) {
                if (result) {
                    window.location.href = $(btn).attr('data-action');
                }
            }
        });
    });

    $('.website-scope').on('change', function() {
        $('.website-scope-icon').removeClass('icon-earth');
        $('.website-scope-icon').addClass('icon-spinner9');
        $('.website-scope-icon').addClass('spinner');
        var url = $('#change_website_scope_url').val() + '/' + $(this).val();
        $.ajax(url, {
            success: function(data) {
                $('.website-scope-icon').removeClass('icon-spinner9');
                $('.website-scope-icon').removeClass('spinner');
                $('.website-scope-icon').addClass('icon-earth');
                location.reload();
            }
        });
    });

    $('.website-scope-url').on('change', function() {
        $('.website-scope-icon').removeClass('icon-earth');
        $('.website-scope-icon').addClass('icon-spinner9');
        $('.website-scope-icon').addClass('spinner');
        var url = $('#baseurl').val() + window.location.pathname + '?';
        var urlVar = getUrlVars();
        var t = this;
        $.each(urlVar, function(k, v) {
            if (k == 'website') url += k + '=' + $(t).val() + '&';
            else url += k + '=' + v + '&';
        });
        url = url.slice(0, -1);
        window.location = url;
    });

    $('.website-scope-url-v2').on('change', function() {
        $('.website-scope-icon').removeClass('icon-earth');
        $('.website-scope-icon').addClass('icon-spinner9');
        $('.website-scope-icon').addClass('spinner');
        var url = 'menu?';
        var urlVar = getUrlVars();
        var t = this;
        $.each(urlVar, function(k, v) {
            if (k == 'website') url += k + '=' + $(t).val() + '&';
            else url += k + '=' + v + '&';
        });
        url = url.slice(0, -1);
        window.location = url;
    });

    $('.website-scope-url-v3').on('change', function() {
        $('.website-scope-icon').removeClass('icon-earth');
        $('.website-scope-icon').addClass('icon-spinner9');
        $('.website-scope-icon').addClass('spinner');
        var url = 'language?';
        var urlVar = getUrlVars();
        var t = this;
        $.each(urlVar, function(k, v) {
            if (k == 'website') url += k + '=' + $(t).val() + '&';
            else url += k + '=' + v + '&';
        });
        url = url.slice(0, -1);
        window.location = url;
    });

    $('.website-scope-url-v4').on('change', function() {
        $('.website-scope-icon').removeClass('icon-earth');
        $('.website-scope-icon').addClass('icon-spinner9');
        $('.website-scope-icon').addClass('spinner');
        var url = 'homepage?';
        var urlVar = getUrlVars();
        var t = this;
        $.each(urlVar, function(k, v) {
            if (k == 'website') url += k + '=' + $(t).val() + '&';
            else url += k + '=' + v + '&';
        });
        url = url.slice(0, -1);
        window.location = url;
    });

    $('.use-default-checkbox').on('change', function() {
        var target = $(this).attr('data-target');
        if ($(this).is(':checked')) {
            $('#' + target).attr('disabled', 'disabled');
            if ($('#' + target).hasClass('editor')) {
                var editorName = $('#' + target).attr('name');
                CKEDITOR.instances[editorName].setReadOnly(true);
            }
            if ($('#' + target).is('select')) {
                $('#' + target + '_select-all-values').attr('disabled', 'disabled');
                $('#' + target + '_deselect-all-values').attr('disabled', 'disabled');
                $('#' + target).selectpicker('refresh');
            }
            if ($('#' + target).attr('type') == 'file') {
                $('#' + target).fileinput('disable');
            }
        } else {
            $('#' + target).removeAttr('disabled');
            if ($('#' + target).hasClass('editor')) {
                var editorName = $('#' + target).attr('name');
                CKEDITOR.instances[editorName].setReadOnly(false);
            }
            if ($('#' + target).is('select')) {
                $('#' + target + '_select-all-values').removeAttr('disabled');
                $('#' + target + '_deselect-all-values').removeAttr('disabled');
                $('#' + target).selectpicker('refresh');
            }
            if ($('#' + target).attr('type') == 'file') {
                $('#' + target).fileinput('enable');
            }
        }
    });

    $('#section_en').hide();
    $('#section_id').hide();
    $('#section_fr').hide();
    $('#section_de').hide();

    $('.ceklocale').click(function(){
        if($(this).val() == 'en'){
            $('#localeset').val($(this).val());
            $('#section_en').slideDown();
            $('#section_id').hide();
            $('#section_fr').hide();
            $('#section_de').hide();
        }
        else if($(this).val() == 'id')
        {
            $('#localeset').val($(this).val());
            $('#section_en').hide();
            $('#section_id').slideDown();
            $('#section_fr').hide();
            $('#section_de').hide();
        }
        else if($(this).val() == 'fr')
        {
            $('#localeset').val($(this).val());
            $('#section_en').hide();
            $('#section_id').hide();
            $('#section_fr').slideDown();
            $('#section_de').hide();
        }
        else if($(this).val() == 'de')
        {
            $('#localeset').val($(this).val());
            $('#section_en').hide();
            $('#section_id').hide();
            $('#section_fr').hide();
            $('#section_de').slideDown();
        }else{
            $('#localeset').val($(this).val());
            $('#section_en').hide();
            $('#section_id').hide();
            $('#section_fr').hide();
            $('#section_de').hide();
        }
    });
});