<?php
include('lang/langFunctions.php');
$lang = 'sk';

if (isset($_GET['lang']))
    $lang = $_GET['lang'];

$lan = new Text($lang);
$text = $lan->getTextForPage('menu');
?>

<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <title>Final project</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mainStyles.css" type="text/css" rel="stylesheet">
    <link href="menu/menuStyles.css" type="text/css" rel="stylesheet">


    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="menu/menuScripts.js"></script>

</head>

<body>
<!--<div class="navbar navbar-default navbar-fixed-top" role="navigation" id="menuBar">-->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="menuBar">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                    class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span
                    class="icon-bar"></span></button>
        <p class="navbar-brand" style="color:#0066cc;">UAMT</p></div>
    <div class="nav-flags">
        <?php
        if($lang == 'sk')
            echo '<div class="navbar-flag">
            <a href="index.php?lang=en">
                        <span class="span-logo">
                            <img src="http://147.175.98.167/uamt/menu/images/gb.gif" class="sk-logo">
                        </span></a>
        </div>';
        else
            echo ' <div class="navbar-flag">
            <a href="index.php?lang=sk">
                    <span class="span-logo">
                        <img src="http://147.175.98.167/uamt/menu/images/sk.gif" class="sk-logo">
                    </span>
            </a>
        </div>';
        ?>
    </div>
    </div>
    <div class="container">
        <div class="navbar-header"></div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav" id="navMenu">
                <li class="active"><a href="/uamt/index.php"><?php echo $text->about; ?></a></li>
                <li><a href="/uamt/employees/employees.php"><?php echo $text->staff; ?></a></li>
                <li><a href="#"><?php echo $text->study; ?></a></li>
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
                        <li><a href="#"><?php echo $text->act_photos; ?></a></li>
                        <li><a href="#"><?php echo $text->act_video; ?></a></li>
                        <li><a href="#"><?php echo $text->act_media; ?></a></li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->act_temata; ?>
                                <b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><?php echo $text->act_temata_mobility; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#"><?php echo $text->contact; ?></a></li>
            </ul>
    </div>
</nav>
<div id="nazov">
    <h2><?php echo $text->about; ?></h2>
    <hr class="hr_nazov">
</div>

<div id="content">// simulate large amount of information
    <h1> Content</h1>

    <h1> Content</h1>

    <h1> Content</h1>

    <h1> Content</h1>

    <h1> Content</h1>

    <h1> Content</h1>

    <h1> Content</h1>

    <h1> Content</h1>

    <h1> Content</h1>

    <h1> Content</h1>

    <h1> Content</h1>

    <h1> Content</h1>

    <h1> Content</h1>
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
            <div class="col-sm-1 text-align: center text-center">
            </div>
            <div class="col-sm-2 text-center">
                Jakub Lichman
            </div>
            <div class="col-sm-2 text-center">
                Matus Lukac
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
<script src="menu/jQueryScripts.js"></script>
</body>
</html>
