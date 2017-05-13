<?php
include_once ("../database/database.php");
include ("../lang/langFunctions.php");
$db = new Database();

$employees = $db->fetchEmployees();
$lang = 'sk';

if(isset($_GET['lang']))
    $lang = $_GET['lang'];

$lan = new Text($lang);
$text = $lan->getTextForPage('menu');
?>
<!DOCTYPE>
<html>
<head>
    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <title>Final project</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../menu/menuStyles.css" type="text/css" rel="stylesheet">
    <link href="../css/mainStyles.css" type="text/css" rel="stylesheet">

    <script src="../menu/menuScripts.js"></script>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation" id="menuBar">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                    class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span
                    class="icon-bar"></span></button>
        <p class="navbar-brand" style="color:#0066cc;">UAMT</p></div>
    <div class="container">
        <div class="navbar-header"></div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-collapse navbar-nav" id="navMenu">
                <li><a href="/uamt/index.php"><?php echo $text->about; ?></a></li>
                <li class="active"><a href="/uamt/employees/employees.php"><?php echo $text->staff; ?></a></li>
                <li><a href="#"><?php echo $text->study; ?></a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->research; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><?php echo $text->research_projects; ?></a></li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->research_topics; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><?php echo $text->research_motocar; ?></a></li>
                                <li><a href="#"><?php echo $text->research_vehicle; ?></a></li>
                                <li><a href="#"><?php echo $text->research_cube; ?></a></li>
                                <li><a href="#"><?php echo $text->research_bio; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#"><?php echo $text->news; ?></a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->act; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><?php echo $text->act_photos; ?></a></li>
                        <li><a href="#"><?php echo $text->act_video; ?></a></li>
                        <li><a href="#"><?php echo $text->act_media; ?></a></li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->act_temata; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><?php echo $text->act_temata_mobility; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#"><?php echo $text->contact; ?></a></li>
                <div class="navbar-flag2"><a href="employees.php?lang=en"><span class="span-logo"><img
                                    src="http://147.175.98.167/uamt/menu/images/gb.gif" class="sk-logo"></span></a>
                </div>
            </ul>
            <div class="navbar-flag1"><a href="employees.php?lang=sk"><span class="span-logo"><img
                                src="http://147.175.98.167/uamt/menu/images/sk.gif" class="sk-logo"></span></a></div>
        </div>
    </div>
</div>
<div id="nazov">
    <h2><?php echo $text->staff; ?></h2>
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
<script src="../menu/jQueryScripts.js"></script>
</body>
</html>
