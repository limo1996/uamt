<?php
include_once ("../../database/database.php");
session_start();

if(!$_SESSION['user']){
    header("Location:../index.php");
    die;
}

$db = new Database();

// zistenie roly
//---------------------------------------------
$result = $db->getUserRoles($_SESSION['user']);
$roles = array();
foreach($result as $role)
    $roles[] = $role['ROLE'];
//---------------------------------------------

if (!in_array("reporter", $roles) && !in_array("editor", $roles) && !in_array("admin", $roles)) {
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

    <link href="../../menu/menu2.css" type="text/css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/mainStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="../../menu/menuStylesIntranet.css" type="text/css" rel="stylesheet">
    <link href="style.css" type="text/css" rel="stylesheet">
    <script src="../../menu/menuScripts.js"></script>


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
                <li><a href="/uamt/intranet/pedagogika/index.php">Pedagogika</a></li>
                <li><a href="/uamt/intranet/doktorandi/index.php">Doktorandi</a></li>
                <li><a href="/uamt/intranet/publikacie/index.php">Publikácie</a></li>
                <li><a href="/uamt/intranet/sluzobneCesty/index.php">Služobné cesty</a></li>
                <li><a href="/uamt/intranet/nakupy/index.php">Nákupy</a></li>
                <li><a href="/uamt/intranet/attendance/index.php">Dochádzka</a></li>
                <li><a href="/uamt/intranet/rozdelenieUloh/index.php">Rozdelenie úloh</a></li>

            </ul>
        </div>
    </div>
</nav>


    <div id="nazov">
        <h2><?php echo "Pridať aktuality" ?></h2>
        <hr class="hr_nazov">
    </div>

    <nav class="main-menu">
        <ul>
            <li class="has-subnav">
                <a href="#">
                    <i class="fa fa-list fa-2x"></i>
                    <span class="nav-text"> </span>
                </a>

            </li>
            <li class="has-subnav ">
                <a href="/uamt/intranet/intranet.php">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">Domov intranet</span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="/uamt/">
                    <i class="fa fa-flag fa-2x"></i>
                    <span class="nav-text">Domov UAMT</span>
                </a>

            </li>
            <li>
                <a href="/uamt/intranet/upravitProfil/">
                    <i class="fa fa-user fa-2x"></i>
                    <span class="nav-text">Upraviť profil</span>
                </a>

            </li>

            <?php
            if (in_array("reporter", $roles) || in_array("editor", $roles) || in_array("admin", $roles)) {
                echo "
            <li class=\"has-subnav active\">
                <a href=\"/uamt/intranet/pridatAktuality\">
                    <i class=\"fa fa-font fa-2x\"></i>
                    <span class=\"nav-text\">Pridať aktuality</span>
                </a>
            </li>
            ";
            }

            if (in_array("reporter", $roles) || in_array("admin", $roles)) {
                echo "
            <li class=\"has-subnav\">
                <a href=\"/uamt/intranet/pridatFotky\">
                    <i class=\"fa fa-photo fa-2x\"></i>
                    <span class=\"nav-text\">Pridať fotky</span>
                </a>
            </li>
            
            <li class=\"has-subnav\">
                <a href=\"/uamt/intranet/pridatVidea\">
                    <i class=\"fa fa-play-circle fa-2x\"></i>
                    <span class=\"nav-text\">Pridať videa</span>
                </a>
            </li>
            
            ";
            }
            ?>

            <li>
                <a href="/uamt/intranet/logout.php">
                    <i class="fa fa-power-off fa-2x"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
        </ul>
    </nav>


    <div class="container space">
            <form  method="post" class ="form-vertical" enctype=multipart/form-data>
                <div class="form-group col-sm-4">
                    <label for="title">Nadpis</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>

                <div class="form-group col-sm-4">
                    <label for="desc">Popis</label>
                    <input type="text" class="form-control" name="desc" id="desc">
                </div>

                <div class="form-group col-sm-4">
                    <label for="datum">Datum</label>
                    <input type="date" class="form-control" name="datum" id="datum">
                </div>
                <div class="form-group col-sm-4">
                    <label for="jazyk">Jazyk:</label>
                    <select name="jazyk" class="form-control" id="jazyk">
                        <option value="SK">SK</option>
                        <option value="EN">EN</option>

                    </select>
                </div>
                <div class="form-group col-sm-4">
                        <label for="category">Kategória:</label>
                    <select name="category" class="form-control" id="category" >
                        <option value="Oznamy">Oznamy</option>
                        <option value="Propagácia">Propagácia</option>
                        <option value="Zo života ústavu">Zo života ústavu</option>
                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <label for="pic">Obrázok</label>
                    <input type="file" name="pic" id="pic" accept="*.jpeg"><br>
                </div>

                <div class="form-group col-sm-12 ">
                    <label for="Text">Text:</label>
                    <textarea class="form-control" rows="10" id="text" name="text"></textarea>
                </div>

                <div class="col-sm-12 text-right">
                    <button type="submit" class="btn btn-success" name="add">
                        <span class="glyphicon glyphicon-plus"></span> Pridať aktualitu
                    </button>
                </div>

            </form>

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
                Slovenský jazyk
            </div>

        </div>

    </div>




</footer>
<script src="../../menu/jQueryScripts.js"></script>
</body>
</html>

<?php
if(isset($_POST['add'])) {

    $text=$_POST['text'];
    $title=$_POST['title'];
    $desc = $_POST['desc'];
    $datum = $_POST['datum'];
    $category = $_POST['category'];
    $jazyk = $_POST['jazyk'];
    var_dump($_FILES["pic"]);
    if(isset($_FILES["pic"]) && $_FILES["pic"]["name"]!=""){
        echo "preslo cez podmienku";
        $filename = $_FILES["pic"];
        $file = $_FILES["pic"];
        $tmp_name = $file["tmp_name"];
        $filename = $file["name"];
        $target="pic/";
        chmod($tmp_name,0777);
        if(move_uploaded_file($tmp_name, $target.$filename)){
            chmod($target.$filename,0777);
            echo "success";
        }
    }
    else{
    $filename="fei.jpg";
    }

$db->insertNews($title,$desc,$datum,$category,$jazyk,$filename);
    $id=$db->fetchIdOfNews($title,$datum);
   $file="texty.txt";
    chmod($file,0777);
     /* $a =[
            [
            'ID' => $id[0]['ID'],
            'Text' => $text
            ]
          ];*/

     $cont=file_get_contents("texty.txt");
     echo "Cont:".$cont;
     $parts=explode("[",$cont);
     echo "Part1".$parts[1];
     $last=explode("]",$parts[1]);
     echo "Last".$last[0];
   $a->id=$id[0]['ID'];
   $a->text=$text;
   if($last[0]=="") {
       $all = "[" . $last[0] . json_encode($a) . "]";
   }
   else{
       $all = "[" . $last[0] .",". json_encode($a) . "]";
   }
   var_dump($parts);
   var_dump($all);
    //file_put_contents($file, "\n",FILE_APPEND);
    file_put_contents($file,$all);


/*    $subject = "UAMT-Newsletter";


    if($jazyk=='SK'){
        $message = "<h1>".$title."</h1><br>";
        $message .= $desc."<br>";
        $message .= "Dátum : ".$datum."<br>";
        $message .= "Kategória : ".$category."<br>";
        $message .="<br>Na stránke pribudla nova aktualita <br> navštív našu stránku pre viac informácii http://147.175.98.167/uamt/news/<br> Tvoj UAMT Tím ";
    }
    else{
        $message = "<h1>".$title."</h1><br>";
        $message .= $desc."<br>";
        $message .= "Date : ".$datum."<br>";
        $message .= "Category : ".$category."<br>";
        $message .="<br>News was added to page <br> for more information please visit our page http://147.175.98.167/uamt/news/ <br>UAMT Team ";
    }
    $header = "From:UAMT \r\n";

    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    $subs=$db->fetchSubsByLang($jazyk);
    foreach ($subs as $sub ){
        //var_dump($sub);
        $retval = mail ($sub['Email'],$subject,$message,$header);
        if( $retval == true ) {
            echo "Message sent successfully...";
        }else {
            echo "Message could not be sent...";
        }
    }*/



}
?>