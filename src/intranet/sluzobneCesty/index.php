<?php
include_once ("../../database/database.php");
session_start();

if(!$_SESSION['user']){
    header("Location:../index.php");
    die;
}

$tab = "sluzobnecesty";
$db = new Database();

// zistenie roly
//---------------------------------------------
$result = $db->getUserRoles($_SESSION['user']);
$roles = array();
foreach($result as $role)
    $roles[] = $role['ROLE'];
//---------------------------------------------

if(isset($_POST['add']))
{
    if ($_POST["attach"] == 'link') {
        $source = $_POST["linkToFile"];
    }
    else {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                chmod($target_file, 0777);
            } else {
                header("Location:index.php");
            }
        }
        $source = $target_file;
    }

    $documentName = $_POST["documentName"];

    if ($_POST["categ"] == 'choose') {
        $category = $_POST["selectedCategory"];
    }
    else {
        $category = $_POST["categoryName"];
    }

    $db->insertDocument($documentName, $source, $category, $tab);

    header("Location:index.php");
}

if(isset($_POST['delete'])) {
    $delete = $_POST['delete'];

    $sources = $db->getDocumentSource($delete);
    foreach($sources as $source) {
        if (substr($source["source"],0,7) == "uploads") {
            unlink($source["source"]);
        }
    }
    $db->deleteDocument($delete);
    header("Location:index.php");
}

if(isset($_POST['save']))
{
    $source = null;
    $documentName = null;
    $update = $_POST['save'];
    if ($_POST["attach2"] == 'link2' && (isset($_POST["linkToFile2"]) || trim($_POST["linkToFile2"]) != '')) {
        $source = $_POST["linkToFile2"];
        $sources = $db->getDocumentSource($update);
        foreach($sources as $source) {
            if (substr($source["source"],0,7) === "uploads") {
                unlink($source["source"]);
            }
        }
    }
    else if ($_POST["attach2"] == 'file2' && !empty($_FILES['fileToUpload2']['name'])) {

        $sources = $db->getDocumentSource($update);
        foreach($sources as $source) {
            if (substr($source["source"],0,7) === "uploads") {
                unlink($source["source"]);
            }
        }

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
        $uploadOk = 1;

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
        } else {
            if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) {
                chmod($target_file, 0777);
            } else {
                header("Location:index.php");
            }
        }
        $source = $target_file;
    }
    $documentName = $_POST["documentName2"];

    $db->updateDocument($update, $documentName, $source);

    header("Location:index.php");
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
                <li><a href="/uamt/intranet/pedagogika/index.php">Pedagogika</a></li>
                <li><a href="/uamt/intranet/doktorandi/index.php">Doktorandi</a></li>
                <li><a href="/uamt/intranet/publikacie/index.php">Publikácie</a></li>
                <li class="active"><a href="/uamt/intranet/sluzobneCesty/index.php">Služobné cesty</a></li>
                <li><a href="/uamt/intranet/nakupy/index.php">Nákupy</a></li>
                <li><a href="/uamt/intranet/attendance/index.php">Dochádzka</a></li>
                <li><a href="/uamt/intranet/rozdelenieUloh/index.php">Rozdelenie úloh</a></li>

            </ul>
        </div>
    </div>
</nav>

<div id="nazov">
    <h2><?php echo "Služobné cesty" ?></h2>
    <hr class="hr_nazov">
</div>

<nav class="main-menu">
    <ul>  <li class="has-subnav">
            <a href="#">
                <i class="fa fa-list fa-2x"></i>
                <span class="nav-text"> </span>
            </a>

        </li>

        <li class="has-subnav">
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
        <li class="has-subnav">
            <a href="/uamt/intranet/pridatAktuality">
                <i class="fa fa-font fa-2x"></i>
                <span class="nav-text">Pridať aktuality</span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="/uamt/intranet/pridatFotky">
                <i class="fa fa-photo fa-2x"></i>
                <span class="nav-text">Pridať fotky</span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="/uamt/intranet/pridatVidea">
                <i class="fa fa-play-circle fa-2x"></i>
                <span class="nav-text">Pridať videa</span>
            </a>

        </li>


        <li>
            <a href="/uamt/intranet/logout.php">
                <i class="fa fa-power-off fa-2x"></i>
                <span class="nav-text">Logout</span>
            </a>
        </li>
    </ul>
</nav>


