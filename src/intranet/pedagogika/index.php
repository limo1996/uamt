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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/mainStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="../../menu/menuStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="../doktorandi/styles/styles.css" type="text/css" rel="stylesheet">
    <script src="../../menu/menuScripts.js"></script>
    <script src="../doktorandi/script/script.js"></script>

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
                <li class="active"><a href="/uamt/intranet/pedagogika/index.php">Pedagogika</a></li>
                <li><a href="/uamt/intranet/doktorandi/index.php">Doktorandi</a></li>
                <li><a href="/uamt/intranet/publikacie/index.php">Publikácie</a></li>
                <li><a href="/uamt/intranet/sluzobneCesty/index.php">Služobné cesty</a></li>
                <li><a href="/uamt/intranet/nakupy/index.php">Nákupy</a></li>
                <li><a href="/uamt/intranet/attendance/index.php">Dochádzka</a></li>
                <li><a href="/uamt/intranet/rozdelenieUloh/index.php">Rozdelenie úloh</a></li>
                <li><a href="/uamt/intranet/logout.php">Odhlásiť</a></li>
                <li><a href="/uamt/" style="color:#0066cc"><i class="fa fa-flag fa-1x" style="color: #0066cc!important;"></i> Stránka</a></li>

            </ul>
        </div>
    </div>
</nav>

<div id="nazov">
    <h2><?php echo "Pedagogika" ?></h2>
    <hr class="hr_nazov">
</div>

<div class="container space">
    <div id="documents">
    </div>
    <button id="newDocument" class="btn btn-primary btn-primary" type="button" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-open"></span> Nový dokument</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content form-area">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nový dokument</h4>
                </div>
                <div class="modal-body">
                    <form id="Document_Form" action="" method="POST" name="Document_Form" role="form">
                        <br style="clear:both">
                        <div class="form-group">
                            <input type="text" class="form-control" id="documentName" name="documentName" placeholder="Názov dokumentu" required>
                        </div>
                        <div class="funkyradio">
                            <div class="funkyradio-success">
                                <input type="radio" name="categ" id="choose" value="choose"/>
                                <label for="choose">Vybrať kategóriu</label>
                            </div>
                            <div class="funkyradio-success">
                                <input type="radio" name="categ" id="create" value="create"/>
                                <label for="create">Nová kategória</label>
                            </div>
                        </div>


                        <!-- TODO: dropdown kategorii z DB-->

                        <div id="selectCategory">
                            <select class="selectpicker" title="Výber kategórie">
                                <?php
                                echo "<option>Kategoria 1</option>";
                                echo "<option>Kategoria 2</option>";
                                echo "<option>Kategoria 3</option>";
                                ?>
                            </select>
                        </div>

                        <div id="newCategory">
                            <div class="form-group">
                                <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Názov kategórie" required>
                            </div>
                        </div>

                        <div class="funkyradio">
                            <div class="funkyradio-success">
                                <input type="radio" name="attach" id="file" value="file"/>
                                <label for="file">Vložiť súbor</label>
                            </div>
                            <div class="funkyradio-success">
                                <input type="radio" name="attach" id="link" value="link"/>
                                <label for="link">Vložiť odkaz</label>
                            </div>
                        </div>

                        <div id="attachFile">
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </div>

                        <div id="attachLink" class="form-group">
                            <input type="text" class="form-control" id="linkToFile" name="linkToFile" placeholder="Odkaz na dokument" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zrušiť</button>
                    <button type="Submit" class="btn btn-primary">Pridať</button>
                </div>
            </div>

        </div>
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