<?php
include_once ("../database/database.php");
include ("../lang/langFunctions.php");

$sortBy = $_POST['SortBy'];
$sort = $_POST['Sort'];
$filter = $_POST['Filter'];
$filterBy = $_POST['FilterBy'];
$filterBox = $_POST['FilterBox'];

$db = new Database();

$employees = array();

if(!$filter && !$sort) {
    $employees = $db->fetchEmployees();
}
else if ($sort){
    if($filter && !empty($filterBox)){
        $employees = $db->sortAndFilterEmployeesBy($sortBy, $filterBy, $filterBox);
    }
    else{
        $employees = $db->sortEmployeesBy($sortBy);
    }
}
else if($filter){
    $employees = $db->filterEmployeesBy($filterBy, $filterBox);
}

$lang = 'sk';

if(isset($_GET['lang']))
    $lang = $_GET['lang'];

$lan = new Text($lang);
$text = $lan->getTextForPage('menu');
$contentText = $lan->getTextForPage('staff');
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified JavaScript -->
    <title>Final project</title>
    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

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

<div class="col-sm-4"></div>
<div class="text-center col-sm-4">
    <form action="index.php" method="post" class="form-horizontal">
        <div class="form-group">
            <div class="checkbox col-sm-4">
                <label><input type="checkbox" id="sortBox" name="Sort" <?php if($sort == 'on') echo 'checked';?>/><?php echo $contentText->sort; ?></label>
            </div>
            <div class="checkbox col-sm-4">
                <label><input type="checkbox" id="filterBox" name="Filter" <?php if($filter == 'on') echo 'checked';?>/><?php echo $contentText->filter; ?></label>
            </div>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary"><?php echo $contentText->search; ?></button>
            </div>
        </div>
        <div class="form-group" id="SortingArea">
            <label for="select" class="control-label col-sm-3"><?php echo $contentText->sortBy; ?></label>
            <div class="col-sm-9">
                <select name="SortBy" class="form-control">
                    <option <?php if($sortBy == 'SECOND_NAME') echo 'selected';?> value="SECOND_NAME"><?php echo $contentText->name; ?></option>
                    <option <?php if($sortBy == 'DEPARTMENT') echo 'selected';?> value="DEPARTMENT"><?php echo $contentText->department; ?></option>
                    <option <?php if($sortBy == 'STAFF_ROLE') echo 'selected';?> value="STAFF_ROLE"><?php echo $contentText->role; ?></option>
                </select>
            </div>
        </div>
        <div class="form-group" id="FilterArea">
            <div class="col-sm-4">
                <select name="FilterBy" class="form-control">
                    <option <?php if($filterBy == 'DEPARTMENT') echo 'selected';?> value="DEPARTMENT"><?php echo $contentText->department; ?></option>
                    <option <?php if($filterBy == 'STAFF_ROLE') echo 'selected';?> value="STAFF_ROLE"><?php echo $contentText->role; ?></option>
                </select>
            </div>
            <label for="select" class="control-label col-sm-3"><?php echo $contentText->contains; ?></label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="filterBox" name="FilterBox" value="<?php echo $filterBox;?>"/>
            </div>
        </div>
        <br>
    </form>
</div>
<div class="container">

    <table class="table table-stripped table-bordered">
        <tr>
            <th><?php echo $contentText->name; ?></th>
            <th><?php echo $contentText->room; ?></th>
            <th><?php echo $contentText->phone; ?></th>
            <th><?php echo $contentText->department; ?></th>
            <th><?php echo $contentText->role; ?></th>
            <th><?php echo $contentText->function; ?></th>
            <th><?php echo $contentText->detail; ?></th>
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
            echo "<td><a href='employeeDetail.php?id=" . $employee['ID']."'><img src='icon_more.png' width='35' alt='more' /></a></td>";
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
<script>
    /**
     * Created by limo on 3/26/17.
     */
    $(document).ready(function () {
        if(!$("#sortBox").is(":checked"))
            $("#SortingArea").hide();

        if(!$("#filterBox").is(":checked"))
            $("#FilterArea").hide();

        $("#sortBox").change(function() {
            if(this.checked) {
                $("#SortingArea").show(400);
            }else
                $("#SortingArea").hide(400);
        });
        $("#filterBox").change(function() {
            if(this.checked) {
                $("#FilterArea").show(400);
            }else
                $("#FilterArea").hide(400);
        });
        $("#faded").hide();


        $("#showMore").click(function () {
            $(this).hide();
            $("#faded").show(400);
        });
    });
</script>
</body>
</html>
