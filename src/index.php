<?php
include ('lang/langFunctions.php');
$lan = new Text('sk');
var_dump($lan->getTextForPage('projects'));

$lan = new Text('en');
var_dump($lan->getTextForPage('projects'));