<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

$data=json_decode($_POST['data_insert'],true);

$W_ID=$data[0]['W_ID'];
$Car_ID=$data[0]['Car_ID'];
$Cus_ID=$data[0]['Cus_ID'];
$W_Desc=$data[0]['W_Desc'];
$Emp_ID=$data[0]['Emp_ID'];
$Status=$data[0]['Status'];
$Start_Date=$data[0]['Start_Date'];
$Finish_Date=$data[0]['Finish_Date'];
$Remark=$data[0]['Remark'];

$query="UPDATE `WorkInProcess` SET `Car_ID`='$Car_ID',`Cus_ID`='$Cus_ID',`W_Desc`='$W_Desc',`Emp_ID`='$Emp_ID',
`Status`='$Status',`Start_Date`='$Start_Date',`Finish_Date`='$Finish_Date',`Remark`='$Remark', WHERE `W_ID`='$W_ID'";

$result=$con->query($query);

if($result){
    echo "1";
}    
else{
    echo "0";
}

?>