<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";
$Cus_ID='PFR5350709';

$data=json_decode($_POST['data_insert'],true);

$Cus_ID=$data[0]['Cus_ID'];
$Cus_Fname=$data[0]['Cus_Fname'];
$Phone_Num=$data[0]['Phone_Num'];
$Address=$data[0]['Address'];
$Email=$data[0]['Email'];
$LineID=$data[0]['LineID'];
$Birthday=$data[0]['Birthday'];
$Create_date=$data[0]['Create_date'];

$query="UPDATE `Customer` SET `Cus_Fname`='$Cus_Fname',`Cus_Lname`='$Cus_Lname',`Phone_Num`='$Phone_Num',`Address`='$Address',`Email`='$Email',`LineID`='$LineID',
`Birthday`='$Birthday',`Create_date`='$Create_date' WHERE `Cus_ID`='$Cus_ID'";

$re_cus=$con->query($query);

if($re_cus){
    echo "1";
}    
else{
    echo "0";
}
exit();
?>