<div class="container space">
    <div class="col-sm-2">
    </div>

    <div class="col-sm-8">
        <div id="documents">
            <?php
            $categories = $db->getTabCategories($tab);
            $documents = $db->getTabDocuments($tab);

            foreach($categories as $category) {
                $categ = $category['category'];
                echo "<h3> $categ </h3>";

                echo "<table id='$categ' class='table table-striped'>";

                echo "<thead>";
                echo "<tr>";
                echo "<th >Dokument</th>";
                echo "<th class='sortable'>Príloha</th>";
                echo "</tr>";
                echo "</thead>";

                echo "<tbody>";

                foreach($documents as $document) {
                    if($document['CATEGORY'] == $categ) {
                        $id = $document['ID'];
                        echo "<tr>";
                        echo "<td>" . $document['NAME'] . "</td>";
                        echo "<td class='right_pos'> <a href=" . $document['SOURCE'] . " class='btn btn-block btn-xs btn-success'><span class='glyphicon glyphicon-save'></span> Stiahnuť</a> </td>";
                        if (in_array("admin", $roles) || in_array("editor", $roles)) {
                            echo "<td class='right_pos'><button id='update' class='btn btn-block btn-xs btn-info' name='update' value='$id' type='Submit' data-toggle='modal' data-target='#myModal2'><span class='glyphicon glyphicon-pencil'></span> Upraviť</button></td>";
                            echo "<td class='right_pos'> 
                                    <form method='post'>
                                        <button name='delete' class='btn btn-block btn-xs btn-danger' type='Submit' value='$id'><span class='glyphicon glyphicon-remove'></span></button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                    }
                }
                echo "</tbody>";
                echo "</table> <br>";
            }

            ?>
        </div>

        <?php
        if (in_array("admin", $roles) || in_array("editor", $roles)) {
            echo " <button id=\"newDocument\" class=\"btn btn-primary btn-primary\" type=\"button\" data-toggle=\"modal\" data-target=\"#myModal\"><span class=\"glyphicon glyphicon-open\"></span> Nový dokument</button>";
            echo " 
            <!-- Modal -->
            <div class=\"modal fade\" id=\"myModal\" role=\"dialog\">
                <div class=\"modal-dialog\">
                    <!-- Modal content-->
                    <div class=\"modal-content form-area\">
                        <div class=\"modal-header\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                            <h4 class=\"modal-title\">Nový dokument</h4>
                        </div>
                        <form id=\"Document_Form\" action=\"\" method=\"POST\" name=\"Document_Form\" role=\"form\" enctype=\"multipart/form-data\">
                            <div class=\"modal-body\">
                                <br style=\"clear:both\">
                                <div class=\"form-group\">
                                    <input type=\"text\" class=\"form-control\" id=\"documentName\" name=\"documentName\" placeholder=\"Názov dokumentu\" required>
                                </div>
                                <div class=\"funkyradio\">
                                    <div class=\"funkyradio-success\">
                                        <input type=\"radio\" name=\"categ\" id=\"choose\" value=\"choose\" required>
                                        <label for=\"choose\">Vybrať kategóriu</label>
                                    </div>
                                    <div class=\"funkyradio-success\">
                                        <input type=\"radio\" name=\"categ\" id=\"create\" value=\"create\" required>
                                        <label for=\"create\">Nová kategória</label>
                                    </div>
                                </div>
                                <div id=\"selectCategory\">
                                    <select id=\"selectedCategory\" name=\"selectedCategory\" class=\"selectpicker\" title=\"Výber kategórie\">
            
            ";
            foreach ($categories as $category) {
                $categ = $category['category'];
                echo "<option value='$categ'> $categ </option>";
            }
            echo "                  
                                    </select>
                                </div>
                                <div id=\"newCategory\">
                                    <div class=\"form-group\">
                                        <input type=\"text\" class=\"form-control\" id=\"categoryName\" name=\"categoryName\" placeholder=\"Názov kategórie\">
                                    </div>
                                </div>
                                <div class=\"funkyradio\">
                                    <div class=\"funkyradio-success\">
                                        <input type=\"radio\" name=\"attach\" id=\"file\" value=\"file\" required>
                                        <label for=\"file\">Vložiť súbor</label>
                                    </div>
                                    <div class=\"funkyradio-success\">
                                        <input type=\"radio\" name=\"attach\" id=\"link\" value=\"link\" required>
                                        <label for=\"link\">Vložiť odkaz</label>
                                    </div>
                                </div>
                                <div id=\"attachFile\">
                                    <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">
                                </div>
                                <div id=\"attachLink\" class=\"form-group\">
                                    <input type=\"text\" class=\"form-control\" id=\"linkToFile\" name=\"linkToFile\" placeholder=\"Odkaz na dokument\">
                                </div>
                            </div>
                             <div class=\"modal-footer\">
                                 <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Zrušiť</button>
                                 <button name=\"add\" value=\"add\" type=\"Submit\" class=\"btn btn-primary\">Pridať</button>
                             </div>
                         </form>
                    </div>
                </div>
            </div>
        
            <!-- Modal -->
            <div class=\"modal fade\" id=\"myModal2\" role=\"dialog\">
                <div class=\"modal-dialog\">
                    <!-- Modal content-->
                    <div class=\"modal-content form-area\">
                        <div class=\"modal-header\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                            <h4 class=\"modal-title\">Upraviť dokument</h4>
                        </div>
                        <form id=\"Document_Form2\" action=\"\" method=\"POST\" name=\"Document_Form2\" role=\"form\" enctype=\"multipart/form-data\">
                            <div class=\"modal-body\">
                                <br style=\"clear:both\">
                                <div class=\"form-group\">
                                    <input type=\"text\" class=\"form-control\" id=\"documentName2\" name=\"documentName2\" placeholder=\"Názov dokumentu\">
                                </div>
                                <div class=\"funkyradio\">
                                    <div class=\"funkyradio-success\">
                                        <input type=\"radio\" name=\"attach2\" id=\"file2\" value=\"file2\">
                                        <label for=\"file2\">Zmeniť súbor</label>
                                    </div>
                                    <div class=\"funkyradio-success\">
                                        <input type=\"radio\" name=\"attach2\" id=\"link2\" value=\"link2\">
                                        <label for=\"link2\">Zmeniť odkaz</label>
                                    </div>
                                </div>
                                <div id=\"attachFile2\">
                                    <input type=\"file\" name=\"fileToUpload2\" id=\"fileToUpload2\">
                                </div>
                                <div id=\"attachLink2\" class=\"form-group\">
                                    <input type=\"text\" class=\"form-control\" id=\"linkToFile2\" name=\"linkToFile2\" placeholder=\"Odkaz na dokument\">
                                </div>
                            </div>
                            <div class=\"modal-footer\">
                                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Zrušiť</button>
                                <button id=\"save\" name=\"save\" type=\"Submit\" class=\"btn btn-primary\">Uložiť</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>";
        }
        ?>
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
                Slovenský jazyk
            </div>

        </div>

    </div>
    </div>



</footer>
<script src="../../menu/jQueryScripts.js"></script>
</body>
</html>