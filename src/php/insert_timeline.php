<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";
$Cus_ID='PFR5350709';

$data=json_decode($_POST['data_insert'],true);
$Report_ID=GenerateReport_ID($con);
$W_ID=$data[0]['Iw_ID'];
$Report_Name=$data[0]['Report_Name'];
$Description=$data[0]['Description'];
$Pic_total=$data[0]['Pic_total'];
$DateTime_Created=$data[0]['DateTime_Created'];
$Emp_ID_Posted=$data[0]['Emp_ID_Posted'];

$query="INSERT INTO Timeline_Report (Report_ID, W_ID, Report_Name, Description, Pic_total, DateTime_Created, Emp_ID_Posted)
VALUES ('".$Report_ID."','".$W_ID."','".$Report_Name."','".$Description."','".$Pic_total."','".$DateTime_Created."','".$Emp_ID_Posted."')";

$re_cus=$con->query($query);


if($re_cus){
    echo "1";
}    
else{
    echo $query;
}

function GenerateReport_ID($con){
    $query="SELECT COUNT(*) AS TOTAL FROM `Timeline_Report`";
    $result = $con->query($query);

    $response = array();
     while($row = $result->fetch_assoc())
       $response[] = $row;

    $calID=1+(int)$response[0]['TOTAL'];
    $genID="REP";
    $loopgen=7-strlen((string)$calID);

    for($i=0;$i<$loopgen;$i++)
        $genID.="0";

    $genID.=(string)$calID;
    return $genID;
}


exit();
?>
