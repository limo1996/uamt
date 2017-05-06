<?php
/**
 * Created by PhpStorm.
 * User: limo
 * Date: 5/6/17
 * Time: 9:27 PM
 */
include("../database/database.php");
include ("diacritics.php");

$num = $_GET['id'];
$name = $_GET['name'];

$db = new Database();
$employee = array_values($db->getEmployee($num, $name))[0];

$ldapuid =  remove_accents($name);
$err = false;
//error_reporting(E_ERROR | E_PARSE);
$usrId = null;
$allRows = array();

if($ldapuid != null && $ldapuid != "") {
    $dn = 'ou=People, DC=stuba, DC=sk';
    $ldaprdn = "uid=$ldapuid, $dn";
    $ldapconn = ldap_connect("ldap.stuba.sk");
    $set = ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
    $sr = ldap_search($ldapconn, $ldaprdn, "uid=$ldapuid");
    $entry = ldap_first_entry($ldapconn, $sr);
    $usrId = ldap_get_values($ldapconn, $entry, "uisid")[0];
    if ($usrId == null || $usrId == "") {
        $err = true;
        die("Invalid AIS login");
    }


    $cur = 2016;
    $tmp = 1;
    $ch = curl_init('http://is.stuba.sk/lide/clovek.pl');
    // echo $ldapuid;
    // zostavenie dat pre POST dopyt - prepisal som to do in-line style
    $data = array('lang' => 'sk', 'zalozka' => '5', 'id' => $usrId, 'rok' => '1', 'order_by' => 'rok_uplatneni', 'zvolit_rok' => 'Zvoliť');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    // nastavenie curl-u pre ulozenie dat z odpovede do navratovej hodnoty z volania curl_exec
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    // vykonanie dopytu
    $result = curl_exec($ch);

    curl_close($ch);
    // parsovanie odpovede pre ziskanie pozadovanych dat
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($result);
    $xPath = new DOMXPath($doc);
    $tableRows = $xPath->query('//html/body/div/div/div/table[last()]/tbody/tr');

    foreach ($tableRows as $row) {
        $typ = $row->childNodes[2]->textContent;
        similar_text($typ, "Monografie, učebnice, skriptá, príručky, normy, patenty, výskumné správy, iné neperiodické publikácie", $percent1);
        similar_text($typ, "články v časopisoch", $percent2);
        similar_text($typ, "príspevky v zborníkoch, kapitoly v monografiách/učebniciach, abstrakty", $percent3);

        if(intval($percent1) > 95 || intval($percent2) > 90 || intval($percent3) > 95){
            array_push($allRows, $row);
        }
    }

    function cmp($aa, $bb){
        $a = $aa->childNodes[2]->textContent;
        $b = $bb->childNodes[2]->textContent;

        if ($a == $b){
            $n = intval($aa->childNodes[3]->textContent);
            if($aa->childNodes[3]->textContent == "" || $aa->childNodes[3]->textContent == null)
                return -1;
            $m = intval($bb->childNodes[3]->textContent);
            if($n == $m)
                return 0;

            return ($n < $m) ? 1 : -1;
        }

        similar_text($a, "Monografie, učebnice, skriptá, príručky, normy, patenty, výskumné správy, iné neperiodické publikácie", $percent);
        if (intval($percent) > 95)
            return -1;

        similar_text($b, "Monografie, učebnice, skriptá, príručky, normy, patenty, výskumné správy, iné neperiodické publikácie", $percent);
        if (intval($percent) > 95)
            return 1;

        similar_text($a, "príspevky v zborníkoch, kapitoly v monografiách/učebniciach, abstrakty", $percent);
        if (intval($percent) > 95)
            return 1;

        similar_text($b, "príspevky v zborníkoch, kapitoly v monografiách/učebniciach, abstrakty", $percent);
        if (intval($percent) > 95)
            return -1;
    }

    usort($allRows, "cmp");
}
?>

<!DOCTYPE>
<html>
<head>

</head>
<body>
<?php
$photo = $employee['PHOTO'];
if(!empty($photo))
    echo '<img src="photos/'.$photo.'" alt="'.$photo.'" />';
?>
<h1><?php echo $employee['DEPARTMENT']; ?></h1>
<h1><?php echo  $employee['STAFF_ROLE']; ?></h1>
<h1><?php echo  $employee['ROOM']; ?></h1>
<h1>+421 2 60291 <?php echo  $employee['PHONE']; ?></h1>
<table class="table table-striped table-bordered" id="mainTable">
    <tr>
        <td>Publikácie</td>
        <td>Druh výsledku</td>
        <td>Rok</td>
    </tr>
    <?php
    $currYear = intval(date("Y"));
    $drawed = false;
    foreach ($allRows as $row) {
        if(intval($row->childNodes[3]->textContent) <= $currYear - 5 && $drawed == false) {
            echo '</table><div class="text-center"><button type="button" class="btn btn-primary" id="showMore">Zobraz všetko</button></div><div id="faded"><table class="table table-striped table-bordered">';
            $drawed = true;
        }
        echo "<tr>";
        //echo "<p>Typ: ".$row->childNodes[1]->textContent."</p>";
        echo "<td>" . $row->childNodes[1]->textContent . "</td>";
        echo "<td>" . $row->childNodes[2]->textContent . "</td>";
        //echo "<p>Garantujúce pracovisko: ".$row->childNodes[4]->textContent."</p>";
        echo "<td>" . $row->childNodes[3]->textContent . "</td>";
        //echo "<p>Anotácia: ".$annotation."</p>";
        echo "</tr>";
    }

    if($drawed)
        echo '</table></div';
    else
        echo '</table>';
    ?>
</body>
</html>
