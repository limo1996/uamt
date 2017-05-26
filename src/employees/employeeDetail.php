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

$ID = $_GET['id'];
$db = new Database();

$employee = array_values($db->getEmployee($ID))[0];
$name = $employee['SECOND_NAME'];
$usrId = $db->getUsrId($name)[0]['AIS_ID'];

$lang = 'sk';

if(isset($_GET['lang']))
    $lang = $_GET['lang'];

$lan = new Text($lang);
$text = $lan->getTextForPage('menu');
$contentText = $lan->getTextForPage('staff');

$ldapuid = remove_accents($name);
$err = false;
error_reporting(E_ERROR | E_PARSE);
$allRows = array();

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
    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>

    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../menu/menuStyles.css" type="text/css" rel="stylesheet">
    <link href="../css/mainStyles.css" type="text/css" rel="stylesheet">

    <script src="../menu/menuScripts.js"></script>
    <style media="all">
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }

    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="menuBar">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                    class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span
                    class="icon-bar"></span></button>
        <p class="navbar-brand" style="color:#0066cc;">UAMT</p></div>
    <div class="nav-flags">

    </div>

    <div class="container">
        <div class="navbar-header"></div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav" id="navMenu">
                <li><a href="/uamt/<?php echo "?lang=".$lang; ?>" ><i class="fa fa-home fa-1x"></i></a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $text->about; ?><b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/uamt/about/history/<?php echo "?lang=".$lang; ?>"><?php echo $text->about_history; ?></a></li>
                        <li ><a href="/uamt/about/management/<?php echo "?lang=".$lang; ?>"><?php echo $text->about_management; ?></a></li>
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->about_department; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/uamt/about/OAMM/<?php echo "?lang=".$lang; ?>"><?php echo $text->about_department_OAMM; ?></a></li>
                                <li><a href="/uamt/about/OIKR/<?php echo "?lang=".$lang; ?>"><?php echo $text->about_department_OIKR; ?></a></li>
                                <li><a href="/uamt/about/OEMP/<?php echo "?lang=".$lang; ?>"><?php echo $text->about_department_OEMP; ?></a></li>
                                <li><a href="/uamt/about/OEAP/<?php echo "?lang=".$lang; ?>"><?php echo $text->about_department_OEAP; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li  class="active"><a href="/uamt/employees/<?php echo "?lang=".$lang; ?>"><?php echo $text->staff; ?></a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $text->study; ?><b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->study_candidate; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/uamt/study/candidate/bc/<?php echo "?lang=".$lang; ?>"><?php echo $text->study_candidate_bc; ?></a></li>
                                <li><a href="/uamt/study/candidate/ing/<?php echo "?lang=".$lang; ?>"><?php echo $text->study_candidate_ing; ?></a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->study_bc; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/uamt/study/bc/info/<?php echo "?lang=".$lang; ?>"><?php echo $text->study_bc_info; ?></a></li>
                                <li><a href="/uamt/study/bc/thesis/<?php echo "?lang=".$lang; ?>"><?php echo $text->study_bc_thesis; ?></a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->study_ing; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/uamt/study/ing/info/<?php echo "?lang=".$lang; ?>"><?php echo $text->study_ing_info; ?></a></li>
                                <li><a href="/uamt/study/ing/thesis/<?php echo "?lang=".$lang; ?>"><?php echo $text->study_ing_thesis; ?></a></li>
                            </ul>
                        </li>
                        <li><a href="/uamt/study/phd/<?php echo "?lang=".$lang; ?>"><?php echo $text->study_phd; ?></a></li>
                    </ul>
                </li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->research; ?><b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/uamt/research/projects/<?php echo "?lang=".$lang; ?>"><?php echo $text->research_projects; ?></a></li>
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->research_topics; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/uamt/research/topics/electricGo/<?php echo "?lang=".$lang; ?>"><?php echo $text->research_motocar; ?></a></li>
                                <li><a href="/uamt/research/topics/autonomousVehicle/<?php echo "?lang=".$lang; ?>"><?php echo $text->research_vehicle; ?></a></li>
                                <li><a href="/uamt/research/topics/3dLedCube/<?php echo "?lang=".$lang; ?>"><?php echo $text->research_cube; ?></a></li>
                                <li><a href="/uamt/research/topics/biomechatronics/<?php echo "?lang=".$lang; ?>"><?php echo $text->research_bio; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="/uamt/news/<?php echo "?lang=".$lang; ?>"><?php echo $text->news; ?></a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->act; ?><b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/uamt/activities/photos/<?php echo "?lang=".$lang; ?>"><?php echo $text->act_photos; ?></a></li>
                        <li><a href="/uamt/activities/videos/<?php echo "?lang=".$lang; ?>"><?php echo $text->act_video; ?></a></li>
                        <li><a href="/uamt/activities/media/<?php echo "?lang=".$lang; ?>"><?php echo $text->act_media; ?></a></li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->act_temata; ?>
                                <b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/uamt/activities/temata_pages/mobility/<?php echo "?lang=".$lang; ?>"><?php echo $text->act_temata_mobility; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="/uamt/contactPage/<?php echo "?lang=".$lang; ?>"><?php echo $text->contact; ?></a></li>
                <li><a href="/uamt/intranet/<?php echo "?lang=".$lang; ?>" style="color:purple"><i class="fa fa-user fa-1x" style="color: purple!important;"></i> Intranet</a></li>
                <!--   <li><a href="#"><button type="button" class="button-menu btn btn-primary btn-sm">Primary</button></a></li>-->

            </ul>
        </div>
    </div>
