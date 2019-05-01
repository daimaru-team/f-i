<?php

error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include "Config.php";
$query="SELECT DISTINCT CONCAT(emp.Emp_Name,' ',emp.Emp_Lname) AS Mac_Name,emp.Emp_ID,emp.Emp_PID,
        emp.Nickname,emp.Birthday,emp.Start_Date,emp.Salary,emp.Address,emp.Phone_Num,emp.Email,
        emp.LineID,IFNULL(emp.speciality,'ทั่วไป') AS 'Speciality',pos.Pos_Name,et.Type_Name
        FROM 
        Employee AS emp,
        Emp_Position AS pos,
        Employee_Type AS et
        WHERE
        emp.Pos_ID=pos.Pos_ID
        AND
        emp.Emp_Type=et.Emp_Type";

$result = $con->query($query);

<<<<<<< HEAD
=======


>>>>>>> 02e29ac2b153fab90fc349d108f981b458ab1e9f
$response = array();
 while($row = $result->fetch_assoc()){
   $response[] = $row;
}
<<<<<<< HEAD
=======



for($i=0;$i<count($response);$i++){
	$Emp_ID=$response[$i]['Emp_ID'];
	$query="SELECT * FROM `WorkInProcess` WHERE Emp_ID='".$Emp_ID."' ORDER BY Finish_Date ASC";
	$result = $con->query($query);
	$responseTimeline = array();
	while($row = $result->fetch_assoc())
		$responseTimeline[] = $row;

	if(count($responseTimeline)!=0){
		$response[$i]['WorkDesc']=$responseTimeline;
	}else{
		$response[$i]['WorkDesc']="null";
	} 



}

>>>>>>> 02e29ac2b153fab90fc349d108f981b458ab1e9f
echo json_encode($response);
exit();
// $stmt = $con->prepare("select * from users");
// $stmt->bind_param("ss");
// $stmt->execute();
// $result = $stmt->get_result();
// $outp = $result->fetch_all(MYSQLI_ASSOC);
?>
