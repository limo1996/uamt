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
    th{
        background-color: #F8F8F8;
        color:#0066cc;

    }
        th,td{
            text-align: center;
        }

    </style>
</head>
<body>
<?php
include (__DIR__.'/../database/database.php');
$ex = new Database();
$js = $ex->fetchMedia();
//var_dump($js);
?>
<div class="container">
    <div class="row">

    <table id="myTable" class="table table-bordered table-striped">
        <tr>
            <th>Názov</th><th>Média</th><th>Dátum</th><th>PDF</th><th>URL</th>
        </tr>
        <?php
        for($i=0;$i<count($js);$i++)
        {
            echo "<tr>";
            echo "<td>".$js[$i]['TITLE']."</td><td>".$js[$i]['MEDIA']."</td><td>".$js[$i]['DATE']."</td>";
            if(!empty($js[$i]['PDF']))
            {
                echo "<td><a target='blank' href ='".$js[$i]['PDF']."'>LINK</a></td>";
            }
            else echo "<td></td>";

            if(!empty($js[$i]['URL']))
            {
                echo "<td><a target='blank' href ='".$js[$i]['URL']."'>LINK</a></td>";
            }
            else echo "<td></td>";
            echo "</tr>";
        }
        ?>
    </table>

    </div>
</div>

</body>

</html>