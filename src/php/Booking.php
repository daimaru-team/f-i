<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

//cus-----------------------------------------------------
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$LineID = $_POST['lineID'];
$tel = $_POST['tel'];
$Email = $_POST['Email']; //ใน UI ยังไม่มี txtfield รับค่า
$car_brand = $_POST['car_brand'];
$car_model = $_POST['car_model'];
$car_year = $_POST['car_year'];
$broken_desc = $_POST['broken_desc'];
$come_in_date = $_POST['come_in_date'];
$confirm_status = 0;

// $name = "jordan";
// $lastname = "handerson";
// $LineID = "hendo_eiei";
// $tel = "0981121112";
// $Email = "hendo@mail.com"; //ใน UI ยังไม่มี txtfield รับค่า
// $car_brand = "FORD";
// $car_model = "Ranger";
// $car_year = "2014";
// $broken_desc = "เกียร์พัง เครื่องอืดมากๆ";
// $come_in_date = "20190430";
// $confirm_status = 0;

//(NULL,'".$name."','".$lastname."' ,'".$LineID."','".$tel."','".$Email."','".$car_brand."','".$car_model."','".$car_year."','".$broken_desc."', CURRENT_DATE(),'".$come_in_date."',$confirm_status)


$query_CusTB="INSERT INTO `Booking`(`book_ID`, `name`, `last_name`, `lineID`, `tel`, `Email`, `car_brand`, `car_model`, `car_year`, `broken_desc`, `booking_create`, `come_in_date`, `confirm_status`, `Emp_ID`)
VALUES (NULL,'".$name."','".$lastname."' ,'".$LineID."','".$tel."','".$Email."','".$car_brand."','".$car_model."','".$car_year."','".$broken_desc."', CURRENT_DATE(),'".$come_in_date."',$confirm_status,NULL);";

$re_cus=$con->query($query_CusTB);

if($re_cus)
{
    echo $re_cus;
}    
else{
    echo "Error";
}

exit();
?>
