<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";
$Cus_ID='PFR5350709';


$data=json_decode($_POST['data_insert'],true);
// $W_ID="WID0000101";
$W_ID=$data[0]['W_ID'];
$img_name=$data[0]['img_name'];
$img_data=$data[0]['img_data'];
$Upload_DateTime=$data[0]['Upload_DateTime'];

$selectQuery="SELECT Report_ID,DateTime_Created FROM `Timeline_Report` WHERE W_ID='$W_ID' ORDER BY DateTime_Created DESC LIMIT 1";
$SelectResult = $con->query($selectQuery);
echo $selectQuery."\r\n";
$response = array();
 while($row = $SelectResult->fetch_assoc()){
   $response[] = $row;
}

$Report_ID=$response[0]['Report_ID'];

$query="INSERT INTO `Timeline_image`(`img_ID`, `W_ID`, `Report_ID`, `img_name`, `img_data`, `Upload_DateTime`) 
VALUES (null,'".$W_ID."','".$Report_ID."','".$img_name."','".$img_data."','".$Upload_DateTime."')";

$re_cus=$con->query($query);
echo $query;

if($re_cus){
    echo "1";
}    
else{
    echo "0";
}
exit();
?>
