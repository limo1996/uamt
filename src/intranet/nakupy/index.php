<?php
include_once ("../../database/database.php");
session_start();

if(!$_SESSION['user']){
    header("Location:../index.php");
    die;
}

$db = new Database();

// zistenie roly
//---------------------------------------------
$result = $db->getUserRoles($_SESSION['user']);
$roles = array();
foreach($result as $role)
    $roles[] = $role['ROLE'];
//---------------------------------------------

if(isset($_POST['Add'])) {
    $db->insertPurchase($_POST['textareas']);
    header("Location: index.php");
}

if(isset($_POST['Save'])) {
    $db->updatePurchase($_POST['Save'], $_POST['textareas']);
    header("Location: index.php");
}

if(isset($_POST['Delete'])) {
    $db->deletePurchase($_POST['Delete']);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <title>Intranet</title>

    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=r4y29w5xcesgziqbk6k6sf1gmb3m9uz18g0cinyvy3n8sam4"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/mainStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="../../menu/menuStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="styles/styles.css" type="text/css" rel="stylesheet">
    <script src="../../menu/menuScripts.js"></script>
    <script src="script/script.js"></script>

    <style media="all">
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
    </style>

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="menuBar">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span
                class="icon-bar"></span></button>
        <p class="navbar-brand" style="color:purple;">UAMT - Intranet</p></div>
    <div class="nav-flags">

    </div>
    </div>
    <div class="container">
        <div class="navbar-header"></div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav" id="navMenu">
                <li><a href="/uamt/intranet"><i class="fa fa-home fa-1x"></i></></a></li>
                <li><a href="/uamt/intranet/pedagogika/index.php">Pedagogika</a></li>
                <li><a href="/uamt/intranet/doktorandi/index.php">Doktorandi</a></li>
                <li><a href="/uamt/intranet/publikacie/index.php">Publikácie</a></li>
                <li><a href="/uamt/intranet/sluzobneCesty/index.php">Služobné cesty</a></li>
                <li class="active"><a href="/uamt/intranet/nakupy/index.php">Nákupy</a></li>
                <li><a href="/uamt/intranet/attendance/index.php">Dochádzka</a></li>
                <li><a href="/uamt/intranet/rozdelenieUloh/index.php">Rozdelenie úloh</a></li>
                <li><a href="/uamt/" style="color:#0066cc"><i class="fa fa-flag fa-1x" style="color: #0066cc!important;"></i> Stránka</a></li>

            </ul>
        </div>
    </div>
</nav>

<div id="nazov">
    <h2><?php echo "Nákupy" ?></h2>
    <hr class="hr_nazov">
</div>

    <div id="sidebar-wrapper" class="sidebar-toggle">
        <ul class="sidebar-nav">
            <br>
            <li>
                <a href="/uamt/intranet/logout.php">Odhlásiť sa</a>
            </li>
            <hr>
            <li>
                <a href="/uamt/intranet/upravitProfil/index.php">Upraviť profil</a>
            </li>
            <li>
                <a href="/uamt/intranet/pridatAktuality/index.php">Pridať aktuality</a>
            </li>
            <li>
                <a href="/uamt/intranet/pridatFotky/index.php">Pridať fotky</a>
            </li>
            <li>
                <a href="/uamt/intranet/pridatVidea/index.php">Pridať videá</a>
            </li>
        </ul>
    </div>

<div class="container">
    <?php
    $data_target = "";
    $data_target = "";
    if (in_array("admin", $roles) || in_array("editor", $roles)) {
        echo "<button id=\"add\" name=\"add\" class='btn btn-primary' type='button' data-toggle='modal' data-target='#myModal'><span class='glyphicon glyphicon-pencil'></span> Nový nákup</button>";
        $data_toggle = "data-toggle='modal'";
        $data_target = "data-target='#myModal'";
    }

    $purchases = $db->getPurchases();
    foreach($purchases as $purchase) {
        $id = $purchase["ID"];
        echo "<article class='div-hover' id='$id' $data_toggle $data_target>";
        echo $purchase["TEXT"];
        echo "</article>";
    }

    if (in_array("admin", $roles) || in_array("editor", $roles)) {
        echo "
            <!-- Modal -->
            <div class=\"modal fade\" id=\"myModal\" data-reveal role=\"dialog\">
                <div class=\"modal-dialog modal-lg\">
                    <!-- Modal content-->
                    <div class=\"modal-content form-area\">
                        <div class=\"modal-header\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                            <h4 class=\"modal-title\">Upraviť nákup</h4>
                        </div>
                        <form method=\"post\" onsubmit=\"saveText();\">
                            <div class=\"modal-body\">
                                <textarea id=\"editor_content\" name=\"textareas\" style=\"height:250px; margin:5px 5px 5px 5px;\"></textarea>
                            </div>
                            <div class=\"modal-footer\">
                                <button id=\"Cancel\" type=\"button\" class=\"btn btn-warning\" data-dismiss=\"modal\"><span class=\"glyphicon glyphicon-share-alt\"></span> Zrušiť</button>
                                <button id=\"Delete\" name=\"Delete\" type=\"Submit\" class=\"btn btn-danger\"><span class=\"glyphicon glyphicon-remove\"></span> Odstrániť</button>
                                <button id=\"Save\" name=\"Save\" type=\"Submit\" class=\"btn btn-success\"><span class=\"glyphicon glyphicon-ok\"></span> Uložiť</button>
                                <button id=\"Add\" name=\"Add\" type=\"Submit\" class=\"btn btn-success\"><span class=\"glyphicon glyphicon-ok\"></span> Pridať</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            ";
    }
    ?>
</div>

<footer>
    <div class="container">
        <div class="container">
            <div class="col-sm-2 text-center">
                <a href="http://is.stuba.sk/">AIS STU</a>
            </div>
            <div class="col-sm-2 text-center">
                <a href="http://aladin.elf.stuba.sk/rozvrh/ ">Rozvrh hodín FEI</a>
            </div>
            <div class="col-sm-2 text-center">
                <a href="http://elearn.elf.stuba.sk/moodle/  "> Moodle FEI</a>

            </div>
            <div class="col-sm-2 text-center">
                <a href="https://www.jedalen.stuba.sk/WebKredit/"> Jedáleň STU </a>
            </div>


            <div class="col-sm-2 text-center">
                <a href="https://www.facebook.com/UAMTFEISTU"> Facebook </a>
            </div>
            <div class="col-sm-2 text-center">
                <a href="https://www.youtube.com/channel/UCo3WP2kC0AVpQMIiJR79TdA"> Youtube </a>
            </div>
        </div>
        <hr>
        <div class="container">

            <div class="col-sm-4 text-center">
                © Copyright 2017. Všetky práva vyhradené.
            </div>
            <div class="col-sm-4 text-center">
                Baka | Lukac | Lichman | Valasik | Smetanka
            </div>

            <div class="col-sm-4 text-center">
                <a href='../../../../../Desktop/Nový%20priečinok%20(3)/index.php?lang=sk' style='color: white' > Slovensky jazyk</a>
            </div>

        </div>

    </div>
    </div>



</footer>
<script src="../../menu/jQueryScripts.js"></script>
</body>
</html>