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
?>
<!DOCTYPE html>
<html>
<head lang="sk">
    <title><?php echo $text->study_candidate_ing;;?></title>
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
                <li><a href="/uamt/"><i class="fa fa-home fa-1x"></i></></a></li>
                <li ><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $text->about; ?><b
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
                <li class="active"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $text->study; ?><b
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
                <li><a href="/uamt/contactPage/index.php"><?php echo $text->contact; ?></a></li>
                <li><a href="#" style="color:purple"><i class="fa fa-user fa-1x" style="color: purple!important;"></i> Intranet</a></li>
                <!--   <li><a href="#"><button type="button" class="button-menu btn btn-primary btn-sm">Primary</button></a></li>-->

            </ul>
        </div>
</nav>
<div id="nazov">
    <h2><?php echo $text->study_candidate . " - ". $text->study_candidate_ing;;?></h2>
    <hr class="hr_nazov">
</div>


<div id="content">
    <div class="col-sm-3"></div>

    <div class="col-sm-6">

        <article>
            <p>Prečo študovať na našom ústave?</p>
            <ul>
                <li>možnosť získať znalosti, ktoré sú implementovateľné v praxi,</li>
                <li>menšie skupiny študentov,</li>
                <li>možnosť dohodnúť si tému pre diplomovku s vybraným pedagógom na základe vlastných preferencií,</li>
                <li>možnosť riešiť diplomovú prácu a teda to, čo každého zaujíma, až 3 semestre,</li>
                <li>pre vynikajúcich študentov možnosť študovať dištančnou metódou,</li>
                <li>pre absolventov bakalárskeho štúdia na FEI STU odpustená prijímacia skúška,</li>
                <li>snaha o maximálnu informovanosť študentov prostredníctvom web stránky v dostatočnom predstihu.</li>
            </ul>
            <p>Nebudem mať problémy, keď som neštudoval mechatroniku aj na bakalárskom štúdiu?</p>
            <ul>
                <li>Mechatronika predstavuje medziodborové štúdium, takže každý by sa tu mal nájsť. Hneď v prvom semestri inžinierskeho štúdia je pre študentov, ktorí predtým neštudovali mechatroniku pripravený vyrovnávací predmet z oblasti automatizácie.
                </li>
            </ul>
            <p>&nbsp;</p>
            <h3>Študijný program – 1. ročník</h3>
            <p>Zimný semester</p>
            <ul>
                <li><b>CAE mechatronických systémov</b> - tvorba virtuálnych dynamických modelov a ich simulácia</li>
                <li><b>Metóda konečných prvkov</b> - modelovanie a analýza mechatronických prvkov a systémov</li>
                <li><b>Optimalizácia procesov v mechatronike</b> – optimalizačné úlohy a metódy v inžinierskych aplikáciách</li>
                <li><b>Vývojové programové prostredia pre mechatronické systémy</b> - programovanie mikroprocesorov</li>
                <li><b>Povinne voliteľný predmet</b></li>
            </ul>
            <p>Letný semester</p>
            <ul>
                <li><b>Diplomový projekt 1</b></li>
                <li><b>Metódy číslicového riadenia</b> – návrh regulačných obvodov pre modely mechatronických systémov</li>
                <li><b>Multifyzikálne procesy v mechatronike</b> - modelovanie tepelných, termoelastických, termoelektrických a piezoelektrických systémov</li>
                <li><b>Pokročilé informačné technológie</b> - klient-server aplikácie, riadenie mechatronických systémov v prostredí internetu, Internet vecí (IoT), Industry 4.0</li>
                <li><b>Povinne voliteľný predmet</b></li>
            </ul>
            <p>&nbsp;</p>


            <p><b><i>Možné PVP pre záujemcov o elektroniku</i></b></p>
            <ul style="list-style-type:none">
                <li><b>Inteligentné mechatronické systémy</b> - implementácia metód výpočtovej a umelej inteligencie pre mechatronické systémy</li>
                <li><b>MEMS - inteligentné senzory a aktuátory</b> - najmodernejšie senzory používané nielen v automobilovom priemysle (akcelerometre, gyroskopy, CCD senzory) a spracovanie signálov vnorenými mikropočítačmi</li>
            </ul>

            <p><b><i>Možné PVP pre záujemcov o automobily</i></b></p>
            <ul style="list-style-type:none">
                <li><b>Transmisné systémy automobilov a elektromobilov </b> - prevodové mechanizmy automobilov a elektromobilov</li>
                <li><b>Pohonné systémy a zdroje v elektromobiloch </b> - modelovanie a simulovanie činnosti trakčného a energetického systému elektromobilu</li>
            </ul>
            <p><b><i>Možné PVP pre záujemcov o informatiku</i></b></p>
            <ul style="list-style-type:none">
                <li><b>Inteligentné mechatronické systémy </b> - implementácia metód výpočtovej a umelej inteligencie pre mechatronické systémy</li>

                <li><b>Vybrané kapitoly z automatického riadenia pre mechatroniku </b> mechatroniku - vyrovnávací predmet z automatizácie</li>
                <li><b>MEMS - inteligentné senzory a aktuátory  </b> - najmodernejšie senzory používané nielen v automobilovom priemysle (akcelerometre, gyroskopy, CCD senzory) a spracovanie signálov vnorenými mikropočítačmi</li>
            </ul>


        </article>
        <p>&nbsp;</p>
        <p>Kompletný študijný plán pre akademický rok 2017-2018 (<a href="/uamt/study/SP20172018i.pdf">SP20172018i.pdf</a>)</p>
        <p>Prijímacie skúšky na inžinierske štúdium			28.6.2017 o 10:00 v D124</p>
        <p>Prijímacia komisia:</p>
        <ul>
            <li>prof. Ing. Mikuláš Huba, PhD. (predseda)</li>
            <li>prof. Ing. Justín Murín, DrSc. (predseda)</li>
            <li>prof. Ing. Viktor Ferencey, PhD.</li>
            <li>prof. Ing. Štefan Kozák, PhD.</li>
            <li>doc. Ing. Katarína Žáková, PhD.</li>
        </ul>
        <p>Ďalšie informácie na <a href="http://www.mechatronika.cool">http://www.mechatronika.cool</a></p>
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
                    echo "<a href='index.php?lang=sk' style='color: yellow' > Slovensky jazyk   | <a href='/uamt/index.php?lang=en'>  English </a>";
                else
                    echo "<a href='index.php?lang=sk' > Slovensky jazyk   | <a href='/uamt/index.php?lang=en'  style='    color: yellow'>  English </a>";

                ?>
            </div>

        </div>

    </div>
    </div>
</footer>
<script src="../../../menu/jQueryScripts.js"></script>
</body>

</html>