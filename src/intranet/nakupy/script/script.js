$(document).ready(function() {
    var content = document.getElementById('content');
    var editor = document.getElementById('editor');
    var button_edit = document.getElementById('Edit');
    var button_cancel = document.getElementById('Cancel');
    var button_save = document.getElementById('Save');

    // TODO: nacitanie noveho textu z DB

    $('#Edit').on('click', function() {
        //tinyMCE.activeEditor.setContent('');
        tinyMCE.activeEditor.setContent(content.innerHTML);
        content.style.display = "none"; // obsah stranky
        editor.style.display = "inline";
        button_edit.style.display = "none"; // buttony
        button_cancel.style.display = "inline";
        button_save.style.display = "inline";
        return false;
    });

    $('#Cancel').on('click', function() {
        content.style.display = "inline"; // obsah stranky
        editor.style.display = "none";
        button_edit.style.display = "inline"; // buttony
        button_cancel.style.display = "none";
        button_save.style.display = "none";
        return false;
    });

    $('#Save').on('click', function() {
        // TODO: AJAX na ulozenie noveho textu do DB
        content.style.display = "inline"; // obsah stranky
        editor.style.display = "none";
        button_edit.style.display = "inline"; // buttony
        button_cancel.style.display = "none";
        button_save.style.display = "none";
        return false;
    });
});

