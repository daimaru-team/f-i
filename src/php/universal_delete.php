

<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

$table=$_POST['TableName'];
$ColName=$_POST['ColumnName'];
$whereID=$_POST['DeleteID'];

$query="DELETE FROM $table WHERE $ColName ='$whereID' ";
$result=$con->query($query);

if($result){
    echo "1";
}    
else{
    echo "0";
}

?>