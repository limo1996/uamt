<?php

require  __DIR__."/../../../database/database.php";
/**
 * Created by PhpStorm.
 * User: limo
 * Date: 3/5/17
 * Time: 6:30 PM
 */

$month = $_POST['month'];
$year = $_POST['year'];

$db = new Database();

$tmpEmployees = $db->fetchAisEmployees();

$employees = array();
$employeesIds = array();
foreach ($tmpEmployees as $emp){
    array_push($employees, $emp->getName());
    array_push($employeesIds, $emp->getAIS_ID());
}

$return = array();
foreach ($tmpEmployees as $item){
    $fetched = array();
    for($i = 0; $i < 31; $i++){
        $fetched[$i] = null;
    }
    $tmp = $db->fetchEmployeeAbsenceWhere($month, $year, $item->getAIS_ID());
    //print json_encode($month.$year.$item->getId());
    foreach ($tmp as $t) {
        $fetched[intval(date("d", strtotime($t->getDate()))) - 1] = $t->getIdAbsence();
    }
    $return[$item->getName()] = $fetched;
}

$ret = array($employees, $return, $employeesIds);

print json_encode($ret);
die();