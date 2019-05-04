<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";


$booking_id=$_POST['W_ID'];

$query="DELETE FROM `WorkInProcess` WHERE `W_ID`='$booking_id'";

$bookingQuery=$con->query($query);

if($bookingQuery){
    echo "1";
}    
else{
    echo "0";
}

exit();
?>
