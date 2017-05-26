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
$name = "";
if(isset($_POST['loadProfile'])) {
    $id = $_POST['selectEmployee'];
    if ($id == "")
        header("Location:index.php");
    else
        header("Location:index.php?id=$id");
}

if(isset($_POST['add_emp'])) {

    $target_dir = "../../employees/photos/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            chmod($target_file, 0777);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $new_name = $_POST["name"];
    $new_surname = $_POST["surname"];
    $new_title1 = $_POST["title1"];
    $new_title2 = $_POST["title2"];
    $new_ldaplogin = $_POST["ldaplogin"];
    $new_photo = basename($_FILES["fileToUpload"]["name"]);
    $new_room = $_POST["room"];
    $new_phone = $_POST["phone"];
    $new_department = $_POST["department"];
    $new_staff_role = $_POST["staff_role"];
    $new_function = $_POST["function"];

    if ($new_name != "" || $new_surname != "" || $new_ldaplogin = "") {
        $db->insertNewEmployee($new_name, $new_surname, $new_title1, $new_title2, $new_ldaplogin, $new_photo, $new_room, $new_phone, $new_department, $new_staff_role, $new_function);


        if (!empty($_POST['role_list']) && $new_ldaplogin != "") {
            $new_id = $db->getEmployeeByLDAP($new_ldaplogin);
            foreach ($new_id as $e)
                $new_id = $e["ID"];
            echo $new_id;

            foreach ($_POST['role_list'] as $check) {
                $db->insertUserRoles($new_id, $check);
            }
        }
    }

    header("Location:index.php");
}

