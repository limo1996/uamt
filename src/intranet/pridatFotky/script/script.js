$(document).on('click', '.input-remove-row', function(){
    var tr = $(this).closest('tr');
    tr.fadeOut(200, function(){
        tr.remove();
        calc_total()
    });
});

$(function(){
    $('.preview-add-button').click(function(){
        var form_data = {};

        if ($( "#new_album" ).hasClass( "active" )) {
            form_data["fileToUpload"] = $('#fileToUpload').val();
            form_data["album"] = $('.new_album input[name="n_album"]').val();
            form_data["date"] = $('.new_album input[name="date"]').val();
        }
        else {
            form_data["fileToUpload2"] = $('#fileToUpload2').val();
            form_data["album"] = $('.old_album #o_album option:selected').text();
            form_data["date"] = "";
        }

        form_data["remove-row"] = '<span class="glyphicon glyphicon-remove"></span>';
        var row = $('<tr></tr>');
        $.each(form_data, function( type, value ) {
            $('<td class="input-'+type+'"></td>').html(value).appendTo(row);
        });
        $('.preview-table > tbody:last').append(row);
        calc_total();
    });
});