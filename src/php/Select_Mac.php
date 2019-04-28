<?php

error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include "Config.php";
$query="SELECT emp.Emp_ID,CONCAT(emp.Emp_Name,' ',emp.Emp_Lname) AS Mac_Name,emp.Emp_Name,emp.Emp_Lname,emp.Salary,emp.Birthday,emp.Nickname,IFNULL(emp.speciality,'ไม่มี') AS 'speciality',COUNT(wip.Emp_ID) AS Total_Work FROM Employee AS emp LEFT JOIN WorkInProcess AS wip ON wip.Emp_ID=emp.Emp_ID GROUP BY emp.Emp_ID HAVING COUNT(wip.Emp_ID)<2";

$result = $con->query($query);

$response = array();
 while($row = $result->fetch_assoc()){
   $response[] = $row;
}
echo json_encode($response);
exit();
// $stmt = $con->prepare("select * from users");
// $stmt->bind_param("ss");
// $stmt->execute();
// $result = $stmt->get_result();
// $outp = $result->fetch_all(MYSQLI_ASSOC);
?>
