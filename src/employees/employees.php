<?php
include("../database/database.php");
$db = new Database();

$employees = $db->fetchEmployees();
?>
<!DOCTYPE>
<html>
<head>
    <link href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>
<div class="container">
    <table class="table table-stripped table-bordered">
        <tr>
            <th>Meno</th>
            <th>Miestnosť</th>
            <th>Klapka</th>
            <th>Oddelenie</th>
            <th>Zaradenie</th>
            <th>Funkcia</th>
            <td>Detail</td>
        </tr>

        <?php
        foreach ($employees as $employee) {
            echo "<tr>";
            $delimiter = "";
            if (!empty($employee['TITLE2']))
                $delimiter = ",";
            echo "<td>" . $employee['TITLE1'] . " " . $employee['FIRST_NAME'] . " " . $employee['SECOND_NAME'] . $delimiter . " " . $employee['TITLE2'] . "</td>";
            echo "<td>" . $employee['ROOM'] . "</td>";
            echo "<td>" . $employee['PHONE'] . "</td>";
            echo "<td>" . $employee['DEPARTMENT'] . "</td>";
            echo "<td>" . $employee['STAFF_ROLE'] . "</td>";
            echo "<td>" . str_replace(";", "<br>", $employee['FUNCTION']) . "</td>";
            echo "<td><a href='employeeDetail.php?id=" . $employee['PHONE'] . "'><img src='icon_more.png' width='35px' alt='more' /></a></td>";
            echo "</tr>";
            //var_dump($employee);
            //echo "<br>";
        }
        ?>
    </table>
</div>
</html>
