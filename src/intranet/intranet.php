<?php
include_once ("../database/database.php");

session_start();

if(!$_SESSION['user']){
    header("Location:index.php");
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

    <link href="../menu/menu2.css" type="text/css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mainStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="../menu/menuStylesIntranet.css" type="text/css" rel="stylesheet">
    <script src="../menu/menuScripts.js"></script>

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
                <li><a href="/uamt/intranet/pedagogika/index.php">Pedagogika</a></li>
                <li><a href="/uamt/intranet/doktorandi/index.php">Doktorandi</a></li>
                <li><a href="/uamt/intranet/publikacie/index.php">Publikácie</a></li>
                <li><a href="/uamt/intranet/sluzobneCesty/index.php">Služobné cesty</a></li>
                <li><a href="/uamt/intranet/nakupy/index.php">Nákupy</a></li>
                <li><a href="/uamt/intranet/attendance/index.php">Dochádzka</a></li>
                <li><a href="/uamt/intranet/rozdelenieUloh/index.php">Rozdelenie úloh</a></li>

            </ul>
        </div>
    </div>
</nav>

<div id="nazov">
    <h2><?php echo "Intranet" ?></h2>
    <hr class="hr_nazov">
</div>

<nav class="main-menu">
    <ul>
        <li class="has-subnav">
            <a href="#">
                <i class="fa fa-list fa-2x"></i>
                <span class="nav-text"> </span>
            </a>

        </li>
        <li class="has-subnav active">
            <a href="/uamt/intranet/intranet.php">
                <i class="fa fa-home fa-2x"></i>
                <span class="nav-text">Domov intranet</span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="/uamt/">
                <i class="fa fa-flag fa-2x"></i>
                <span class="nav-text">Domov UAMT</span>
            </a>

        </li>
        <li>
            <a href="/uamt/intranet/upravitProfil/">
                <i class="fa fa-user fa-2x"></i>
                <span class="nav-text">Upraviť profil</span>
            </a>

        </li>

        <?php
        if (in_array("reporter", $roles) || in_array("editor", $roles) || in_array("admin", $roles)) {
            echo "
            <li class=\"has-subnav\">
                <a href=\"/uamt/intranet/pridatAktuality\">
                    <i class=\"fa fa-font fa-2x\"></i>
                    <span class=\"nav-text\">Pridať aktuality</span>
                </a>
            </li>
            ";
        }

        if (in_array("reporter", $roles) || in_array("admin", $roles)) {
            echo "
            <li class=\"has-subnav\">
                <a href=\"/uamt/intranet/pridatFotky\">
                    <i class=\"fa fa-photo fa-2x\"></i>
                    <span class=\"nav-text\">Pridať fotky</span>
                </a>
            </li>
            
            <li class=\"has-subnav\">
                <a href=\"/uamt/intranet/pridatVidea\">
                    <i class=\"fa fa-play-circle fa-2x\"></i>
                    <span class=\"nav-text\">Pridať videa</span>
                </a>
            </li>
            
            ";
        }
        ?>

        <li>
            <a href="/uamt/intranet/logout.php">
                <i class="fa fa-power-off fa-2x"></i>
                <span class="nav-text">Logout</span>
            </a>
        </li>
    </ul>
</nav>

<div class="container">
            <h1 style="text-align: center; color: purple; font-family: Monospace;"> Vitajte v Intranete</h1>
    <h2> Vitajte v Intranete</h2>
    <h3 style="text-align: center; color: purple; font-family: Monospace;"> Vitajte v Intranete</h3>
    <h3 style=" text-align: center;font-size: 12px; font-weight: normal; font-style: italic; color: #999;">Tip: Stránky obsahujú obsah, ktorý je viditeľný iba pre príslušnú rolu užívateľa</h3>
    <h3 style=" text-align: center;font-size: 12px; font-weight: normal; font-style: italic; color: #999;">Tip2: Napríklad, na každej stránke v ľavo nájdeš rozšírujúce menu (ak máš príslušnú rolu)</h3>
    <h3 style=" text-align: center;font-size: 12px; font-weight: normal; font-style: italic; color: #999;">Tip3: Niekde je rozšírujúce menu reprezentované ikonou, po kliknutí sa zobrazí</h3>


    <?php
        //if (in_array("admin", $roles))
        //    echo "";
        ?>

        <br>
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
                 Slovenský jazyk
            </div>

        </div>

    </div>



</footer>
<script src="../menu/jQueryScripts.js"></script>
</body>
</html>