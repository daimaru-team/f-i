<?php

error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include "Config.php";
$key=$_POST['key'];

$query="SELECT Cus_ID,CONCAT(Cus_Fname,' ',Cus_Lname)AS CusFullName,Phone_Num,Address,Email,
        IFNULL(Line_userId,'ไม่ได้ทำการเชื่อมต่อ') AS 'Line_userId',Birthday,Create_date 
        FROM `Customer` WHERE Cus_ID='$key'";

$result = $con->query($query);

$response = array();
 while($row = $result->fetch_assoc()){
   $response[] = $row;
}

echo json_encode($response);
exit();
?>
