<!DOCTYPE html>
<html>
<head lang="sk">
    <title>Médiá</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="all">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style media="all">
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
    </style>
</head>
<body>
<?php
include (__DIR__.'/../database/database.php');
$ex = new Database();
$js = $ex->fetchMedia();

?>
<div class="container">
    <div class="row">
        <?php
        for($i=0;$i<count($js);$i++)
        {
           echo "<h3><i class='fa fa-camera' style='line-height:6%;color:#4268f4!important;'></i> ".$js[$i]['TITLE']."</h3>";
           echo "<h4><i class='fa fa-newspaper-o' style='line-height:6%;color:#4268f4!important;'></i> ".$js[$i]['MEDIA']."</h4>";
           if(strpos($js[$i]['DATE'], '.') !== false)
           {
            $date = str_replace('.', '/',$js[$i]['DATE'] );
           }
           else
            {
                $date = $js[$i]['DATE'];
            }
            echo "<h4><i class='fa fa-calendar' style='line-height:6%;color:#4268f4!important;'></i> ".$date."</h4>";
            if(!empty($js[$i]['PDF']))
            {
                echo "<h4><i class='fa fa-file-pdf-o' style='line-height:6%;color:#4268f4!important;'></i><a target='_blank' href ='".$js[$i]['PDF']."'> Zisti viac</a></h4>";
            }
            if(!empty($js[$i]['URL']))
            {
                echo "<h4><i class='fa fa-external-link' style='line-height:6%;color:#4268f4!important;'></i><a target='_blank' href ='".$js[$i]['URL']."'> Zisti viac</a></h4>";
            }
            echo "<hr>";
        }
        ?>


    </div>
</div>

</body>

</html>