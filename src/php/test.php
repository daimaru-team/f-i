<?php

error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include "Config.php";

$Table = $_POST['Table'];
$someArray = json_decode($Table, true);
print_r($someArray);

echo $someArray[0]["EmployeeDetail"]["Emp_ID"];

?>
