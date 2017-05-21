<?php
session_start();

if(!$_SESSION['user']){
    header("Location:../index.php");
    die;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <title>Intranet</title>

    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=r4y29w5xcesgziqbk6k6sf1gmb3m9uz18g0cinyvy3n8sam4"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/mainStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="../../menu/menuStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="styles/styles.css" type="text/css" rel="stylesheet">
    <script src="../../menu/menuScripts.js"></script>
    <script src="script/script.js"></script>

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
        <p class="navbar-brand" style="color:purple;">UAMT - Intranet</p></div>
    <div class="nav-flags">

    </div>
    </div>
    <div class="container">
        <div class="navbar-header"></div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav" id="navMenu">
                <li><a href="/uamt/intranet"><i class="fa fa-home fa-1x"></i></></a></li>
                <li><a href="/uamt/intranet/pedagogika/index.php">Pedagogika</a></li>
                <li><a href="/uamt/intranet/doktorandi/index.php">Doktorandi</a></li>
                <li><a href="/uamt/intranet/publikacie/index.php">Publikácie</a></li>
                <li><a href="/uamt/intranet/sluzobneCesty/index.php">Služobné cesty</a></li>
                <li class="active"><a href="/uamt/intranet/nakupy/index.php">Nákupy</a></li>
                <li><a href="/uamt/intranet/attendance/index.php">Dochádzka</a></li>
                <li><a href="/uamt/intranet/rozdelenieUloh/index.php">Rozdelenie úloh</a></li>
                <li><a href="/uamt/intranet/logout.php">Odhlásiť</a></li>
                <li><a href="/uamt/" style="color:#0066cc"><i class="fa fa-flag fa-1x" style="color: #0066cc!important;"></i> Stránka</a></li>

            </ul>
        </div>
    </div>
</nav>

<div id="nazov">
    <h2><?php echo "Nákupy" ?></h2>
    <hr class="hr_nazov">
</div>

<div class="container space">
    <div id="content">
        <p>
            Lorem ipsum dolor sit amet, ne sea sale repudiandae, iudico dolore dolorum qui cu. Qui discere deseruisse at, solum dicunt adolescens pro te. Vel facer civibus ei. Est congue aliquam ei, no cum sint recteque. Ius stet legendos et, eos idque admodum corpora cu. Et nulla euripidis nam, cum ex officiis inciderint, expetenda forensibus mel id.
        </p>
        <p>
            Ad mei animal tibique efficiantur. Ut qui sint probo utinam, viris adipiscing incorrupte no per, no mel accusam molestie offendit. In usu commodo mandamus, deseruisse theophrastus ut eos. Cu veri labore mel, ea vide illum eam. Ea mei cetero invidunt. Case illud complectitur an vim, nam stet purto in.
        </p>
        <p>
            Te blandit indoctum deterruisset qui, eu melius adversarium qui. Cum an solum tempor interpretaris, justo habemus est id. Oratio aperiam sit in, et usu deleniti incorrupte sadipscing, mollis animal ex vix. Stet verterem consulatu sea ea. In elitr quidam est, mei oportere assentior te.
        </p>
        <p>
            Novum graecis admodum ex duo. Nonumy invenire vim at. Sit eu imperdiet deterruisset. Vel rebum oblique praesent ut, no mea vocent detracto.
        </p>
        <p>
            Eu iisque percipitur pro. Odio adipisci in ius, harum libris his ut, pri id tacimates iracundia. Eu pro denique constituam, et nam illud graeco vidisse, sit detracto dissentiunt in. Consetetur disputando id eos, copiosae consetetur no vix. Vim te habeo nemore epicuri, tale ferri erant in mel.
        </p>
    </div>

    <div id="editor">
        <textarea id="editor_content" style="height:400px;"></textarea>
    </div>

    <div class="buttons">
    <button id="Edit" type="button" class="btn btn-primary">Upraviť</button>
    <button id="Save" type="button" class="btn btn-success">Uložiť</button>
    <button id="Cancel" type="button" class="btn btn-warning">Zrušiť</button>
    </div>
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
                <a href='../../../../../Desktop/Nový%20priečinok%20(3)/index.php?lang=sk' style='color: white' > Slovensky jazyk</a>
            </div>

        </div>

    </div>
    </div>



</footer>
<script src="../../menu/jQueryScripts.js"></script>
</body>
</html>