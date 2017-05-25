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
    <link href="../menu/menu2.css" type="text/css" rel="stylesheet">


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mainStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="../menu/menuStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="doktorandi/styles/styles.css" type="text/css" rel="stylesheet">
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

<div id="intranet-wrapper">
    <div id="nazov">
        <h2><?php echo "Intranet" ?></h2>
        <hr class="hr_nazov">
    </div>
    <nav class="main-menu">
        <ul>
            <div id="menu2">

            </div>
            <li>
                <a href="#">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                            Domov intranet
                        </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="#">
                    <i class="fa fa-flag fa-2x"></i>
                    <span class="nav-text">
                            Domov uamt
                        </span>
                </a>

            </li>
            <li>
                <a href="#">
                    <i class="fa fa-user fa-2x"></i>
                    <span class="nav-text">
                            Upravit profil
                        </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="#">
                    <i class="fa fa-font fa-2x"></i>
                    <span class="nav-text">
                            Pridat aktuality
                        </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="#">
                    <i class="fa fa-photo fa-2x"></i>
                    <span class="nav-text">
                            Pridat fotky
                        </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="#">
                    <i class="fa fa-play-circle fa-2x"></i>
                    <span class="nav-text">
                            Pridat videa
                        </span>
                </a>

            </li>

        </ul>

        <ul class="logout">
            <li>
                <a href="#">
                    <i class="fa fa-power-off fa-2x"></i>
                    <span class="nav-text">
                            Logout
                        </span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="container">
            <h1> Welcum to intranet</h1>

        <?php
        //if (in_array("admin", $roles))
        //    echo "";
        ?>

        <br>
    </div>

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
<script src="../menu/jQueryScripts.js"></script>
</body>
</html>