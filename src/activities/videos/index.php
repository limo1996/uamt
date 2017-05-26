<?php
include('../../lang/langFunctions.php');
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
    <title><?php echo  $text->act_video; ?></title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Latest compiled and minified CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/mainStyles.css" type="text/css" rel="stylesheet">
    <link href="../../menu/menuStyles.css" type="text/css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../../menu/menuScripts.js"></script>


    <!-- Latest compiled JavaScript -->
    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <style media="all">
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");

        #tabs .tab-content {
            color : white;
            background-color: #0066cc;
            padding : 5px 15px;

        }

        #tabs h3 {
            color : white;
            background-color: #0066cc;
            padding : 5px 15px;


        }
        iframe{
            max-width: 100% !important;
        }


    </style>
</head>
<body>
<?php
include_once ("../../database/database.php");
$ex = new Database();
$js = $ex->fetchVideos();
function getYoutube($url)
{
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id ;
}
?>

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
                <li class="active"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text->act; ?><b
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
    <h2><?php echo  $text->act_video; ?></h2>
    <hr class="hr_nazov">
</div>


<div class="container">
  <div class="row">
    <div class="col-sm-3"></div>
    <div id="tabs" class="col-sm-6 center">
        <ul id="list" class="nav nav-tabs">
            <li class="active" id="labak"><a  href="#1" data-toggle="tab" >Labák</a></li>
            <li id="predmet"><a  href="#2" data-toggle="tab">Predmet</a></li>
            <li id="prop"><a  href="#3" data-toggle="tab">Propagácia</a></li>
            <li id="zariadenie"><a  href="#4" data-toggle="tab">Zariadenie</a></li>
        </ul>
    </div>
    <div class="col-sm-3"></div>




    <div class="col-sm-4"></div>
    <div class='w3-content'>
    <div class="tab-content col-sm-12 center">

        <div class="tab-pane active" id="1">
            <?php
          //  echo "<p>&nbsp;</p>";
           for($i=0;$i<count($js);$i++)
           {
                if($js[$i]["TYPE"]=="labák")
               {

                   echo "<h3 style='color:#0066cc!important; text-align: center '><i class='fa fa-youtube-play' style='line-height:6%;color:#0066cc!important;'></i> ".$js[$i]["NAME"]."</h3><br>";

                   echo "<iframe  width='500' height='300' src='".getYoutube($js[$i]['URL'])."'allowfullscreen  style='margin: auto;display: block'></iframe>";

               }
           }
           echo "<br><br>";

            ?>

        </div>

        <div class="tab-pane" id="2">
            <?php
           // echo "<p>&nbsp;</p>";
            for($i=0;$i<count($js);$i++)
            {
            if($js[$i]["TYPE"]=="predmet")
            {

                echo "<h3 style='color:#0066cc!important; text-align: center'><i class='fa fa-youtube-play' style='line-height:6%;color:#0066cc!important;'></i> ".$js[$i]["NAME"]."</h3><br>";
                echo "<iframe  width='500' height='300' src='".getYoutube($js[$i]['URL'])."' allowfullscreen style='margin: auto;display: block'></iframe>";
            }
            }
            echo "<br><br>";
            ?>
        </div>
        <div class="tab-pane" id="3">
            <?php
            //echo "<p>&nbsp;</p>";
            for($i=0;$i<count($js);$i++)
            {
                if($js[$i]["TYPE"]=="propagácia")
                {
                    echo "<h3 style='color:#0066cc!important; text-align: center'><i class='fa fa-youtube-play' style='line-height:6%;color:#0066cc!important;'></i> ".$js[$i]["NAME"]."</h3><br>";
                    echo "<iframe  width='500' height='300' src='".getYoutube($js[$i]['URL'])."' allowfullscreen style='margin: auto;display: block'></iframe>";
                }
            }
            echo "<br><br>";
            ?>
        </div>
        <div class="tab-pane" id="4">
            <?php
            //echo "<p>&nbsp;</p>";
            for($i=0;$i<count($js);$i++)
            {
                if($js[$i]["TYPE"]=="zariadenie")
                {
                    echo "<h3 style='color:#0066cc!important; text-align: center '><i class='fa fa-youtube-play' style='line-height:6%;color:#0066cc!important;'></i> ".$js[$i]["NAME"]."</h3><br>";
                    echo "<iframe  width='500' height='300' src='".getYoutube($js[$i]['URL'])."' allowfullscreen  style='margin: auto;display: block'></iframe>";
                }
            }
            echo "<br><br>";
            ?>
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
                    echo "<a href='index.php?lang=sk' style='color: yellow' > Slovensky jazyk </a>  | <a href='/uamt/index.php?lang=en'>  English </a>";
                else
                    echo "<a href='index.php?lang=sk' > Slovensky jazyk </a>  | <a href='/uamt/index.php?lang=en'  style='    color: yellow'>  English </a>";

                ?>
            </div>

        </div>

    </div>

</footer>
<script src="../../menu/jQueryScripts.js"></script>
</body>

</html>