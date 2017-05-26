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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

    <link href="../../menu/menu2.css" type="text/css" rel="stylesheet">

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
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
    <h2><?php echo "Pridať fotky" ?></h2>
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
        <li class="has-subnav ">
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
        <li class="has-subnav active">
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


<div class="container space">


    <div class="row">
        <!-- panel preview -->
        <div class="col-sm-5">
            <div id="tab" class="btn-group" data-toggle="buttons-radio">
                <a href="#new_album" class="btn btn-large btn-info active" data-toggle="tab">Pridať do nového albumu</a>
                <a href="#old_album" class="btn btn-large btn-info" data-toggle="tab">Pridať do existujúceho albumu</a>
            </div>
            <div class="tab-content">
                <div id="new_album" class="tab-pane panel panel-default active">
                    <form class="photo_form" method="post">
                        <div class="panel-body form-horizontal new_album">

                            <div class="form-group">
                                <label for="fileToUpload" class="col-sm-3 control-label">Obrázok</label>
                                <div class="col-sm-9">
                                    <input type="file" id="fileToUpload" name="fileToUpload" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="n_album" class="col-sm-3 control-label">Album</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="n_album" name="n_album" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date" class="col-sm-3 control-label">Dátum</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-default preview-add-button">
                                        <span class="glyphicon glyphicon-plus"></span> Pridať
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="old_album" class="tab-pane panel panel-default">
                    <form class="photo" method="post">
                        <div class="panel-body form-horizontal old_album">
                            <div class="form-group">
                                <label for="fileToUpload2" class="col-sm-3 control-label">Obrázok</label>
                                <div class="col-sm-9 ">
                                    <input type="file" id="fileToUpload2" name="fileToUpload2" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="o_album" class="col-sm-3 control-label">Album</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="o_album" name="o_album" title="Výber albumu" required>
                                        <option>Album1</option>
                                        <option>Album2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-default preview-add-button">
                                        <span class="glyphicon glyphicon-plus"></span> Pridať
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div> <!-- / panel preview -->
        <div class="col-sm-7">
            <h4>Súbory:</h4>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table preview-table">
                            <thead>
                            <tr>
                                <th>Obrázok</th>
                                <th>Album</th>
                                <th>Dátum</th>
                            </tr>
                            </thead>
                            <tbody></tbody> <!-- preview content goes here-->
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <hr style="border:1px dashed #dddddd;">
                    <button type="button" class="btn btn-primary btn-block">Pridať všetky fotky</button>
                </div>
            </div>
        </div>
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
               Slovenský jazyk
            </div>

        </div>

    </div>
    </div>



</footer>
<script src="../../menu/jQueryScripts.js"></script>
</body>
</html>