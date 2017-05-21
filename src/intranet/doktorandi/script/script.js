
$(document).ready(function() {

    var selectCategory = document.getElementById('selectCategory');
    var newCategory = document.getElementById('newCategory');

    var attachFile = document.getElementById('attachFile');
    var attachLink = document.getElementById('attachLink');

    $('input:radio[name="categ"]').change(function() {
        if ($(this).is(':checked') && $(this).val() == 'choose') {
            selectCategory.style.display = "block";
            newCategory.style.display = "none";
        }
        if ($(this).is(':checked') && $(this).val() == 'create') {
            selectCategory.style.display = "none";
            newCategory.style.display = "block";
        }
    });

    $('input:radio[name="attach"]').change(function() {
        if ($(this).is(':checked') && $(this).val() == 'file') {
            attachFile.style.display = "block";
            attachLink.style.display = "none";
        }
        if ($(this).is(':checked') && $(this).val() == 'link') {
            attachFile.style.display = "none";
            attachLink.style.display = "block";
        }
    });

});

