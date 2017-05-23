<?php
include('../../lang/langFunctions.php');
$lang = 'sk';

if (isset($_GET['lang']))
    $lang = $_GET['lang'];

$lan = new Text($lang);
$text = $lan->getTextForPage('menu');
$text2 = $lan->getTextForPage('projects-headers');
$projects =  $lan->getTextForPage('projects');
?>

<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <title><?php echo $text->research_projects;?></title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/mainStyles.css" type="text/css" rel="stylesheet">
    <link href="../../menu/menuStyles.css" type="text/css" rel="stylesheet">


    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="../../menu/menuScripts.js"></script>

    <style media="all">
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
    </style>

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
                <li class="active"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->research; ?><b
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
</nav>
<div class="modal fade" id="myModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="modalHeader" style="color: #0066cc"></h5>
                <h6 id="ModalName"></h6>
                <h6 id="ModalDatum"></h6>
            </div>
            <div class="modal-body" id="modalBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="nazov">
    <h2><?php echo $text->research_projects; ?></h2>
    <hr class="hr_nazov">
</div>

<div class="col-sm-2"></div>

<div class="col-sm-8">

    <?php
    foreach ($projects as $project) {
        $annotations[$project['TITLE']] = $project['ANNOTATION'];
    }
    ?>



    <div class="col-sm-3"></div>
    <div id="tabs" class="col-sm-8 center">
        <ul id="list" class="nav nav-tabs">
            <li class="active" id="labak"><a  href="#1" data-toggle="tab" ><?php echo $text2['all']; ?></a></li>
            <li id="predmet"><a  href="#2" data-toggle="tab"><?php echo $text2['inter']; ?></a></li>
            <li id="prop"><a  href="#3" data-toggle="tab">VEGA</a></li>
            <li id="zariadenie"><a  href="#4" data-toggle="tab">APVV</a></li>
            <li id="zariadenie"><a  href="#5" data-toggle="tab">KEGA</a></li>

            <li id="zariadenie"><a  href="#6" data-toggle="tab"><?php echo $text2['other']; ?></a></li>

        </ul>
    </div>

    <div class="tab-content ">
        <div class="tab-pane active" id="1">

            <table class="table table-striped table-bordered" id="displayTable">
                <tr>
                    <th><?php echo $text2['1']; ?></th>
                    <th><?php echo $text2['2']; ?></th>
                    <th><?php echo $text2['3']; ?></th>
                    <th><?php echo $text2['4']; ?></th>
                </tr>


                <?php

                foreach ($projects as $project) {
                    echo "<tr>";
                    echo "<td>" .  $project['ID'] . "</td>";
                    echo "<td>" .  $project['TITLE'] . "</td>";
                    echo "<td>" .  $project['DURATION'] . "</td>";
                    echo "<td>" .  $project['COORDINATION'] . "</td>";

                    echo "</tr>";
                }
                ?>



            </table>

        </div>
        <div class="tab-pane" id="3">
            <table class="table table-striped table-bordered" id="table1">
                <tr>
                    <th><?php echo $text2['1']; ?></th>
                    <th><?php echo $text2['2']; ?></th>
                    <th><?php echo $text2['3']; ?></th>
                    <th><?php echo $text2['4']; ?></th>
                </tr>


                <?php

                foreach ($projects as $project) {
                    if ($project['TYPE'] == "VEGA") {
                        echo "<tr>";
                        echo "<td>" . $project['ID'] . "</td>";
                        echo "<td>" . $project['TITLE'] . "</td>";
                        echo "<td>" . $project['DURATION'] . "</td>";
                        echo "<td>" . $project['COORDINATION'] . "</td>";

                        echo "</tr>";
                    }
                }
                ?>



            </table>
        </div>
        <div class="tab-pane" id="2">
            <table class="table table-striped table-bordered" id="table2">
                <tr>
                    <th><?php echo $text2['1']; ?></th>
                    <th><?php echo $text2['2']; ?></th>
                    <th><?php echo $text2['3']; ?></th>
                    <th><?php echo $text2['4']; ?></th>
                </tr>


                <?php

                foreach ($projects as $project) {
                    if ($project['TYPE'] != "VEGA" && $project['TYPE'] != "APVV" && $project['TYPE'] != "KEGA" && $project['TYPE'] != "Iné domáce projekty" ) {
                        echo "<tr>";
                        echo "<td>" . $project['ID'] . "</td>";
                        echo "<td>" . $project['TITLE'] . "</td>";
                        echo "<td>" . $project['DURATION'] . "</td>";
                        echo "<td>" . $project['COORDINATION'] . "</td>";

                        echo "</tr>";
                    }
                }
                ?>



            </table>
        </div>
        <div class="tab-pane" id="4">
            <table class="table table-striped table-bordered" id="table3">
                <tr>
                    <th><?php echo $text2['1']; ?></th>
                    <th><?php echo $text2['2']; ?></th>
                    <th><?php echo $text2['3']; ?></th>
                    <th><?php echo $text2['4']; ?></th>
                </tr>


                <?php

                foreach ($projects as $project) {
                    if ($project['TYPE'] == "APVV") {
                        echo "<tr>";
                        echo "<td>" . $project['ID'] . "</td>";
                        echo "<td>" . $project['TITLE'] . "</td>";
                        echo "<td>" . $project['DURATION'] . "</td>";
                        echo "<td>" . $project['COORDINATION'] . "</td>";

                        echo "</tr>";
                    }
                }
                ?>



            </table>
        </div>
        <div class="tab-pane" id="5">
            <table class="table table-striped table-bordered" id="table4">
                <tr>
                    <th><?php echo $text2['1']; ?></th>
                    <th><?php echo $text2['2']; ?></th>
                    <th><?php echo $text2['3']; ?></th>
                    <th><?php echo $text2['4']; ?></th>
                </tr>


                <?php

                foreach ($projects as $project) {
                    if ($project['TYPE'] == "KEGA") {
                        echo "<tr>";
                        echo "<td>" . $project['ID'] . "</td>";
                        echo "<td>" . $project['TITLE'] . "</td>";
                        echo "<td>" . $project['DURATION'] . "</td>";
                        echo "<td>" . $project['COORDINATION'] . "</td>";

                        echo "</tr>";
                    }
                }
                ?>



            </table>
        </div>
        <div class="tab-pane" id="6">
            <table class="table table-striped table-bordered" id="table5">
                <tr>
                    <th><?php echo $text2['1']; ?></th>
                    <th><?php echo $text2['2']; ?></th>
                    <th><?php echo $text2['3']; ?></th>
                    <th><?php echo $text2['4']; ?></th>
                </tr>


                <?php

                foreach ($projects as $project) {
                    if ($project['TYPE'] == "Iné domáce projekty") {
                        echo "<tr>";
                        echo "<td>" . $project['ID'] . "</td>";
                        echo "<td>" . $project['TITLE'] . "</td>";
                        echo "<td>" . $project['DURATION'] . "</td>";
                        echo "<td>" . $project['COORDINATION'] . "</td>";

                        echo "</tr>";
                    }
                }
                ?>



            </table>
        </div>
    </div>




    <script>
        <?php
        echo "var annotations = ".json_encode($annotations).";\n";
        ?>
        $('#displayTable').find('tr').click( function(){
            var title = this.cells[1].innerHTML;
            var date = this.cells[2].innerHTML;
            var supervisor = this.cells[3].innerHTML;
            //alert(title+supervisor+ustav);

            $('#modalHeader').html(title);
            $("#ModalName").html("Zodpovedny riesitel: " + supervisor);
            $("#ModalDatum").html("Doba riesenia: " + date);
            $("#modalBody").html(annotations[title]);

            if(title != "Názov")
                $('#myModal').modal('toggle');
        });



        $('#omg').find('tr').click( function(){
            var title = this.cells[1].innerHTML;
            var date = this.cells[2].innerHTML;
            var supervisor = this.cells[3].innerHTML;
            //alert(title+supervisor+ustav);

            $('#modalHeader').html(title);
            $("#ModalName").html("Zodpovedny riesitel: " + supervisor);
            $("#ModalDatum").html("Doba riesenia: " + date);
            $("#modalBody").html(annotations[title]);

            if(title != "Názov")
                $('#myModal').modal('toggle');
        });

        $('#table1').find('tr').click( function(){
            var title = this.cells[1].innerHTML;
            var date = this.cells[2].innerHTML;
            var supervisor = this.cells[3].innerHTML;
            //alert(title+supervisor+ustav);

            $('#modalHeader').html(title);
            $("#ModalName").html("Zodpovedny riesitel: " + supervisor);
            $("#ModalDatum").html("Doba riesenia: " + date);
            $("#modalBody").html(annotations[title]);

            if(title != "Názov")
                $('#myModal').modal('toggle');
        });


        $('#table2').find('tr').click( function(){
            var title = this.cells[1].innerHTML;
            var date = this.cells[2].innerHTML;
            var supervisor = this.cells[3].innerHTML;
            //alert(title+supervisor+ustav);

            $('#modalHeader').html(title);
            $("#ModalName").html("Zodpovedny riesitel: " + supervisor);
            $("#ModalDatum").html("Doba riesenia: " + date);
            $("#modalBody").html(annotations[title]);

            if(title != "Názov")
                $('#myModal').modal('toggle');
        });


        $('#table3').find('tr').click( function(){
            var title = this.cells[1].innerHTML;
            var date = this.cells[2].innerHTML;
            var supervisor = this.cells[3].innerHTML;
            //alert(title+supervisor+ustav);

            $('#modalHeader').html(title);
            $("#ModalName").html("Zodpovedny riesitel: " + supervisor);
            $("#ModalDatum").html("Doba riesenia: " + date);
            $("#modalBody").html(annotations[title]);

            if(title != "Názov")
                $('#myModal').modal('toggle');
        });


        $('#table4').find('tr').click( function(){
            var title = this.cells[1].innerHTML;
            var date = this.cells[2].innerHTML;
            var supervisor = this.cells[3].innerHTML;
            //alert(title+supervisor+ustav);

            $('#modalHeader').html(title);
            $("#ModalName").html("Zodpovedny riesitel: " + supervisor);
            $("#ModalDatum").html("Doba riesenia: " + date);
            $("#modalBody").html(annotations[title]);

            if(title != "Názov")
                $('#myModal').modal('toggle');
        });

        $('#table5').find('tr').click( function(){
            var title = this.cells[1].innerHTML;
            var date = this.cells[2].innerHTML;
            var supervisor = this.cells[3].innerHTML;
            //alert(title+supervisor+ustav);

            $('#modalHeader').html(title);
            $("#ModalName").html("Zodpovedny riesitel: " + supervisor);
            $("#ModalDatum").html("Doba riesenia: " + date);
            $("#modalBody").html(annotations[title]);

            if(title != "Názov")
                $('#myModal').modal('toggle');
        });

    </script>



</div>
<div class="col-sm-2"></div>


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
                © Copyright 2017.  <?php echo $text->rights; ?>.
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
