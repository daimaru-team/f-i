<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

include "Config.php";

// $Emp_Name = $_POST['Emp_Name'];
// $Emp_Lname = $_POST['Emp_Lname'];
// $Pos_ID = $_POST['Pos_ID'];
// $Nickname = $_POST['Nickname'];
// $Birthday = $_POST['Birthday'];
// // $Start_Date = $_POST['Start_Date'];   using function in phpmyadmin
// $Salary = $_POST['Salary'];
// $Emp_Type = $_POST['Emp_Type'];
// $Address = $_POST['Address'];
// $Phone_Num = $_POST['Phone_Num'];
// $Email = $_POST['Email'];
// $LineID = $_POST['LineID'];
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";


$Emp_Name = "testerzzzz";
$Emp_Lname = "daimaru";
$Pos_ID = "MAC";
$Nickname = "test";
$Birthday = "1995-05-23";

$Salary = 3000;
$Emp_Type = "FL";
$Address = "29 ถ.ผังเมือง5 อ.เมือง จ.ยะลา 95000";
$Phone_Num = "090999999";
$Email = "zzzz@mail.com";
$LineID = "zzzza";

$query="INSERT INTO Employee(Emp_ID, Emp_Name, Emp_Lname, Pos_ID, Nickname, Birthday, Start_Date, Salary,Emp_Type, Address, Phone_Num, Email, LineID) VALUES (NULL,'".$Emp_Name."','".$Emp_Lname."','".$Pos_ID."','".$Nickname."','".$Birthday."',CURRENT_DATE(),'$Salary','".$Emp_Type."','".$Address."','".$Phone_Num."','".$Email."','".$LineID."')";
$con->query($query);

echo $query;
exit();
?>
