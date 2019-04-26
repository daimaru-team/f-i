<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
include "Config.php";

$datenow=$_POST['date'];
$Emp_ID=$_POST['Emp_ID'];
$query="SELECT W_ID,DATEDIFF(Finish_Date, '$datenow') AS 'day_left' FROM WorkInProcess WHERE Emp_ID='$Emp_ID'";
// echo $query."/r/n/r/n/r/n/r/n";
mysqli_set_charset($con,"utf8");
$result = $con->query($query);

$response = array();

 while($row = $result->fetch_assoc()){
   $response[] = $row;
}
echo json_encode($response);

exit();
?>

