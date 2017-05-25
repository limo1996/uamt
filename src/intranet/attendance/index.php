<?php
require __DIR__.'/../../database/database.php';

include('../../lang/langFunctions.php');
$lang = 'sk';

if (isset($_GET['lang']))
    $lang = $_GET['lang'];

$lan = new Text($lang);
$text = $lan->getTextForPage('menu');

session_start();

if(!$_SESSION['user']){
    header("Location:../index.php");
    die;
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <link rel="stylesheet" type="text/css" href="styles/MainStyles.css"/>
    <link href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="styles/MonthPicker.css" rel="stylesheet" type="text/css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="../../css/mainStyles.css" type="text/css" rel="stylesheet">
    <link href="../../menu/menuStyles.css" type="text/css" rel="stylesheet">
    <link href="styles/menu2.css" type="text/css" rel="stylesheet">

    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="scripts/MonthPicker.js"></script>
    <script src="scripts/tableCreator.js"></script>
    <link href="../../css/mainStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="../../menu/menuStylesIntranet.css" type="text/css" rel="stylesheet">
    <script src="../../menu/menuScripts.js"></script>

    <style media="all">
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
    </style>
</head>
<body>
<?php

/*******TESTS*******
$db = new Database('staff');
// $db->connect();
$employees = $db->fetchEmployee(3);
$db->insertEmployeeAbsence(date("Y-m-d", strtotime("2017-03-05")), 1, 1);
$db->insertEmployeeAbsence(date("Y-m-d", strtotime("2017-03-06")), 2, 2);
$db->insertEmployeeAbsence(date("Y-m-d", strtotime("2017-02-05")), 3, 3);
$db->deleteEmployeeAbsenceInterval(date("Y-m-d", strtotime("2017-03-01")), date("Y-m-d", strtotime("2017-03-09")));
$db->deleteEmployeeAbsence(date("Y-m-d", strtotime("2017-02-05")), 3, 3);
 * *****************/
?>

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
                <li class="active"><a href="/uamt/intranet/attendance/index.php">Dochádzka</a></li>
                <li><a href="/uamt/intranet/rozdelenieUloh/index.php">Rozdelenie úloh</a></li>

            </ul>
        </div>
    </div>
</nav>
<div id="nazov">
    <h2><?php echo "Evidencia dochádzky"; ?></h2>
    <hr class="hr_nazov">
</div>


<nav class="main-menu">
    <ul>
        <li class="has-subnav">
            <a href="/uamt/intranet/intranet.php">
                <i class="fa fa-list fa-2x"></i>
                <span class="nav-text"> </span>
            </a>

        </li>

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
            <a href="#">
                <i class="fa fa-user fa-2x"></i>
                <span class="nav-text">Upraviť profil</span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="#">
                <i class="fa fa-font fa-2x"></i>
                <span class="nav-text">Pridať aktuality</span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="#">
                <i class="fa fa-photo fa-2x"></i>
                <span class="nav-text">Pridať fotky</span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="#">
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



<div class="container-fluid">
    <div class="row">

        <div class="col-sm-6">
            <div class="input-group input-group-lg col-sm-4" id="calendarWrapper">
                <input id="NoIconDemo" type="text" class="form-control" aria-describedby="sizing-addon1"/>
            </div>
        </div>
    <div class="text-right">
        <button type="button" class="btn btn-lg" id="editBtn">   Edituj   </button>
    </div>
    </div>

</div>
<br />
<div class="text-center" id="selector">
    <div class="btn-group">
        <button type="button" class="btn btn-primary tableChoise" id="1">PN</button>
        <button type="button" class="btn btn-success tableChoise" id="2">OČR</button>
        <button type="button" class="btn btn-info tableChoise" id="3">Služobka</button>
        <button type="button" class="btn btn-warning tableChoise" id="4">Dovolenka</button>
        <button type="button" class="btn btn-danger tableChoise" id="5">Plán Dovolenky</button>
    </div>
</div>
<br />
<div id="tableDiv" class="container-fluid"></div>
<br />

<div class="modal fade" id="myModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title">Osobný editor</h2>
                <h4 id="ModalName"></h4>
            </div>
            <div class="modal-body">
                <select id="editor" onchange="colorChanged()" class="form-control">
                    <option value="1">Práce neschopný</option>
                    <option value="2">OČR</option>
                    <option value="3">Služobná cesta</option>
                    <option value="4">Dovolenka</option>
                    <option value="5">Plánovaná dovolenka</option>
                </select>
                <br>
                <div id="smallTableDiv">

                </div>
                <p></p>
                <table id="table1">

                </table>
                <div>
                    <span class="label label-primary">PN</span>
                    <span class="label label-success">OČR</span>
                    <span class="label label-info">Služobka</span>
                    <span class="label label-warning">Dovolenka</span>
                    <span class="label label-danger">Plán Dovolenky</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="row">

<div class="col-sm-4" style="margin-left: 10px;">
    <h3 style="color:purple">Legenda</h3>
    <span class="label label-primary">PN</span>
    <span class="label label-success">OČR</span>
    <span class="label label-info">Služobka</span>
    <span class="label label-warning">Dovolenka</span>
    <span class="label label-danger">Plán Dovolenky</span>
</div>
</div>
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
                <a href='../../../../../Desktop/Nový%20priečinok%20(3)/index.php?lang=sk' style='color: white' > Slovenský jazyk</a>
            </div>

        </div>

    </div>
    </div>



</footer>


</html>