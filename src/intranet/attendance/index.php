<?php
require __DIR__.'/../../database/database.php';

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

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js"></script>
    <script src="scripts/MonthPicker.js"></script>
    <script src="scripts/tableCreator.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<style type="text/css">
    @media print {
        .table td {
            background-color: transparent !important;
        }
    }
</style>

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

<div class="jumbotron text-center" id="header">
    <h1>Evidencia dochádzky</h1>
    <p>Táto stránka umožnuje evidenciu dochádzky zamestnancov.</p>
</div>
<div class="container-fluid">
    <div class="input-group input-group-lg col-sm-4" id="calendarWrapper">
        <span class="input-group-addon fa fa-calendar"><img src="styles/calendar.png" width="21" height="21" alt="calendar"/></span>
        <input id="NoIconDemo" type="text" class="form-control" aria-describedby="sizing-addon1"/>
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-lg btn-primary" id="editBtn">   Edituj   </button>
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

<div class="col-sm-4">
    <h2>Legenda</h2>
    <span class="label label-primary">PN</span>
    <span class="label label-success">OČR</span>
    <span class="label label-info">Služobka</span>
    <span class="label label-warning">Dovolenka</span>
    <span class="label label-danger">Plán Dovolenky</span>
</div>

</html>