$id = $_GET['id'];
if(isset($_POST['save_emp'])) {

    $target_dir = "../../employees/photos/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            chmod($target_file, 0777);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $update_name = $_POST["name"];
    $update_surname = $_POST["surname"];
    $update_title1 = $_POST["title1"];
    $update_title2 = $_POST["title2"];
    $update_ldaplogin = $_POST["ldaplogin"];
    $update_photo = basename($_FILES["fileToUpload"]["name"]);
    $update_room = $_POST["room"];
    $update_phone = $_POST["phone"];
    $update_department = $_POST["department"];
    $update_staff_role = $_POST["staff_role"];
    $update_function = $_POST["function"];

    $db->deleteUserRoles($id);
    if(!empty($_POST['role_list'])) {
        foreach ($_POST['role_list'] as $check) {
            $db->insertUserRoles($id, $check);
        }
    }

    $db->updateEmployee($id, $update_name, $update_surname, $update_title1, $update_title2, $update_ldaplogin, $update_photo, $update_room, $update_phone, $update_department, $update_staff_role, $update_function);

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
    <link href="styles/styles.css" type="text/css" rel="stylesheet">
    <script src="../../menu/menuScripts.js"></script>
    <script src="script/script.js"></script>

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
    <h2><?php echo "Upraviť profil" ?></h2>
    <hr class="hr_nazov">
</div>

<nav class="main-menu">
    <ul>

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
        <li class="has-subnav active">
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

<div class="container">
    <?php
    if (in_array("admin", $roles)) {
        echo "
            <form action=\"\" method=\"post\">
                <div class=\"form-group col-md-9 col-md-offset-3\">
                    <select id=\"selectEmployee\" name=\"selectEmployee\" class=\"selectpicker\" title=\"Nový Zamestnanec\">
            ";
        echo "<option value='' style='background-color: #b3c6ff'> Nový Zamestnanec  </option>";
        $employees = $db->fetchEmployees();
        foreach ($employees as $employee) {
            $employee_id = $employee['ID'];
            $employee_name = $employee['FIRST_NAME'];
            $employee_surname = $employee['SECOND_NAME'];
            $sel = "";
            if ($id == $employee_id) {
                $sel = "selected";
            }
            echo "<option value='$employee_id' $sel> $employee_name $employee_surname </option>";
        }
        echo "
                    </select>
                    <button type=\"submit\" class=\"btn btn-info active\" name=\"loadProfile\"><span class=\"glyphicon glyphicon-save\"></span> Načítať údaje profilu</button>
                </div>
            </form>
            ";
    }

    echo $name;
    if (id != "" && in_array("admin", $roles)) {
        $employee = $db->getEmployeeByID($id);
        foreach ($employee as $emp) {
            $employee = $emp;
        }

        $name = $employee["FIRST_NAME"];
        $surname = $employee["SECOND_NAME"];
        $title1 = $employee["TITLE1"];
        $title2 = $employee["TITLE2"];
        $ldaplogin = $employee["LDAPLOGIN"];

        $rol = $db->getUserRoles($ldaplogin);
        $employee_roles = array();
        foreach($rol as $r)
            $employee_roles[] = $r['ROLE'];
        $room = $employee["ROOM"];
        $phone = $employee["PHONE"];
        $department = $employee["DEPARTMENT"];
        $staff_role = $employee["STAFF_ROLE"];
        $function = $employee["FUNCTION"];
    }
    ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="well well-sm">
                <form class="form-horizontal borders" action="" method="post" enctype="multipart/form-data">
                    <fieldset>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Meno</label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text" placeholder="Meno" value="<?php echo $name;?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="surname">Priezvisko</label>
                            <div class="col-md-9">
                                <input id="surname" name="surname" type="text" placeholder="Priezvisko" value="<?php echo $surname;?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="room">Miestnosť</label>
                            <div class="col-md-9">
                                <input id="room" name="room" type="text" placeholder="Kancelária" value="<?php echo $room;?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="phone">Telefón</label>
                            <div class="col-md-9">
                                <input id="phone" name="phone" type="number" placeholder="Telefón" value="<?php echo $phone;?>" class="form-control">
                            </div>
                        </div>

                        <?php
                        if (in_array("admin", $roles)) {
                            echo "
                                
                                <div class=\"form-group\">
                                    <label class=\"col-md-3 control-label\" for=\"title1\">Titul 1</label>
                                    <div class=\"col-md-9\">
                                        <input id=\"title1\" name=\"title1\" type=\"text\" placeholder=\"Titul 1\" value=\"$title1\" class=\"form-control\">
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"col-md-3 control-label\" for=\"title2\">Titul 2</label>
                                    <div class=\"col-md-9\">
                                        <input id=\"title2\" name=\"title2\" type=\"text\" placeholder=\"Titul 2\" value=\"$title2\" class=\"form-control\">
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"col-md-3 control-label\" for=\"department\">Oddelenie</label>
                                    <div class=\"col-md-9\">
                                        <input id=\"department\" name=\"department\" type=\"text\" placeholder=\"Oddelenie\" value=\"$department\" class=\"form-control\">
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"col-md-3 control-label\" for=\"staff_role\">Typ zamestnanca</label>
                                    <div class=\"col-md-9\">
                                        <input id=\"staff_role\" name=\"staff_role\" type=\"text\" placeholder=\"Typ zamestnanca\" value=\"$staff_role\" class=\"form-control\">
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"col-md-3 control-label\" for=\"function\">Funkcia</label>
                                    <div class=\"col-md-9\">
                                        <input id=\"function\" name=\"function\" type=\"text\" placeholder=\"Funkcia\" value=\"$function\" class=\"form-control\">
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"col-md-3 control-label\" for=\"ldaplogin\">LDAP login</label>
                                    <div class=\"col-md-9\">
                                        <input id=\"ldaplogin\" name=\"ldaplogin\" type=\"text\" placeholder=\"LDAP login\" value=\"$ldaplogin\" class=\"form-control\">
                                    </div>
                                </div>

                                <div id='permissions' class=\"form-group\">
                                    <label class=\"col-md-3 control-label\" for=\"role_list\">Práva</label>
                                    <div class=\"btn-group col-md-9\" data-toggle=\"buttons\">
                                ";

                            if (in_array("user", $employee_roles))
                                echo "
                                        <label class=\"btn btn-default active\">
                                            <input type=\"checkbox\" name=\"role_list[]\" autocomplete=\"off\" value=\"1\" checked>
                                            <span class=\"glyphicon glyphicon-ok\"></span> user
                                        </label>                                  
                                        ";
                            else
                                echo "
                                        <label class=\"btn btn-default\">
                                            <input type=\"checkbox\" name=\"role_list[]\" autocomplete=\"off\" value=\"1\">
                                            <span class=\"glyphicon glyphicon-ok\"></span> user
                                        </label> 
                                        ";
                            if (in_array("hr", $employee_roles))
                                echo "
                                        <label class=\"btn btn-default active\">
                                            <input type=\"checkbox\" name=\"role_list[]\" autocomplete=\"off\" value=\"2\" checked>
                                            <span class=\"glyphicon glyphicon-ok\"></span> hr
                                        </label>                                 
                                        ";
                            else
                                echo "
                                        <label class=\"btn btn-default\">
                                            <input type=\"checkbox\" name=\"role_list[]\" autocomplete=\"off\" value=\"2\">
                                            <span class=\"glyphicon glyphicon-ok\"></span> hr
                                        </label>
                                        ";
                            if (in_array("reporter", $employee_roles))
                                echo "
                                        <label class=\"btn btn-default active\">
                                            <input type=\"checkbox\" name=\"role_list[]\" autocomplete=\"off\" value=\"3\" checked>
                                            <span class=\"glyphicon glyphicon-ok\"></span> reporter
                                        </label>                                 
                                        ";
                            else
                                echo "
                                        <label class=\"btn btn-default\">
                                            <input type=\"checkbox\" name=\"role_list[]\" autocomplete=\"off\" value=\"3\">
                                            <span class=\"glyphicon glyphicon-ok\"></span> reporter
                                        </label>
                                        ";
                            if (in_array("editor", $employee_roles))
                                echo "
                                        <label class=\"btn btn-default active\">
                                            <input type=\"checkbox\" name=\"role_list[]\" autocomplete=\"off\" value=\"4\" checked>
                                            <span class=\"glyphicon glyphicon-ok\"></span> editor
                                        </label>                                 
                                        ";
                            else
                                echo "
                                        <label class=\"btn btn-default\">
                                            <input type=\"checkbox\" name=\"role_list[]\" autocomplete=\"off\" value=\"4\">
                                            <span class=\"glyphicon glyphicon-ok\"></span> editor
                                        </label>
                                        ";
                            if (in_array("admin", $employee_roles))
                                echo "
                                        <label class=\"btn btn-default active\">
                                            <input type=\"checkbox\" name=\"role_list[]\" autocomplete=\"off\" value=\"5\" checked>
                                            <span class=\"glyphicon glyphicon-ok\"></span> admin
                                        </label>                                
                                        ";
                            else
                                echo "
                                        <label class=\"btn btn-default\">
                                            <input type=\"checkbox\" name=\"role_list[]\" autocomplete=\"off\" value=\"5\">
                                            <span class=\"glyphicon glyphicon-ok\"></span> admin
                                        </label>
                                        ";

                            echo "</div>";
                            echo "</div>";
                        }
                        ?>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="fileToUpload">Fotografia</label>
                            <div class="col-md-9">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                        </div>

                        <?php
                        if ($id != "" || !in_array("admin", $roles)) {
                            echo "
                                <div class=\"form-group\">
                                    <div class=\"col-md-12 text-right\">
                                        <button type=\"submit\" name='save_emp' class=\"btn btn-success active\"><span class=\"glyphicon glyphicon-ok\"></span> Uložiť</button>
                                    </div>
                                </div>
                                ";
                        }
                        else
                            echo "
                                <div class=\"form-group\">
                                    <div class=\"col-md-12 text-right\">
                                        <button type=\"submit\" name='add_emp' class=\"btn btn-success active\"><span class=\"glyphicon glyphicon-ok\"></span> Pridať</button>
                                    </div>
                                </div>
                                ";
                        ?>
                    </fieldset>
                </form>
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
                <a href='../../../../../Desktop/Nový%20priečinok%20(3)/index.php?lang=sk' style='color: white' > Slovensky jazyk</a>
            </div>

        </div>

    </div>
    </div>



</footer>
<script src="../../menu/jQueryScripts.js"></script>
</body>
</html>