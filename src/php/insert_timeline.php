<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";
$Cus_ID='PFR5350709';

$data=json_decode($_POST['data_insert'],true);
// $Cus_Name = $_POST['Cus_Name'];
// $Cus_Lname = $_POST['Cus_Lname'];
// $Address = $_POST['Address'];
// $Email = $_POST['Email'];
// $LineID = $_POST['LineID'];
// $Cus_Tel=$_POST['Tel'];
// $Birthday = $_POST['Birthday'];

$W_ID=$data[0]['Iw_ID'];
$Report_Name=$data[0]['Report_Name'];
$Description=$data[0]['Description'];
$Pic_total=$data[0]['Pic_total'];
$DateTime_Created=$data[0]['DateTime_Created'];
$Emp_ID_Posted=$data[0]['Emp_ID_Posted'];

$query="INSERT INTO `Timeline_Report`(`Report_ID`, `W_ID`, `Report_Name`, `Description`, `Pic_total`, `DateTime_Created`, `Emp_ID_Posted`) 
VALUES (null,'".$W_ID."','".$Report_Name."','".$Description."','".$Pic_total."','".$DateTime_Created."','".$Emp_ID_Posted."')";

$re_cus=$con->query($query);


if($re_cus){
    echo "1";
}    
else{
    echo "0";
}
exit();
?>
