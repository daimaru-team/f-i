<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

include "Config.php";

$username = $_POST['username'];
$password = $_POST['password'];


  
$query="select * from users where User_Login='$username' and password='$password'";
$result = $con->query($query);

$response = array();
while($row = $result->fetch_assoc()) {
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
