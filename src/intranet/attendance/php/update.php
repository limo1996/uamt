<?php
require  __DIR__."/../../../database/database.php";
$data = json_decode($_POST['data'], true);

echo $data;
