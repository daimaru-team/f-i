<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

$DeleteID=$_POST['DeleteID'];
// $DeleteID='1010222';

$checkWIP="SELECT * FROM WorkInProcess WHERE Emp_ID='$DeleteID'";
$checked = $con->query($checkWIP);

$response = array();
 while($row = $checked->fetch_assoc()){
   $response[] = $row;
}
if(COUNT($response)==0){
    $query="DELETE FROM Employee WHERE $ColName ='$whereID' ";
    $result=$con->query($query);
    if($result){
        echo "1";
    }    
    else{
        echo "0";
    }
}else{
    // echo json_encode($response);
    echo "\r\n Failed Delete";
}



?>