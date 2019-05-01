<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";


$booking_id=$_POST['book_ID'];

$query="UPDATE `Booking` SET `confirm_status`='1' WHERE `book_ID`='$booking_id'";

$bookingQuery=$con->query($query);

if($bookingQuery){
    echo "1";
}    

else{
    echo "0";
}
exit();
?>
