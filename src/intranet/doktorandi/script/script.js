
$(document).ready(function() {

    var selectCategory = document.getElementById('selectCategory');
    var newCategory = document.getElementById('newCategory');

    var attachFile = document.getElementById('attachFile');
    var attachLink = document.getElementById('attachLink');

    $('input:radio[name="categ"]').change(function() {
        if ($(this).is(':checked') && $(this).val() == 'choose') {
            selectCategory.style.display = "block";
            newCategory.style.display = "none";
            document.getElementById("selectedCategory").required = true;
            document.getElementById("categoryName").required = false;
        }
        if ($(this).is(':checked') && $(this).val() == 'create') {
            selectCategory.style.display = "none";
            newCategory.style.display = "block";
            document.getElementById("selectedCategory").required = false;
            document.getElementById("categoryName").required = true;
        }
    });

    $('input:radio[name="attach"]').change(function() {
        if ($(this).is(':checked') && $(this).val() == 'file') {
            attachFile.style.display = "block";
            attachLink.style.display = "none";
            document.getElementById("fileToUpload").required = true;
            document.getElementById("linkToFile").required = false;
        }
        if ($(this).is(':checked') && $(this).val() == 'link') {
            attachFile.style.display = "none";
            attachLink.style.display = "block";
            document.getElementById("fileToUpload").required = false;
            document.getElementById("linkToFile").required = true;
        }
    });

    $('input:radio[name="attach2"]').change(function() {
        if ($(this).is(':checked') && $(this).val() == 'file2') {
            document.getElementById('attachFile2').style.display = "block";
            document.getElementById('attachLink2').style.display = "none";
          //  document.getElementById("fileToUpload2").required = true;
          //  document.getElementById("linkToFile2").required = false;
        }
        if ($(this).is(':checked') && $(this).val() == 'link2') {
            document.getElementById('attachFile2').style.display = "none";
            document.getElementById('attachLink2').style.display = "block";
           // document.getElementById("fileToUpload2").required = false;
           // document.getElementById("linkToFile2").required = true;
        }
    })


    $(document).on('click', "#update", function () {
        document.getElementById("save").value = this.value;
    });

});

