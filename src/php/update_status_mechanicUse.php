<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

$W_ID=$_POST['W_ID'];
$Status='2';

$query="UPDATE `WorkInProcess` SET `Status`='$Status' WHERE `W_ID`='$W_ID'";
$result=$con->query($query);

if($result){
    echo "1";
}else{
    echo "0";
}

?>