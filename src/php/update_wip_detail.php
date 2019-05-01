<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

$data=json_decode($_POST['data_insert'],true);

$W_ID=$data[0]['W_ID'];
$Finish_Date=$data[0]['Finish_Date'];


$query="UPDATE `WorkInProcess` SET `Finish_Date`='$Finish_Date' WHERE `W_ID`='$W_ID'";

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