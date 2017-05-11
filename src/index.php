<?php
include ('lang/langFunctions.php');
$lan = new Text('sk');
#var_dump($lan->getTextForPage('projects'));

$lan = new Text('en');
#var_dump($lan->getTextForPage('projects'));
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

    <script src="menu/menuScripts.js"></script>

</head>

<body onload="LoadMenu('O Nás','menu/menu.json');">
    <div class="navbar navbar-default navbar-fixed-top" role="navigation" id="menuBar">
    </div>
    <div id="nazov">
        <h2>O Nás</h2>
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
    <script src="menu/jQueryScripts.js"></script>

</body>

</html>
