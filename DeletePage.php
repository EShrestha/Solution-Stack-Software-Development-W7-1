<?php
// Run a Json query, parse and return the data
include_once "DatabaseConnector.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');

$myDbConn = Get_DB_Connection();
$dbres = null;

if(!isset($_POST["pageID"])){
    $dbres = Delete_Page($myDbConn, $_POST["pageID"]);
}else{
    $dbres = Delete_Page($myDbConn, $_POST["pageID"], true);
}



if($dbres === TRUE){
    echo "Removed Successfully";
}else{
	echo "No response form DB";
}

?>