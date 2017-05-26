<?php
include('../../../lang/langFunctions.php');
$lang = 'sk';

if (isset($_GET['lang']))
    $lang = $_GET['lang'];

if($lang == 'en')
{
    header("Location: /uamt/index.php?lang=en");
    exit();
}

$lan = new Text($lang);
$text = $lan->getTextForPage('menu');

$ch = curl_init('http://is.stuba.sk/pracoviste/prehled_temat.pl');

$departmentNo = '642';
$proTypeNo = 2;
$columnIndex = 3;
$keyIndex = 2;

// zostavenie dat pre POST dopyt
$data = array(
    'filtr_typtemata2' => $proTypeNo,
    'pracoviste' => $departmentNo,
    'lang' => 'sk',
    'omezit_temata2' => 'Obmedziť'
);

// nastavenie curl-u pre pouzitie POST dopytu
curl_setopt($ch, CURLOPT_POST,1);
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
$tableRows = $xPath->query('//html/body/div/div/div/form/table[last()]/tbody/tr');

$dictionary = array();
$annotations = array();

foreach ($tableRows as $row) {
    $dictionary[$row->childNodes[$keyIndex]->textContent] = array();
}

foreach ($tableRows as $row){
    array_push($dictionary[$row->childNodes[$keyIndex]->textContent], $row);
}

ksort($dictionary);
?>
<!DOCTYPE html>
<html>
<head lang="sk">
    <title><?php echo $text->study_ing_thesis;?></title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/mainStyles.css" type="text/css" rel="stylesheet">
    <link href="../../../menu/menuStyles.css" type="text/css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../../../menu/menuScripts.js"></script>

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

    <div class="container">
        <div class="navbar-header"></div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav" id="navMenu">
                <li><a href="/uamt/<?php echo "?lang=".$lang; ?>" ><i class="fa fa-home fa-1x"></i></a></li>
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
                <li class="active"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $text->study; ?><b
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
<div class="modal fade" id="myModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="modalHeader"></h2>
                <h4 id="ModalName"></h4>
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
    <h2><?php echo $text->study_ing_thesis;?></h2>
    <hr class="hr_nazov">
</div>


