<?php

error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include "Config.php";
$key=$_POST['key'];

$query="SELECT * FROM Customer WHERE Cus_ID='$key'";
$result = $con->query($query);

$response = array();
 while($row = $result->fetch_assoc()){
   $response[] = $row;
      
}

if(COUNT($response)>0){
    echo json_encode($response);
}else{
    echo "0";
}

exit();

?>