</nav>

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
                $photo = 'photos/'.$photo;
                list($width, $height, $type, $attr) = getimagesize($photo);
                if($width > 250)
                    $width = 250;
                else
                    $width = 130;

                if($height > 250)
                    $height = 250;
                else
                    $height = 130;

                echo 'style="width: '.$width.'px; height:'.$height.'px;background-image: url('.$photo.')"';
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
                <?php echo $contentText->full_profile; ?>
            </button>
        </div>
        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li>
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
                            echo $contentText->no_function;
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
            <th><?php echo $contentText->publications; ?></th>
            <th><?php echo $contentText->kind; ?></th>
            <th><?php echo $contentText->year; ?></th>
        </tr>
        <?php
        $currYear = intval(date("Y"));
        foreach ($allRows as $row) {
            echo "<tr>";
            //echo "<p>Typ: ".$row->childNodes[1]->textContent."</p>";
            echo "<td>" . $row->childNodes[1]->textContent . "</td>";
            echo "<td>" . $row->childNodes[2]->textContent . "</td>";
            //echo "<p>Garantujúce pracovisko: ".$row->childNodes[4]->textContent."</p>";
            echo "<td>" . $row->childNodes[3]->textContent . "</td>";
            //echo "<p>Anotácia: ".$annotation."</p>";
            echo "</tr>";
        }
            echo '</table>';
        ?>
</div>

<footer>
    <div class="container">
        <div class="container">
            <div class="col-sm-2 text-center">
                <a href="http://is.stuba.sk/">AIS STU</a>
            </div>
            <div class="col-sm-2 text-center">
                <a href="http://aladin.elf.stuba.sk/rozvrh/ "> <?php echo $text->timetable; ?></a>
            </div>
            <div class="col-sm-2 text-center">
                <a href="http://elearn.elf.stuba.sk/moodle/  "> Moodle FEI</a>

            </div>
            <div class="col-sm-2 text-center">
                <a href="https://www.jedalen.stuba.sk/WebKredit/"> <?php echo $text->cantine; ?> </a>
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

                <?php
                if($lang == 'sk')
                    echo "<a href='index.php?lang=sk' style='color: yellow' > Slovensky jazyk  </a> | <a href='index.php?lang=en'>  English </a>";
                else
                    echo "<a href='index.php?lang=sk' > Slovensky jazyk  </a> | <a href='index.php?lang=en'  style='    color: yellow'>  English </a>";

                ?>
            </div>

        </div>

    </div>

</footer>

<script src="../menu/jQueryScripts.js"></script>
</body>
</html>
