<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

$data=json_decode($_POST['data_insert'],true);

$Emp_PID=$data[0]['Emp_ID'];
$Emp_PID=$data[0]['Emp_PID'];
$Emp_Name=$data[0]['Emp_Name'];
$Emp_Lname=$data[0]['Emp_Lname'];
$Pos_ID=$data[0]['Pos_ID'];
$Nickname=$data[0]['Nickname'];
$Birthday=$data[0]['Birthday'];
$Start_Date=$data[0]['Start_Date'];
$Salary=$data[0]['Salary'];
$Emp_Type=$data[0]['Emp_Type'];
$Address=$data[0]['Address'];
$Phone_Num=$data[0]['Phone_Num'];
$Email=$data[0]['Email'];
$LineID=$data[0]['LineID'];
$speciality=$data[0]['speciality'];

$query="UPDATE `Employee` SET `Emp_PID`='$Emp_PID',`Emp_Name`='$',`Emp_Lname`='$',`Pos_ID`='$Pos_ID',`Nickname`='$Nickname',
`Birthday`='$Birthday',`Start_Date`='$Start_Date',`Salary`='$Salary',`Emp_Type`='$Emp_Type',`Address`='$Address',`Phone_Num`='$Phone_Num',`Email`='$Email',`LineID`='$LineID',
`speciality`='$speciality' WHERE  `Emp_ID`='$'Emp_ID";

$result=$con->query($query);

if($result){
    echo "1";
}    
else{
    echo "0";
}

?>