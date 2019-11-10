$(document).ready(function() {

    var selectedGalleryImage;

    var validator = $(".form-validate-jquery").validate({
        ignore: 'input[type=hidden], .select2-input', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        validClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function(error, element) {

            element.removeClass('validation-valid');
            element.addClass('has-error');

            // password generator
            if (element.parent().parent().hasClass('label-indicator-absolute')) {
                error.appendTo(element.parent().parent().parent());
            }
            // Styled checkboxes, radios, bootstrap switch
            else if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent().parent().parent());
                } else {
                    error.appendTo(element.parent().parent().parent().parent().parent());
                }
            }
            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo(element.parent().parent().parent());
            }
            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo(element.parent().parent());
            }
            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            } else {
                error.insertAfter(element);
            }
        },
        success: function(label, element) {
            label.remove();
            $(element).removeClass('has-error');
            $(element).addClass('validation-valid');
        },
        // rules: {
        //     canonical_url: {
        //         slug: true
        //     }
        // },
        messages: {
            title: {
                required: $('input[name=title]').attr('data-error-message')
            }
            // },
            // canonical_url: {
            //     slug: $('.canonical_url').attr('data-error-message')
            // }
        }
    });

    $('.tags-input').tagsinput();

    $(".radio-control-primary").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-primary-600 text-primary-800'
    });

    $("#publish_time_picker").AnyTime_picker({
        format: "%b %d, %Y %H:%i",
    });

    $(".page-crud-sidebar .styled").uniform({
        radioClass: 'choice'
    });

    $('#publish_status').on('change', function() {
        $('#page_publish_status').val($(this).val());
    });

    $('#content_publish_time').on('click', function() {
        if (!$('#content_publish_time_container').hasClass('container-active')) {
            $('#content_publish_time_container').addClass('container-active');
            if ($('#content_publish_time').attr('data-val') == '1') {
                $('#publish_time_picker').val($('#content_publish_time').html());
                $('#content_publish_time_container .date-time-container').show();
            }
            $('#content_publish_time_container').slideDown();
        } else {
            publishTimeCancel();
        }
    });

    $('#content_publish_time_container .radio input:radio').on('change', function() {
        if ($(this).hasClass('publish-default')) $('#content_publish_time_container .date-time-container').hide();
        else $('#content_publish_time_container .date-time-container').show();
    });

    $('#content_publish_time_container .publish-time-action-button.button-ok').on('click', function() {
        if ($('#radio_publish_default').prop('checked') == true) {
            $('#content_publish_time').attr('data-val', '0');
            $('#page_publish_time').val('0');
            $('#content_publish_time').html($('#content_publish_time').attr('data-text'));
        } else {
            if ($('#publish_time_picker').val() == '') {
                $('#publish_time_picker').val(moment().format('MMM Do YYYY HH:mm'));
            }
            $('#content_publish_time').attr('data-val', '1');
            $('#page_publish_time').val(moment($('#publish_time_picker').val()).format('YYYY-MM-DD HH:mm:ss'));
            $('#content_publish_time').html($('#publish_time_picker').val());
        }
        $('#content_publish_time_container').removeClass('container-active');
        $('#content_publish_time_container').slideUp();
    });

    $('#content_publish_time_container .publish-time-action-button.button-cancel').on('click', function() {
        publishTimeCancel();
    });

    $('#page_template_selector').on('change', function() {
        $('#page_template').val($(this).val());
    });

    $('#page_order_field').on('change', function() {
        $('#page_order').val($(this).val());
    });

    $('.filemanager-trigger').on('click', function() {
        var filemanager = $(this).attr('data-filemanager');
        var trigger = $(this).attr('id');
        $('.iframe-modal').on('shown.bs.modal', function() {
            $(this).attr('data-trigger', trigger);
            $(this).find('iframe').attr('src', filemanager);
        });
    });

    $('.iframe-modal').on('hidden.bs.modal', function() {
        $(this).find('iframe').removeAttr('src');
        if ($(this).attr('data-trigger') == 'feature-image-trigger') {
            featuredImagesApply();
        } else if ($(this).attr('data-trigger') == 'images-gallery-trigger') {
            imagesGalleryApply();
        } else if ($(this).attr('data-trigger') == 'feature-video-trigger') {
            featuredVideoApply();
        }
    });

    $('.iframe-modal iframe').on('load', function() {
        var h = $(this).height() - 1;
        $(this).height(h + 'px');
    });

    $('.featured-image-delete').on('click', function() {
        $('#featured_image_field').val('');
        $('.featured-image-icon').show();
        $('.featured-image-thumb-container').hide();
        $('.featured-image-meta').val('');
        $('.featured-image-meta-container').hide();
    });

    $(document).on('click', '.images-galley-thumb-container', function() {
        $('.images-galley-thumb-container').removeClass('image-active');
        selectedGalleryImage = this;
        $(this).addClass('image-active');
        $('.images-gallery-meta-images img').attr('src', $(this).attr('data-url'));
        $('.images-gallery-meta-input.title').val($(this).attr('data-title'));
        $('.images-gallery-meta-input.alt').val($(this).attr('data-alt'));
        $('.images-gallery-meta-input.text-label').val($(this).attr('data-label'));
        $('.images-gallery-info .filename').html($(this).attr('data-filename'));
        $('.images-gallery-info .uploaddate').html(moment($(this).attr('data-date')).format('MMMM  D, YYYY'));
        $('.images-gallery-info .filesize').html($(this).attr('data-size'));
        $('.images-gallery-info .dimension').html($(this).attr('data-dimension'));
        $('.images-gallery-meta-body').show();
    });

    $(document).on('click', '.images-galley-thumb-container .images-galley-thumb-action .action-delete', function() {
        var message = $('.images-gallery-field-body').attr('data-delete-image-message');
        var image = $(this).parents('.images-galley-thumb-container');
        bootbox.confirm({
            message: message,
            closeButton: false,
            callback: function(result) {
                if (result) {
                    $(image).remove();
                    $('.images-gallery-meta-body').hide();
                    setActionBarImageGallery();
                }
            }
        });
    });

    $(document).on('click', '.images-galley-thumb-container .images-galley-thumb-action .action-move-up', function() {
        var sibling = $(this).parents('.images-galley-thumb-container').prev('.images-galley-thumb-container');
        var image = $(this).parents('.images-galley-thumb-container');
        $(image).after($(sibling));
        setActionBarImageGallery();
    });

    $(document).on('click', '.images-galley-thumb-container .images-galley-thumb-action .action-move-down', function() {
        var sibling = $(this).parents('.images-galley-thumb-container').next('.images-galley-thumb-container');
        var image = $(this).parents('.images-galley-thumb-container');
        $(image).before($(sibling));
        setActionBarImageGallery();
    });

    $('.images-gallery-meta-input.title').on('keyup', function() {
        $(selectedGalleryImage).attr('data-title', $(this).val());
    });

    $('.images-gallery-meta-input.alt').on('keyup', function() {
        $(selectedGalleryImage).attr('data-alt', $(this).val());
    });

    $('.images-gallery-meta-input.text-label').on('keyup', function() {
        $(selectedGalleryImage).attr('data-label', $(this).val());
    });

    $('.featured-video-selector').on('click', function(e) {
        e.preventDefault();
        $('.icon-featured-video').removeClass('video-icon-active');
        if ($(this).hasClass('select-internal-video')) {
            $('#featured_video_used').val('internal');
            $('.external-video-field').hide();
            $('.internal-video-field').fadeIn();
        } else {
            $('#featured_video_used').val('external');
            $('.internal-video-field').hide();
            $('.external-video-field').fadeIn();
        }
    });

    $('#preview_external_video').on('click', function() {
        if ($('#featured_video_external_link').val() != '') {
            $('.external-video-field .featured-video-thumb iframe').attr('src', $('#featured_video_external_link').val());
            $('.external-video-field .featured-video-thumb').show();
        }
    });

    $('.seo-field-meta-title').on('keyup', function() {
        var siteTitle = $('.snippet-meta-title').attr('data-site-title');
        var metaTitle = ucwords($(this).val());
        if (metaTitle != '') $('.snippet-meta-title').html(metaTitle + ' | ' + siteTitle);
        else $('.snippet-meta-title').html(siteTitle);
    });

    $('.seo-field-slug').on('keyup', function() {
        var baseurl = $('.snippet-slug').attr('data-baseurl');
        var slug = slugify($(this).val());
        if (slug != '') $('.snippet-slug span').html(baseurl + '/' + slug);
        else $('.snippet-slug span').html(baseurl);
    });

    $('.seo-field-meta-desc').on('keyup', function() {
        var message = $('.snippet-meta-desc').attr('data-message');
        var threshold = $(this).attr('threshold');
        if ($(this).val() != '') {
            var width = $(this).val().length / $(this).attr('maxlength') * 100;
            $('.seo-field-meta-desc-indicator div').css('width', width + '%');
            $('.snippet-meta-desc').html($(this).val());
        } else {
            $('.seo-field-meta-desc-indicator div').css('width', '0');
            $('.snippet-meta-desc').html(message);
        }
        if ($(this).val().length < threshold) $('.seo-field-meta-desc-indicator div').css('background', $(this).attr('warning-color'));
        else $('.seo-field-meta-desc-indicator div').css('background', $(this).attr('fine-color'));
    });

    $('.seo-advanced-field').on('click', function() {
        if ($('.seo-advanced-field-data').hasClass('active')) {
            $('.seo-advanced-field-data').hide();
            $('.seo-advanced-field-data').removeClass('active');
        } else {
            $('.seo-advanced-field-data').fadeIn();
            $('.seo-advanced-field-data').addClass('active');
        }
    });

    $('#button_save').on('click', function() {
        collectImageGallery();
        collectFeaturedImage();
        collectFeaturedVideo();
        $('#page_form').submit();
    });

    $('#button_cancel').on('click', function() {
        window.location.href = $(this).attr('data-action');
    });

    $('#button_delete').on('click', function() {
        window.location.href = $(this).attr('data-action');
    });

    $('#button_preview').on('click', function() {
        window.location.href = $(this).attr('data-action');
    });

    function collectFeaturedImage() {
        var v = $('#featured_image_field').val();
        $('#featured_image_field').val(trimBaseUrl(v));
    }

    function collectImageGallery() {
        var imageGallery = [];
        $('.images-gallery-field-body .images-galley-thumb-container').each(function() {
            var img = {};
            img.title = $(this).attr('data-title');
            img.alt = $(this).attr('data-alt');
            img.label = $(this).attr('data-label');
            img.url = trimBaseUrl($(this).attr('data-url'));
            imageGallery.push(img);
            $('#images_gallery_field_temp').val(JSON.stringify(imageGallery));
        });
    }

    function collectFeaturedVideo() {
        if ($('#featured_video_internal').val() != '') {
            var v = $('#featured_video_internal').val();
            $('#featured_video_internal').val(trimBaseUrl(v));
        }
    }

    function publishTimeCancel() {
        $('#content_publish_time_container').removeClass('container-active');
        $('#content_publish_time_container').slideUp(function() {
            if ($('#content_publish_time').attr('data-val') == '0') {
                $('#radio_publish_default').prop('checked', true);
                $('#content_publish_time_container .date-time-container').hide();
            } else {
                $('#radio_publish_date').prop('checked', true);
            }
            $(".page-crud-sidebar .styled").uniform({
                radioClass: 'choice'
            });
        });
    }

    function featuredImagesApply() {
        if ($('#featured_image_field').val() != '') {
            $('#featured_image_thumb').attr('src', $('#featured_image_field').val());
            $('.featured-image-thumb-container').show();
            $('.featured-image-icon').hide();
            $('.featured-image-meta-container').show();
        } else {
            $('.featured-image-icon').show();
            $('.featured-image-thumb-container').hide();
            $('.featured-image-meta-container').hide();
        }
    }

    function imagesGalleryApply() {
        if ($('#images_gallery_field_temp').val() != '') {
            var images = JSON.parse($('#images_gallery_field_temp').val());
            var html = data = '';
            var moveUp = $('.images-gallery-field-body').attr('data-moveup');
            var moveDown = $('.images-gallery-field-body').attr('data-movedown');
            var deleteImage = $('.images-gallery-field-body').attr('data-delete-image');
            for (var i = 0; i < images.length; i++) {
                data = '';
                data += ' data-url="' + images[i].url + '" ';
                data += ' data-filename="' + images[i].filename + '" ';
                data += ' data-dimension="' + images[i].dimension + '" ';
                data += ' data-size="' + images[i].size + '" ';
                data += ' data-date="' + images[i].date + '" ';
                data += ' data-title="" ';
                data += ' data-alt="" ';
                data += ' data-label="" ';
                html += '<div class="images-galley-thumb-container" ' + data + '>';
                html += '<img id="featured_image_thumb" src="' + images[i].url + '">';
                html += '<div class="images-galley-thumb-action">';
                html += '<i class="icon-arrow-left32 action-move-up" title="' + moveUp + '"></i>';
                html += '<i class="icon-arrow-right32 action-move-down" title="' + moveDown + '"></i>';
                html += '<i class="icon-trash-alt pull-right action-delete" title="' + deleteImage + '"></i>';
                html += '</div>';
                html += '</div>';
            }
            $('.images-gallery-field-body').append(html);
            $('#images_gallery_field_temp').val('');
            setActionBarImageGallery();
        }
    }

    function featuredVideoApply() {
        if ($('#featured_video_internal').val() != '') {
            var videoUrl = $('#featured_video_internal').val();
            var filename = videoUrl.split('/').pop();
            var message = $('.internal-video-field .video-container').attr('data-message');
            var html = '<video width="100%" preload="auto" controls>' +
                '<source src="' + videoUrl + '" type="video/mp4">' +
                '<source src="' + videoUrl + '" type="video/ogg">' +
                message +
                '</video>';
            $('.internal-video-filename').html(filename);
            $('.internal-video-field .video-container').html(html);
            $('.internal-video-field .featured-video-thumb').show();

        } else {
            $('.internal-video-filename').html(' - ');
        }
    }

    function setActionBarImageGallery() {
        var i = 1;
        $('.images-galley-thumb-container .images-galley-thumb-action i').show();
        $('.images-galley-thumb-container').each(function() {
            if (i == 1) $(this).find('.action-move-up').hide();
            if (i == $('.images-galley-thumb-container').length) $(this).find('.action-move-down').hide();
            i++;
        });
    }

    function ucwords(str) {
        return (str + '')
            .replace(/^(.)|\s+(.)/g, function($1) {
                return $1.toUpperCase()
            })
    }

    function slugify(text) {
        var slug = text.toString().toLowerCase()
            .replace(/\s+/g, '-') // Replace spaces with -
            .replace(/[^\w\-]+/g, '') // Remove all non-word chars
            .replace(/\-\-+/g, '-') // Replace multiple - with single -
            .replace(/^-+/, '') // Trim - from start of text
            .replace(/-+$/, ''); // Trim - from end of text
        return slug;
    }

    function trimBaseUrl(url) {
        var baseurl = $('#baseurl').val();
        if (url.indexOf(baseurl) != -1) return url.substring((baseurl.length + 1));
        else return url;
    }
});