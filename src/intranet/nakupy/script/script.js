
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


    $('.dropdown').on('show.bs.dropdown', function(e){
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
    });
    $('.dropdown').on('hide.bs.dropdown', function(e){
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(300);
    });
    $(".sidebarmenu-toggle").click(function(e) {
        e.preventDefault();
        var elem = document.getElementById("sidebar-wrapper");
        left = window.getComputedStyle(elem,null).getPropertyValue("left");
        if(left == "170px"){
            document.getElementsByClassName("sidebar-toggle")[0].style.left="-170px";
        }
        else if(left == "-170px"){
            document.getElementsByClassName("sidebar-toggle")[0].style.left="170px";
        }
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


$(window).resize(function() {
    var path = $(this);
    var contW = path.width();
    if(contW >= 1480){
        document.getElementsByClassName("sidebar-toggle")[0].style.left="170px";
    }else{
        document.getElementsByClassName("sidebar-toggle")[0].style.left="-170px";
    }
});