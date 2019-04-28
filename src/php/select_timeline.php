<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
include "Config.php";




echo json_encode($response);

exit();

// $stmt = $con->prepare("select * from users");

// $stmt->bind_param("ss");

// $stmt->execute();

// $result = $stmt->get_result();

// $outp = $result->fetch_all(MYSQLI_ASSOC);

?>

