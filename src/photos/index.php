<!DOCTYPE html>
<html>
<head lang="sk">
    <title>Fotogaléria</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="all">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style media="all">
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
        img{
            padding-top: 5px;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
<?php
//include (__DIR__.'/../database/database.php');
//$ex = new Database();

$js = array(
    array(
        "Date"=>"07.02.2017",
        "Title-SK"=>"Deň otvorených dverí na ÚAMT FEI STU",
        "Title-EN"=>"Open day at UAMT FEI STU",
        "Folder"=>"events001" ),
    array(
        "Date"=>"25.09.2015",
        "Title-SK"=>"Noc výskumníkov",
        "Title-EN"=>"Night of researchers",
        "Folder"=>"events002" )
          );


?>
<div class="container">
    <div class="row">

        <?php
        for($i=0;$i<count($js);$i++)
        {
            echo "<h3><i class='fa fa-camera' style='line-height:6%;color:#4268f4!important;'></i> ".$js[$i]['Title-SK']."</h3>";
            echo "<h4><i class='fa fa-calendar' style='line-height:6%;color:#4268f4!important;'></i> ".$js[$i]['Date']."</h4>";
            $dirname = $js[$i]['Folder']."/";
            $images = glob($dirname."*.*");
             echo "<div class='w3-row-padding'>";

            foreach($images as $image)
            {
                echo "<div class='w3-container w3-third'>";
                 echo "<img src='".$image."' style='width:100%;height:300px' onclick='onClick(this)' class='w3-hover-opacity'>";
                echo "</div>";

            }
            echo "</div>";
            echo "<hr>";
        }
        ?>
        <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
            <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
            <div class="w3-modal-content w3-animate-zoom">
                <img id="img01" style="width:100%">
            </div>
        </div>

    </div>
</div>
<script>
    function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
    }
</script>
</body>

</html>