$(document).ready(function() {

    $('#selectproduct').on('change', function() {
       var contenID = $(this).val();
       var baselinkcolor = document.getElementById('baselink').value;
       var formToken = $('#form_token').val();

       $.ajax({
            url: baselinkcolor+'/ajaxsetdefault',
            type: 'POST',
            data: "contentid="+contenID+'&_token='+formToken,
            dataType: '',
            success: function(response)
            {
                $('#attrproduct').html(response);
            }
        });
    });


    $('#attrproduct').on('change', '#size', function() {
        var codeName = $(this).find(':selected').data('codename')
        var baselinkcolor = document.getElementById('baselink').value;
        var formToken = $('#form_token').val();

        $.ajax({
            url: baselinkcolor+'/maincolor/set',
            type: 'POST',
            data: "codename="+codeName+'&_token='+formToken,
            dataType: '',
            success: function(response)
            {
                $('#main-color').html(response);
            }
        });

        $.ajax({
            url: baselinkcolor+'/secondcolor/set',
            type: 'POST',
            data: "codename="+codeName+'&_token='+formToken,
            dataType: '',
            success: function(response)
            {
                $('#second-color').html(response);
            }
        });

        $.ajax({
            url: baselinkcolor+'/acchook/set',
            type: 'POST',
            data: "codename="+codeName+'&_token='+formToken,
            dataType: '',
            success: function(response)
            {
                $('#accessories-hook').html(response);
            }
        });
     });

});
