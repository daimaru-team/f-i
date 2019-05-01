<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

$booking_id=$_POST['book_id'];
$date=$_POST['date'];

$query="UPDATE `Booking` SET `come_in_date`='$date' WHERE `book_ID`='$booking_id'";
<<<<<<< HEAD
$bookingQuery=$con->query($query);
=======

$bookingQuery=$con->query($query);

>>>>>>> 02e29ac2b153fab90fc349d108f981b458ab1e9f
if($bookingQuery){
    echo "1";
}    
else{
    echo "0";
}
exit();
?>
