<?php
/**
 * Created by PhpStorm.
 * User: limo
 * Date: 5/6/17
 * Time: 9:27 PM
 */
include_once ('../lang/langFunctions.php');
include_once ("../database/database.php");
include("diacritics.php");

$num = $_GET['id'];
$name = $_GET['name'];
$db = new Database();
$usrId = $db->getUsrId($name)[0]['AIS_ID'];

$employee = array_values($db->getEmployee($num, $name))[0];

$lang = 'sk';

if(isset($_GET['lang']))
    $lang = $_GET['lang'];

$lan = new Text($lang);
$text = $lan->getTextForPage('menu');

$ldapuid = remove_accents($name);
$err = false;
error_reporting(E_ERROR | E_PARSE);
$allRows = array();

$cur = 2016;
$tmp = 1;
$ch = curl_init('http://is.stuba.sk/lide/clovek.pl');
// echo $ldapuid;
// zostavenie dat pre POST dopyt - prepisal som to do in-line style
$data = array('lang' => 'sk', 'zalozka' => '5', 'id' => $usrId, 'rok' => '1', 'order_by' => 'rok_uplatneni', 'zvolit_rok' => 'Zvoliť');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// nastavenie curl-u pre ulozenie dat z odpovede do navratovej hodnoty z volania curl_exec
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
// vykonanie dopytu
$result = curl_exec($ch);

curl_close($ch);
// parsovanie odpovede pre ziskanie pozadovanych dat
$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($result);
$xPath = new DOMXPath($doc);
$tableRows = $xPath->query('//html/body/div/div/div/table[last()]/tbody/tr');

foreach ($tableRows as $row) {
    $typ = $row->childNodes[2]->textContent;
    similar_text($typ, "Monografie, učebnice, skriptá, príručky, normy, patenty, výskumné správy, iné neperiodické publikácie", $percent1);
    similar_text($typ, "články v časopisoch", $percent2);
    similar_text($typ, "príspevky v zborníkoch, kapitoly v monografiách/učebniciach, abstrakty", $percent3);

    if (intval($percent1) > 95 || intval($percent2) > 90 || intval($percent3) > 95) {
        array_push($allRows, $row);
    }
}

function cmp($aa, $bb)
{
    $a = $aa->childNodes[2]->textContent;
    $b = $bb->childNodes[2]->textContent;

    if ($a == $b) {
        $n = intval($aa->childNodes[3]->textContent);
        if ($aa->childNodes[3]->textContent == "" || $aa->childNodes[3]->textContent == null)
            return -1;
        $m = intval($bb->childNodes[3]->textContent);
        if ($n == $m)
            return 0;

        return ($n < $m) ? 1 : -1;
    }

    similar_text($a, "Monografie, učebnice, skriptá, príručky, normy, patenty, výskumné správy, iné neperiodické publikácie", $percent);
    if (intval($percent) > 95)
        return -1;

    similar_text($b, "Monografie, učebnice, skriptá, príručky, normy, patenty, výskumné správy, iné neperiodické publikácie", $percent);
    if (intval($percent) > 95)
        return 1;

    similar_text($a, "príspevky v zborníkoch, kapitoly v monografiách/učebniciach, abstrakty", $percent);
    if (intval($percent) > 95)
        return 1;

    similar_text($b, "príspevky v zborníkoch, kapitoly v monografiách/učebniciach, abstrakty", $percent);
    if (intval($percent) > 95)
        return -1;
}

usort($allRows, "cmp");
?>

<!DOCTYPE>
<html>
<head>
    <link href="detailStyle.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

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
                <!--<div class="navbar-flag2"><a href="employees.php?lang=en"><span class="span-logo"><img
                                    src="http://147.175.98.167/uamt/menu/images/gb.gif" class="sk-logo"></span></a>
                </div>-->
            </ul>
            <!--<div class="navbar-flag1"><a href="employees.php?lang=sk"><span class="span-logo"><img
                                src="http://147.175.98.167/uamt/menu/images/sk.gif" class="sk-logo"></span></a></div>-->
        </div>
    </div>
</div>
<div id="nazov">
    <h2><?php echo $text->staff; ?></h2>
    <hr class="hr_nazov">
</div>
<div class="col-sm-3">
    <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic text-center" >
            <div class="circle_image"
                <?php
                $photo = $employee['PHOTO'];
                if (empty($photo))
                    $photo = "person.png";
                echo "style='background-image: url(photos/".$photo.")'"
                ?>
            >
            </div>
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <?php
                $delimiter = "";
                if (!empty($employee['TITLE2']))
                    $delimiter = ",";

                echo $employee['TITLE1'] . " " . $employee['FIRST_NAME'] . " " . $employee['SECOND_NAME'] . $delimiter . " " . $employee['TITLE2'];
                ?>
            </div>
            <div class="profile-usertitle-job">
                <?php echo $employee['STAFF_ROLE']; ?>
            </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->
        <div class="profile-userbuttons">
            <button type="button" class="btn btn-danger btn-sm"
                    onclick="document.location='http://is.stuba.sk/lide/clovek.pl?lang=en;id=<?php echo $usrId; ?>'">
                Full Profile
            </button>
        </div>
        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="active">
                    <a href="#">
                        <i class="glyphicon glyphicon-home"></i>
                        <span><?php echo $employee['DEPARTMENT']; ?> </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>
                        <?php
                        if (empty($employee['FUNCTION']))
                            echo "No function";
                        else
                            echo $employee['FUNCTION'];
                        ?>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-phone"></i>
                        <span>+421 2 60291 <?php echo $employee['PHONE']; ?></span> </a>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-flag"></i>
                        <?php echo $employee['ROOM']; ?> </a>
                </li>
            </ul>
        </div>
        <!-- END MENU -->
    </div>
</div>

<div class="col-sm-9">
    <table class="table table-striped table-bordered" id="mainTable">
        <tr>
            <th>Publikácie</th>
            <th>Druh výsledku</th>
            <th>Rok</th>
        </tr>
        <?php
        $currYear = intval(date("Y"));
        $drawed = false;
        foreach ($allRows as $row) {
            if (intval($row->childNodes[3]->textContent) <= $currYear - 5 && $drawed == false) {
                echo '</table><div class="text-center"><button type="button" class="btn btn-primary" id="showMore">Zobraz všetko</button></div><div id="faded"><table class="table table-striped table-bordered">';
                $drawed = true;
            }
            echo "<tr>";
            //echo "<p>Typ: ".$row->childNodes[1]->textContent."</p>";
            echo "<td>" . $row->childNodes[1]->textContent . "</td>";
            echo "<td>" . $row->childNodes[2]->textContent . "</td>";
            //echo "<p>Garantujúce pracovisko: ".$row->childNodes[4]->textContent."</p>";
            echo "<td>" . $row->childNodes[3]->textContent . "</td>";
            //echo "<p>Anotácia: ".$annotation."</p>";
            echo "</tr>";
        }

        if ($drawed)
            echo '</table></div>';
        else
            echo '</table>';
        ?>
</div>
<script src="../menu/jQueryScripts.js"></script>
</body>
</html>
