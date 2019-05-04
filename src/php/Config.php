<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

$host = "localhost"; /* Host name */
$user = "id3526940_lekdee"; /* User */
$password = "210249"; /* Password */
$dbname = "id3526940_areefeenbase"; /* Database name */

$con = new mysqli($host, $user, $password,$dbname);
mysqli_set_charset($con,"utf8");
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


?>