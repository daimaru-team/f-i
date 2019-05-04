<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

$W_ID=$_POST['W_ID'];
$Finish_Date=$_POST['date'];


echo "\r\n".$W_ID."\r\n";
$query="UPDATE `WorkInProcess` SET `Finish_Date`='$Finish_Date' WHERE `W_ID`='$W_ID'";
echo "\r\n".$query."\r\n";
$result=$con->query($query);

if($result){
    $queryf="SELECT * FROM `WorkInProcess` WHERE `W_ID`='$W_ID' ";
    echo $queryf."\r\n";
    $resultf=$con->query($queryf);
    $carCheck = array();

 while($row = $resultf->fetch_assoc())
   $carCheck[] = $row;

    if(COUNT($carCheck)!=0){
        echo "1";
    }else{
        echo "0";
    } 
    
}    
else{
    echo "0";
}

?>