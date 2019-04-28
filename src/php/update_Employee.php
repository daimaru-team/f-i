<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";
$Cus_ID='PFR5350709';

$data=json_decode($_POST['data_insert'],true);

$Emp_ID=$data[0]['Emp_ID'];
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


$query="UPDATE `Employee` SET
`Emp_Name`='$Emp_Name',`Emp_Lname`='$Emp_Lname',`Pos_ID`='$Pos_ID',`Nickname`='$Nickname'
,`Birthday`='$Birthday',`Start_Date`='$Start_Date',`Salary`='$Salary',`Emp_Type`='$Emp_Type'
,`Address`='$Address',`Phone_Num`='$Phone_Num',`Email`='$Email',`LineID`='$LineID3w24' WHERE `Emp_ID`='$Emp_ID'";

$re_cus=$con->query($query);

if($re_cus){
    echo "1";
}    
else{
    echo "0";
}
exit();
?>
