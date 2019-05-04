<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include "Config.php";
$query="SELECT Booking.*,Car_Maker.CM_Name
FROM 
Booking,
Car_Maker
WHERE
Booking.car_brand=Car_Maker.CM_ID
ORDER BY confirm_status DESC";

$result = $con->query($query);

$response = array();
 while($row = $result->fetch_assoc()){
   $response[] = $row;
}
echo json_encode($response);
exit();
?>
