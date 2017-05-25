
$(document).ready(function() {
    // TODO: nacitanie noveho textu z DB

    $('.div-hover').on('click', function() {
        tinyMCE.activeEditor.setContent(document.getElementById(this.id).innerHTML);
        document.getElementById("Save").value = this.id;
        document.getElementById("Delete").value = this.id;
        document.getElementById("Save").style.display = "inline";
        document.getElementById("Delete").style.display = "inline";
        document.getElementById("Add").style.display = "none";
    });

    $('#add').on('click', function() {
        tinyMCE.activeEditor.setContent("");
        document.getElementById("Save").style.display = "none";
        document.getElementById("Delete").style.display = "none";
        document.getElementById("Add").style.display = "inline";
    });



});

function saveText() {
    tinyMCE.triggerSave()
}

// Prevent bootstrap dialog from blocking focusin
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});