<?php
include('../lang/langFunctions.php');
include_once ("../database/database.php");
$lang = 'sk';
$showAll = $_GET['ShowAll'];

var_dump($showAll);
if (isset($_GET['lang']))
    $lang = $_GET['lang'];

$lan = new Text($lang);
$text = $lan->getTextForPage('menu');

$ex = new Database();
$js = $ex->fetchMedia();
$db = new Database();
$date = date("Y-m-d");

if(isset($_GET['ShowAll'])) {
    $count = $db->getCountOfNews($lang);
    $check=true;
}
else{
    $count = $db->getCountOfActiveNews($lang, $date);
    $check=false;
}
$rec_limit=6;
$rec_count= $count[0]["COUNT(Title)"];
$str=ceil($rec_count/$rec_limit);

if( isset($_GET{'page'} ) ) {
    $page = $_GET{'page'} + 1;
    $offset = $rec_limit * $page ;
}else {
    $page = 0;
    $offset = 0;
}
$left_rec = $rec_count - ($page * $rec_limit);
if(isset($_GET['ShowAll'])){
    $news=$db->fetchAllNewsByLang($lang,$offset,$rec_limit);
}
else {
    $news = $db->fetchAllActiveNewsByLang($lang, $offset, $rec_limit, $date);
}
?>
<!DOCTYPE html>
<html>
<head lang="sk">
    <title><?php echo $text->news; ?></title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mainStyles.css" type="text/css" rel="stylesheet">
    <link href="../menu/menuStyles.css" type="text/css" rel="stylesheet">
    <link href="newsStyle.css" type="text/css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../menu/menuScripts.js"></script>


    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        <p class="navbar-brand" style="color:#0066cc;">UAMT</p></div>
    <div class="nav-flags">

    </div>
    </div>
    <div class="container">
        <div class="navbar-header"></div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav" id="navMenu">
                <li><a href="/uamt/<?php echo "?lang=".$lang; ?>" ><i class="fa fa-home fa-1x"></i></></a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $text->about; ?><b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/uamt/about/history/<?php echo "?lang=".$lang; ?>"><?php echo $text->about_history; ?></a></li>
                        <li><a href="/uamt/about/management/<?php echo "?lang=".$lang; ?>"><?php echo $text->about_management; ?></a></li>
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
                <li><a href="/uamt/employees/<?php echo "?lang=".$lang; ?>"><?php echo $text->staff; ?></a></li>
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
                <li class="active"><a href="/uamt/news/<?php echo "?lang=".$lang; ?>"><?php echo $text->news; ?></a></li>
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
</nav>
<div id="nazov">
    <h2><?php echo  $text->news; ?></h2>
    <hr class="hr_nazov">
</div>
<div class="container">
        <div>
            <!-- <input type="text">-->

            <form action="index.php" method="get" class="form-horizontal">
                <div class="form-group">
                    <div class="checkbox col-sm-4">
                        <label><input type="checkbox" id="ShowAll" name="ShowAll" value="Yes" />Zobraz vsetko</label>
                        <input type="submit" class="btn btn-default navbar-btn" />
                    </div>
                </div>
        </div>
    <?php

    echo "<div class='container'>";
    foreach($news as $act) {
        echo "<div class='col-sm-4'><div class='news'><div class='img-figure'><div class='cat'>" . $act['Category']."</div><img src=http://147.175.98.167/uamt/news/feika.jpg class=img-responsive></div><div class='title'><i class= 'fa fa-calendar-check-o' aria-hidden=true></i> ".$act['Active']."<h1><a href=#>".$act['Title']."</a></h1></div><p class=description>".$act['Text']."</p>
						</div></div>";
    }
    echo "<br><br></div>";
    //unset($news);
 /*   echo "<ul class=pagination>";
    if( $page > 0 && $left_rec > $rec_limit) {
        $last = $page-2 ;
        echo "<li><a href =$_PHP_SELF?page=$last>Previous</a></li>";
        echo "<li><a href = $_PHP_SELF?page=$page>Next</a></li>";
    }else if( $page == 0 ) {
        echo "<li><a href = $_PHP_SELF?page=$page>Next</a></li>";
    }else if( $left_rec < $rec_limit ) {
        $last = $page-2 ;
        echo "<li><a href = $_PHP_SELF?page=$last>Previous</a><li>";
    }
    echo "</ul>";*/
    //var_dump($offset)

    echo "<ul class=pagination>";
    for($i=1;$i<=$str;$i++){
        $act=$i-2;
        echo "<li><a href =index.php?page=$act>$i</a></li>";
        $showAll = $_GET['ShowAll'];
    }
    echo "</ul>";
        ?>
    <!--<div>
        <ul class="pagination">
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
        </ul>
    </div>-->
    <form class="form-vertical letter" method="post">
        <div class="form-group" id="letter">
            <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" placeholder="Email">
            <!--<label for="sel1">(select one):</label>-->
            <select class="form-control" name="choice" id="sel1">
                <option>EN</option>
                <option>SK</option>
            </select>
            <button type="submit" class="btn btn-default navbar-btn" name="in">Prihlasit</button>
            <button type="submit" class="btn btn-default navbar-btn" name="out">Odhlasit</button>
        </div>
    </form>
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

                <?php
                if($lang == 'sk')
                    echo "<a href='index.php?lang=sk' style='color: yellow' > Slovensky jazyk   | <a href='index.php?lang=en'>  English </a>";
                else
                    echo "<a href='index.php?lang=sk' > Slovensky jazyk   | <a href='index.php?lang=en'  style='    color: yellow'>  English </a>";

                ?>
            </div>

        </div>

    </div>
    </div>
</footer>
<script src="../../menu/jQueryScripts.js"></script>
</body>

</html>
<?php


if (isset($_POST['in'])){
$db = new Database();
$email=$_POST['email'];
$newsLang=$_POST['choice'];
$db->insertNewsletterSubs($email,$newsLang);
}
if (isset($_POST['out'])){
    $db = new Database();
    $email=$_POST['email'];
    $newsLang=$_POST['choice'];
    $db->deleteNewsletterSubs($email,$newsLang);
}
?>