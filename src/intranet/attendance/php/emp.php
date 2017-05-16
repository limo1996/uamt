<?php
require  __DIR__."/../../../database/database.php";

$db = new Database();
$employees = $db->fetchAisEmployees();

echo json_encode($employees);
