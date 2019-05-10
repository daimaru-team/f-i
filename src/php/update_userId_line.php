<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";


$username=$_POST['username'];
$password=$_POST['password'];
$userId=$_POST['userId'];


$query="UPDATE `Customer` SET `Line_userId`='$userId' WHERE `Email`='$username' AND`Phone_Num`='$password'";

$bookingQuery=$con->query($query);

if($bookingQuery){
    echo "1";
}    
else{
    echo "0";
}
exit();
?>