<div id="content">
    <div class="col-sm-3"></div>

    <div class="col-sm-6">
        <h2>Pokyny</h2>

        <article>
            <p><b>Ukončovanie predmetov DP1, DP2, DP3, DZP</b></p>
            <p>Diplomový projekt 1</p>
            <ul>
                <li>Zodpovedný: 			prof. Ing. Mikuláš Huba, PhD.</li>
                <li>Hodnotenie predmetu: 		klasifikovaný zápočet</li>
                <li>Štandardný čas plnenia: 	1. roč. inžinierskeho štúdia, letný semester</li>
                <li>Pre získanie klasifikovaného zápočtu musí študent odovzdať technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.júna daného roku. Prácu na projekte hodnotí vedúci práce.</li>

            </ul>
            <p>Diplomový projekt 2</p>
            <ul>
                <li>Zodpovedný: 			prof. Ing. Mikuláš Huba, PhD.</li>
                <li>Hodnotenie predmetu: 		klasifikovaný zápočet</li>
                <li>Štandardný čas plnenia: 	2. roč. inžinierskeho štúdia, zimný semester</li>
                <li>Pre získanie klasifikovaného zápočtu musí študent odovzdať technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.januára daného roku a obhájiť svoje priebežné výsledky pred minimálne 2-člennou komisiou (jej členom by mal byť vedúci práce). Prácu na projekte hodnotí komisia pri obhajobe, ktorá zoberie do úvahy hodnotenie vedúceho práce.</li>

            </ul>

            <p>Diplomový projekt 3</p>
            <ul>
                <li>Zodpovedný: 			prof. Ing. Mikuláš Huba, PhD.</li>
                <li>Hodnotenie predmetu: 		klasifikovaný zápočet</li>
                <li>Štandardný čas plnenia: 	2. roč. inžinierskeho štúdia, letný semester</li>
                <li>Pre získanie klasifikovaného zápočtu musí študent do dátumu špecifikovanom v harmonograme štúdia FEI STU odovzdať diplomovú prácu:</li>
                <ol>
                    <li>v elektronickej forme do AIS</li>
                    <li>v tlačenej forme v počte 2 kusy Ing. Sedlárovi? (A803)</li>
                </ol>
                <li>alebo odovzdať technickú dokumentáciu svojmu vedúcemu práce v nim špecifikovanom rozsahu najneskôr do 20.júna daného roku.</li>
                <li>Prácu na projekte hodnotí vedúci práce.</li>

            </ul>
            <p>Diplomová záverečná práca</p>
            <ul>
                <li>Zodpovedný: 			prof. Ing. Mikuláš Huba, PhD.</li>
                <li>Hodnotenie predmetu: 		skúška</li>
                <li>Štandardný čas plnenia: 	2. roč. inžinierskeho štúdia, letný semester</li>
                <li>Pre získanie skúšky musí študent obhájiť tému svojej diplomovej práce pred štátnicovou komisiou, ktorá zároveň udeľuje známku za obhajobu.</li>


            </ul>

        </article>


        <p>&nbsp;</p>

        <h2>Voľné témy</h2>
        <table class="table table-striped table-bordered" id="displayTable">
            <tr>
                <th>Názov</th>
                <th>Školiteľ</th>
            </tr>

            <?php
            foreach ($dictionary as $key => $arr)
            {
                foreach ($arr as $row) {
                    $occupation = $row->childNodes[9]->textContent;
                    str_ireplace(" ", "", $occupation);


                    if ($occupation == '--') {
                        if ($filterBox == null || $filterBox == "" || stripos($row->childNodes[$columnIndex]->textContent, $filterBox) !== FALSE) {
                            $annotationURL = 'http://is.stuba.sk' . $row->childNodes[7]->firstChild->firstChild->getAttribute('href');

                            // vykonanie sekundarneho curl dopytu, a parsovanie odpovede pre ziskanie anotacie
                            $ch = curl_init($annotationURL);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            $result = curl_exec($ch);
                            curl_close($ch);

                            $doc = new DOMDocument();
                            libxml_use_internal_errors(true);

                            $doc->loadHTML($result);
                            $xPath = new DOMXPath($doc);
                            $annotation = $xPath->query('//html/body/div/div/div/table[1]/tbody/tr[last()]/td[last()]')[0]->textContent;
                            $annotations[$row->childNodes[2]->textContent] = $annotation;
                            echo "<tr>";
                            echo "<td>" . $row->childNodes[2]->textContent . "</td>";
                            echo "<td>" . $row->childNodes[3]->textContent . "</td>";
                            echo "</tr>";
                        }
                    }
                }
            }

            ?>
        </table>
        <script>
            <?php
            echo "var annotations = ".json_encode($annotations).";\n";
            ?>
            $('#displayTable').find('tr').click( function(){
                var title = this.cells[0].innerHTML;
                var supervisor = this.cells[1].innerHTML;
                //alert(title+supervisor+ustav);

                $('#modalHeader').html(title);
                $("#modalname").html(supervisor);
                $("#modalBody").html(annotations[title]);
                if(title != "Názov")
                    $('#myModal').modal('toggle');
            });
        </script>

        <p>&nbsp;</p>
        <p>&nbsp;</p>




    </div>
    <div class="col-sm-3"></div>

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
                    echo "<a href='index.php?lang=sk' style='color: yellow' > Slovensky jazyk  </a> | <a href='/uamt/index.php?lang=en'>  English </a>";
                else
                    echo "<a href='index.php?lang=sk' > Slovensky jazyk  </a> | <a href='/uamt/index.php?lang=en'  style='    color: yellow'>  English </a>";

                ?>
            </div>

        </div>

    </div>

</footer>
<script src="../../../menu/jQueryScripts.js"></script>
</body>

</html>