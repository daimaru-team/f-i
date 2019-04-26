<?php

error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include "Config.php";

$query="SELECT `WIP`.*,CONCAT(`Cus`.`Cus_Fname`,' ',`Cus`.`Cus_Lname`) AS 'cus_name', `CM`.`CM_Name`,`Car`.`Model`,`Car`.`License_plate`,CONCAT(`Emp`.`Emp_Name`,' ',`Emp`.`Emp_Lname`) AS 'emp_name'
FROM `WorkInProcess` AS `WIP`
	, `Customer` AS `Cus`
    , `Car`
	, `Car_Maker` AS `CM`
	, `Employee` AS `Emp`
WHERE `Car`.`Car_ID` = `WIP`.`Car_ID` AND `Cus`.`Cus_ID` = `WIP`.`Cus_ID` AND `CM`.`CM_ID` = `Car`.`Brand` AND `Emp`.`Emp_ID` = `WIP`.`Emp_ID`;";
echo $query;
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
