<?php
include("../database/database.php");
$db = new Database();

$employees = $db->fetchEmployees();
?>
<!DOCTYPE>
<html>
<head>


    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <title>Final project</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../menu/menuStyles.css" type="text/css" rel="stylesheet">
    <link href="../css/mainStyles.css" type="text/css" rel="stylesheet">

    <script src="../menu/menuScripts.js"></script>

</head>
<body onload="LoadMenu('Pracovníci','../menu/menu.json');">
<div class="navbar navbar-default navbar-fixed-top" role="navigation" id="menuBar">
</div>
<div id="nazov">
    <h2>Pracovnici</h2>
    <hr class="hr_nazov">
</div>
<div class="container">

    <table class="table table-stripped table-bordered">
        <tr>
            <th>Meno</th>
            <th>Miestnosť</th>
            <th>Klapka</th>
            <th>Oddelenie</th>
            <th>Zaradenie</th>
            <th>Funkcia</th>
            <td>Detail</td>
        </tr>

        <?php
        foreach ($employees as $employee) {
            echo "<tr>";
            $delimiter = "";
            if (!empty($employee['TITLE2']))
                $delimiter = ",";
            echo "<td>" . $employee['TITLE1'] . " " . $employee['FIRST_NAME'] . " " . $employee['SECOND_NAME'] . $delimiter . " " . $employee['TITLE2'] . "</td>";
            echo "<td>" . $employee['ROOM'] . "</td>";
            echo "<td>" . $employee['PHONE'] . "</td>";
            echo "<td>" . $employee['DEPARTMENT'] . "</td>";
            echo "<td>" . $employee['STAFF_ROLE'] . "</td>";
            echo "<td>" . str_replace(";", "<br>", $employee['FUNCTION']) . "</td>";
            echo "<td><a href='employeeDetail.php?id=" . $employee['PHONE'] . "&name=".$employee['SECOND_NAME']."'><img src='icon_more.png' width='35px' alt='more' /></a></td>";
            echo "</tr>";
            //var_dump($employee);
            //echo "<br>";
        }
        ?>
    </table>
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
                <a href="https://www.jedalen.stuba.sk/WebKredit/"> Jedáleň STU     </a>
            </div>



            <div class="col-sm-2 text-center">
                <a href="https://www.facebook.com/UAMTFEISTU"> Facebook    </a>
            </div>
            <div class="col-sm-2 text-center">
                <a href="https://www.youtube.com/channel/UCo3WP2kC0AVpQMIiJR79TdA"> Youtube    </a>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="col-sm-1 text-align: center text-center">
            </div>
            <div class="col-sm-2 text-align: centertext-center">
                Jakub Lichman
            </div>
            <div class="col-sm-2 text-center">
                Matus  Lukac
            </div>
            <div class="col-sm-2 text-center">
                Tomas Baka
            </div>
            <div class="col-sm-2 text-center">
                Jakub Smetanka
            </div>
            <div class="col-sm-2 text-center">
                Adam Valasik
            </div>



        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
<script src="../menu/jQueryScripts.js"></script>

<body>
</html>
