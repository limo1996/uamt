<?php
session_start();

if(!$_SESSION['user']){
    header("Location:../index.php");
    die;
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

    <link href="../../menu/menu2.css" type="text/css" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/mainStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="../../menu/menuStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="rozdelenieUloh.css" type="text/css" rel="stylesheet">

    <script src="../../menu/menuScripts.js"></script>

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
                <li  class="active"><a href="/uamt/intranet/rozdelenieUloh/index.php">Rozdelenie úloh</a></li>

            </ul>
        </div>
    </div>
</nav>

<div id="nazov">
    <h2><?php echo "Rozdelenie úloh" ?></h2>
    <hr class="hr_nazov">
</div>

<nav class="main-menu">
    <ul>

        <li class="has-subnav">
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
        <li class="has-subnav">
            <a href="/uamt/intranet/pridatAktuality">
                <i class="fa fa-font fa-2x"></i>
                <span class="nav-text">Pridať aktuality</span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="/uamt/intranet/pridatFotky">
                <i class="fa fa-photo fa-2x"></i>
                <span class="nav-text">Pridať fotky</span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="/uamt/intranet/pridatVidea">
                <i class="fa fa-play-circle fa-2x"></i>
                <span class="nav-text">Pridať videa</span>
            </a>

        </li>


        <li>
            <a href="/uamt/intranet/logout.php">
                <i class="fa fa-power-off fa-2x"></i>
                <span class="nav-text">Logout</span>
            </a>
        </li>
    </ul>
</nav>

<div class="container">

    <br>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-4">
            <img id="img3" src="jakub.jpg" class="img-circle person" alt="Random Name" width="200" height="200">
            </div>
            <div class="col-sm-6">
                <h4>Jakub Lichman</h4>
                <ul>
                    <li>Dvojjazyčnosť</li>
                    <li>Dochádzka</li>
                    <li>Databáza</li>
                    <li>Zamestnanci</li>
                    <li>Gitmaster</li>
                </ul>
            </div>
    </div>

    <hr class="hr_nazov">

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-4">
            <img id="img2" src="adam.jpg" class="img-circle person" alt="Random Name" width="200" height="200">
        </div>
        <div class="col-sm-6">
            <h4>Adam Valašík</h4>
            <ul>
                <li>Zodpovedný: 			doc. Ing. Vladimír Kutiš, PhD.</li>
                <li>Hodnotenie predmetu: 		klasifikovaný zápočet</li>
                <li>Štandardný čas plnenia: 	3. roč. bakalárskeho štúdia, zimný semester</li>

            </ul>
        </div>
    </div>

    <hr class="hr_nazov">

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-4">
            <img id="img1" src="matus.JPG" class="img-circle person" alt="Random Name" width="200" height="200">
        </div>
        <div class="col-sm-6">
            <h4>Matúš Lukáč</h4>
            <ul>
                <li>Menu</li>
                <li>Footer</li>
                <li>Stránky - "Výskum" </li>
                <li>Dizajn</li>


            </ul>
        </div>
    </div>

    <hr class="hr_nazov">

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-4">
            <img id="img4" src="tomas.jpg" class="img-circle person" alt="Random Name" width="200" height="200">
        </div>
        <div class="col-sm-6">
            <h4>Tomáš Baka</h4>
            <ul>
                <li>Kontakt</li>
                <li>Fotogaléria</li>
                <li>Videá</li>
                <li>Médiá</li>
            </ul>
        </div>
    </div>

    <hr class="hr_nazov">

    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-4">
            <img id="img5" src="jakub2.jpg" class="img-circle person" alt="Random Name" width="200" height="200">
        </div>
        <div class="col-sm-6">
            <h4>Jakub Smetanka</h4>
            <ul>
                <li>Zodpovedný: 			doc. Ing. Vladimír Kutiš, PhD.</li>
                <li>Hodnotenie predmetu: 		klasifikovaný zápočet</li>
                <li>Štandardný čas plnenia: 	3. roč. bakalárskeho štúdia, zimný semester</li>

            </ul>
        </div>
    </div>



</div>
<br>
<br>



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
    </div>



</footer>
<script src="../../menu/jQueryScripts.js"></script>
</body>
</html>