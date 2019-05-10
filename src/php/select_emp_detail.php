<?php

error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include "Config.php";
$key=$_POST['key'];

$query="SELECT DISTINCT emp.Emp_Name,emp.Emp_Lname,CONCAT(emp.Emp_Name,' ',emp.Emp_Lname) AS Mac_Name,emp.Emp_ID,emp.Emp_PID,
        emp.Nickname,emp.Birthday,emp.Start_Date,emp.Salary,emp.Address,emp.Phone_Num,emp.Email,
        emp.LineID,IFNULL(emp.speciality,'ทั่วไป') AS 'Speciality',pos.Pos_Name,et.Type_Name
        FROM 
        Employee AS emp,
        Emp_Position AS pos,
        Employee_Type AS et
        WHERE
        emp.Pos_ID=pos.Pos_ID
        AND
        emp.Emp_Type=et.Emp_Type
        AND
        emp.Emp_ID='$key'";

$result = $con->query($query);

$response = array();
 while($row = $result->fetch_assoc()){
   $response[] = $row;
}

echo json_encode($response);
exit();

?>
