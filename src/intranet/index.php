<?php
session_start();

if(isset($_SESSION['user']))   // Checking whether the session is already there or not if
    // true then header redirect it to the home page directly
{
    header("Location:intranet.php");
}

include('../lang/langFunctions.php');
$lang = 'sk';

if (isset($_GET['lang']))
    $lang = $_GET['lang'];

$lan = new Text($lang);
$text = $lan->getTextForPage('menu');

if(isset($_POST['Login']))   // it checks whether the user clicked login button or not
{
    $ldap_server = "ldap.stuba.sk";

    $username = $_POST["Username"];
    $password = $_POST["Password"];

    if ($connect = @ldap_connect($ldap_server)) { // if connected to ldap server

        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);

        // bind to ldap connection
        if (($bind = @ldap_bind($connect)) == false) {
            print "bind:__FAILED__<br>\n";
            echo "bad";
        }

        // search for user
        else if (($res_id = ldap_search($connect, "dc=stuba, dc=sk", "uid=$username")) == false) {
            print "failure: search in LDAP-tree failed<br>";
            echo "bad";
        }

        else if (ldap_count_entries($connect, $res_id) != 1) {
            print "failure: username $username found more than once<br>\n";
            echo "bad";
        }

        else if (($entry_id = ldap_first_entry($connect, $res_id)) == false) {
            print "failur: entry of searchresult couln't be fetched<br>\n";
            echo "bad";
        }

        else if (($user_dn = ldap_get_dn($connect, $entry_id)) == false) {
            print "failure: user-dn coulnd't be fetched<br>\n";
            echo "bad";
        }

        else if (($link_id = ldap_bind($connect, $user_dn, $password)) == false) {
            print "failure: username, password didn't match: $user_dn<br>\n";
            echo "bad";
        }
        else {
            $_SESSION['user'] = $username;
            echo '<script type="text/javascript"> window.open("intranet.php","_self");</script>';  //  On Successful Login redirects to home.php
            //header("Location:intranet.php");
            exit;
            echo "good";

        }
    } else { // no conection to ldap server
        echo "no connection to '$ldap_server'<br>\n";
    }

}
?>

<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <title><?php echo "Intranet"; ?></title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mainStyles.css" type="text/css" rel="stylesheet">
    <link href="../menu/menuStyles.css" type="text/css" rel="stylesheet">
    <link href="loginStyles.css" type="text/css" rel="stylesheet"/>


    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="../menu/menuScripts.js"></script>

    <style media="all">
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
    </style>

</head>

<body>
<!--<div class="navbar navbar-default navbar-fixed-top" role="navigation" id="menuBar">-->
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
                <li class="active"><a href="/uamt/"><i class="fa fa-home fa-1x"></i></></a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $text->about; ?><b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/uamt/about/history/"><?php echo $text->about_history; ?></a></li>
                        <li><a href="/uamt/about/management/"><?php echo $text->about_management; ?></a></li>
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->about_department; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/uamt/about/OAMM/"><?php echo $text->about_department_OAMM; ?></a></li>
                                <li><a href="/uamt/about/OIKR/"><?php echo $text->about_department_OIKR; ?></a></li>
                                <li><a href="/uamt/about/OEMP/"><?php echo $text->about_department_OEMP; ?></a></li>
                                <li><a href="/uamt/about/OEAP/"><?php echo $text->about_department_OEAP; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="/uamt/employees/"><?php echo $text->staff; ?></a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $text->study; ?><b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->study_candidate; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/uamt/study/candidate/bc/"><?php echo $text->study_candidate_bc; ?></a></li>
                                <li><a href="/uamt/study/candidate/ing/"><?php echo $text->study_candidate_ing; ?></a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->study_bc; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/uamt/study/bc/info/"><?php echo $text->study_bc_info; ?></a></li>
                                <li><a href="/uamt/study/bc/thesis/"><?php echo $text->study_bc_thesis; ?></a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="dropdown-toggle"
                               data-toggle="dropdown"><?php echo $text->study_ing; ?><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/uamt/study/ing/info/"><?php echo $text->study_ing_info; ?></a></li>
                                <li><a href="/uamt/study/ing/thesis/"><?php echo $text->study_ing_thesis; ?></a></li>
                            </ul>
                        </li>
                        <li><a href="/uamt/study/phd/"><?php echo $text->study_phd; ?></a></li>
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
                <li><a href="/uamt/intranet/index.php" style="color:purple"><i class="fa fa-user fa-1x" style="color: purple!important;"></i> Intranet</a></li>
                <!--   <li><a href="#"><button type="button" class="button-menu btn btn-primary btn-sm">Primary</button></a></li>-->

            </ul>
        </div>
</nav>
<div id="nazov">
    <h2><?php echo "Intranet"; ?></h2>
    <hr class="hr_nazov">
</div>

<div id="container">
    <div class="wrapper">
        <form id="Login_Form" action="" method="POST" name="Login_Form" class="form-signin">
            <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon1">
                            <i class="fa fa-user"></i>
                        </span>
                <input type="text" class="form-control" name="Username" placeholder="Meno" required="" autofocus="" />
            </div>
            <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon1">
                            <i class="fa fa-lock"></i>
                        </span>
                <input type="password" class="form-control" name="Password" placeholder="Heslo" required=""/>
            </div>
            <button class="btn btn-lg btn-primary btn-block"  name="Login" value="Login" type="Submit">Prihlásiť sa</button>
        </form>
    </div>

    <div id="odpoved"></div>

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
                    echo "<a href='index.php?lang=sk' style='color: yellow' > Slovensky jazyk   | <a href='index.php?lang=en'>  English </a>";
                else
                    echo "<a href='index.php?lang=sk' > Slovensky jazyk   | <a href='index.php?lang=en'  style='    color: yellow'>  English </a>";

                ?>
            </div>

        </div>

    </div>
    </div>
</footer>
<script src="../menu/jQueryScripts.js"></script>
</body>
</html>
