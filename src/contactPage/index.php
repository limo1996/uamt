<?php
include('../lang/langFunctions.php');
$lang = 'sk';

if (isset($_GET['lang']))
    $lang = $_GET['lang'];

$lan = new Text($lang);
$text = $lan->getTextForPage('menu');
?>
<!DOCTYPE html>
<html>
<head lang="sk">
    <title>Kontakt</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mainStyles.css" type="text/css" rel="stylesheet">
    <link href="../menu/menuStyles.css" type="text/css" rel="stylesheet">


    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
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
    </div>
    <div class="container">
        <div class="navbar-header"></div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav" id="navMenu">
                <li><a href="/uamt/"><i class="fa fa-home fa-1x"></i></></a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $text->about; ?><b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><?php echo $text->about_history; ?></a></li>
                        <li><a href="#"><?php echo $text->about_management; ?></a></li>
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->about_department; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><?php echo $text->about_department_OAMM; ?></a></li>
                                <li><a href="#"><?php echo $text->about_department_OIKR; ?></a></li>
                                <li><a href="#"><?php echo $text->about_department_OEMP; ?></a></li>
                                <li><a href="#"><?php echo $text->about_department_OEAP; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="/uamt/employees/"><?php echo $text->staff; ?></a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $text->study; ?><b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->study_candidate; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><?php echo $text->study_candidate_bc; ?></a></li>
                                <li><a href="#"><?php echo $text->study_candidate_ing; ?></a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->study_bc; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><?php echo $text->study_bc_info; ?></a></li>
                                <li><a href="#"><?php echo $text->study_bc_thesis; ?></a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->study_ing; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><?php echo $text->study_ing_info; ?></a></li>
                                <li><a href="#"><?php echo $text->study_ing_thesis; ?></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><?php echo $text->study_phd; ?></a></li>
                    </ul>
                </li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->research; ?><b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><?php echo $text->research_projects; ?></a></li>
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->research_topics; ?><b
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
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->act; ?><b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/uamt/photos"><?php echo $text->act_photos; ?></a></li>
                        <li><a href="/uamt/videos/"><?php echo $text->act_video; ?></a></li>
                        <li><a href="/uamt/media/"><?php echo $text->act_media; ?></a></li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->act_temata; ?>
                                <b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><?php echo $text->act_temata_mobility; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="active"><a href="/uamt/contactPage/index.php"><?php echo $text->contact; ?></a></li>
                <li><a href="#" style="color:purple"><i class="fa fa-user fa-1x" style="color: purple!important;"></i> Intranet</a></li>
                <!--   <li><a href="#"><button type="button" class="button-menu btn btn-primary btn-sm">Primary</button></a></li>-->

            </ul>
        </div>
</nav>
<div id="nazov">
    <h2><?php echo $text->contact; ?></h2>
    <hr class="hr_nazov">
</div>



<div class="row">
    <div class="col-sm-2" >
    </div>
        <div class="col-sm-4 center" >
            <div class="well"  style=" width: 450px" >
                <h3 id = "adress" style="line-height:20%;"><i class="fa fa-home fa-1x" style="line-height:6%;color:#4268f4!important;"></i> Adresa:</h3>
                <p>Ústav automobilovej mechatroniky, FEI STU, Ilkovičova 3,
                    812 19 Bratislava, Slovenská republika</p>

                <h3 id="secretary"><i class="fa fa-user fa-1x" style="line-height:6%;color:#4268f4!important;"></i> Sekretariát:</h3>
                <p>Katarína Kermietová</p>

                <h3 id="kacelaria"><i class="fa fa-key fa-1x" style="line-height:6%;color:#4268f4"></i> Kancelária</h3>
                <p>D116</p>

                <h3><i class="fa fa-envelope fa-1x" style="line-height:6%;color:#4268f4"></i> E-mail:</h3>
                <p>katarina.kermietova[at]stuba.sk</p>

                <h3 id="phoneNumber"><i class="fa fa-phone fa-1x" style="line-height:6%;color:#4268f4"></i> Telefónne číslo:</h3>
                <p>+421 260 291 598</p>
                <p>+421 265 429 734</p>
            </div>
        </div>

    <div id="map" class="col-sm-4 center" style=" height:458px;>
        </div>
    <div class="col-sm-2" >

    </div>
</div>

    <div style=" height:20px; width: 20px">
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
                    echo "<a href='index.php?lang=sk' > Slovensky jazyk   | <a href='index.php?lang=en'  style='    color: #424242'>  English </a>";

                ?>
            </div>

        </div>

    </div>
    </div>
</footer>
<script>
    function myMap() {
        var myCenter = new google.maps.LatLng(48.151867, 17.073667);
        var mapCanvas = document.getElementById("map");
        var mapOptions = {center: myCenter, zoom: 17};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position:myCenter});
        marker.setMap(map);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAytqakc7clT5GMMm3GsiRV-LSrPYviawQ&callback=myMap"></script>
<script src="../menu/jQueryScripts.js"></script>

</body>

</html>