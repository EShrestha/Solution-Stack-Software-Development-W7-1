<?php
// Run a Json query, parse and return the data
include_once "DBConnector.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');

$myDbConn = Get_DB_Connection();
$dbres = null;

if(isset($_POST["isSub"])){
    echo "A";
    $dbres = Delete_Page($myDbConn, $_POST["pageID"], True);
}else{
    echo "B";
    $dbres = Delete_Page($myDbConn, $_POST["pageID"], False);
}



if($dbres === TRUE){
    echo "Removed Successfully";
}else{
	echo "No response form DB";
}

?>
