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
<<<<<<< HEAD

=======
>>>>>>> 02e29ac2b153fab90fc349d108f981b458ab1e9f
else{
    echo "0";
}
exit();
?>
