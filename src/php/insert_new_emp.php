<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');

header('Content-type: application/json charset=utf-8');

include "Config.php";


$data=json_decode($_POST['data_insert'],true);

$Emp_ID=GenEmpID($con);
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
$Password=$data[0]['password'];

// $Emp_ID="10102";
// $Emp_PID="3333333333333";
// $Emp_Name="phonpisud";
// $Emp_Lname="sumagsa";
// $Pos_ID="CEO";
// $Nickname="ingzi";
// $Birthday="20120101";
// $Start_Date="2019-03-31";
// $Salary="30000";
// $Emp_Type="FT";
// $Address="3242wl;s ds;lkfds;lkdf s;lsdkfdlks12321dsa asdzxcxzxzcczc";
// $Phone_Num="0999999999";
// $Email="ing@mail.com";
// $LineID="ingza555";
// $speciality="ไม่มี";
// $Password="1234";

if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    $query_CusTB="INSERT INTO `Employee`(`Emp_ID`, `Emp_PID`, `Emp_Name`, `Emp_Lname`, `Pos_ID`, `Nickname`, `Birthday`, `Start_Date`, 
    `Salary`, `Emp_Type`, `Address`, `Phone_Num`, `Email`, `LineID`, `speciality`) 
    VALUES ('".$Emp_ID."','".$Emp_PID."','".$Emp_Name."','".$Emp_Lname."','".$Pos_ID."','".$Nickname."','".$Birthday."','".$Start_Date."'
    ,'".$Salary."','".$Emp_Type."','".$Address."','".$Phone_Num."','".$Email."','".$LineID."','".$speciality."')";
    
    $re_cus=$con->query($query_CusTB);

    if($re_cus)
    {
        $queryUser="INSERT INTO `users`(`id`, `User_Login`, `password`, `Owner_ID`, `User_Type`) 
        VALUES (null,'".$Emp_ID."','".$Password."','".$Emp_ID."','Employee')";
        $re_user=$con->query($queryUser);
        if($re_user){
            echo "1";
        }else{
            echo "0";
        }
        echo "\r\n Success query_CusTB \r\n".$re_cus."\r\n";
    }    
    else{
        echo "0";
         echo "\r\n Error Customer".$re_cus."\r\n";
    }



function GenEmpID($con){
    $query="SELECT Emp_ID FROM Employee ORDER BY Emp_ID DESC LIMIT 1";
    $result = $con->query($query);

    $response = array();
     while($row = $result->fetch_assoc())
       $response[] = $row;

    $calID=1+(int)$response[0]['Emp_ID'];
    return $calID;
}


exit();
?>