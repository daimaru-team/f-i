<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

$DeleteID=$_POST['DeleteID'];
// $DeleteID='1010222';
$checkCus=false;


    $query="DELETE FROM Customer WHERE Cus_ID ='$DeleteID' ";
    $result=$con->query($query);
    if($result){
        $query2="DELETE FROM Car WHERE Cus_ID ='$DeleteID' ";
        $query3="DELETE FROM WorkInProcess WHERE Cus_ID ='$DeleteID' ";
        $result2=$con->query($query2);
        $result3=$con->query($query3);

        echo "1";
    }    
    else{
        echo "0";
    }



?>