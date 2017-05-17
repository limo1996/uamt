<!DOCTYPE html>
<html>
<head lang="sk">
    <title>Videá</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="all">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style media="all">
        #tabs .tab-content {
            color : white;
            background-color: #428bca;
            padding : 5px 15px;
        }

        #tabs h3 {
            color : white;
            background-color: #428bca;
            padding : 5px 15px;
        }

    </style>
</head>
<body>
<?php
include (__DIR__.'/../database/database.php');
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
<div class="container">
        <div class="jumbotron jumbotron-sm" style="background-color:#4268f4 !important;margin-top:2%;color:white !important;">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 id="videos" class="h2" style="margin-top:-2%">
                    Videá
                </h1>
            </div>
        </div>
    </div>
    <div id="tabs" class="col-sm-12">
        <ul id="list" class="nav nav-tabs">
            <li class="active" id="labak"><a  href="#1" data-toggle="tab" >Labák</a></li>
            <li id="predmet"><a  href="#2" data-toggle="tab">Predmet</a></li>
            <li id="prop"><a  href="#3" data-toggle="tab">Propagácia</a></li>
            <li id="zariadenie"><a  href="#4" data-toggle="tab">Zariadenie</a></li>
        </ul>
    </div>
    <div class="tab-content ">
        <div class="tab-pane active" id="1">
            <?php
           for($i=0;$i<count($js);$i++)
           {
               if($js[$i]["TYPE"]=="labák")
               {
                   echo "<h3>".$js[$i]["NAME"]."</h3><br>";
                   echo "<iframe width='420' height='345' src='".getYoutube($js[$i]['URL'])."'></iframe>";
               }
           }
            ?>

        </div>
        <div class="tab-pane" id="2">
            <?php
            for($i=0;$i<count($js);$i++)
            {
            if($js[$i]["TYPE"]=="predmet")
            {
            echo "<h3>".$js[$i]["NAME"]."</h3><br>";
            echo "<iframe width='420' height='345' src='".getYoutube($js[$i]['URL'])."'></iframe>";
            }
            }
            ?>
        </div>
        <div class="tab-pane" id="3">
            <?php
            for($i=0;$i<count($js);$i++)
            {
                if($js[$i]["TYPE"]=="propagácia")
                {
                    echo "<h3>".$js[$i]["NAME"]."</h3><br>";
                    echo "<iframe width='420' height='345' src='".getYoutube($js[$i]['URL'])."'></iframe>";
                }
            }
            ?>
        </div>
        <div class="tab-pane" id="4">
            <?php
            for($i=0;$i<count($js);$i++)
            {
                if($js[$i]["TYPE"]=="zariadenie")
                {
                    echo "<h3>".$js[$i]["NAME"]."</h3><br>";
                    echo "<iframe width='420' height='345' src='".getYoutube($js[$i]['URL'])."'></iframe>";
                }
            }
            ?>
        </div>
    </div>
</div>

</div>

</body>

</html>