<?php

require  __DIR__."/../../../database/database.php";

$data = json_decode($_POST['data'], true);

$db = new Database();

foreach ($data as $item) {
    try {
        $db->deleteEmployeeAbsence($item[0], $item[1]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

echo "Data deleted successfully!";