<?php
session_start();
// Run a Json query, parse and return the data
include_once "DBConnector.php";
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
$myDbConn = Get_DB_Connection();



$dbres = Get_User($myDbConn, $_GET["username"],$_GET["password"]);
if($dbres){
    $rows = mysqli_fetch_assoc($dbres);
    if (!$rows) {
        echo "invalid";
    } else {

        $_SESSION["isAdmin"] = $rows["isAdmin"];
        $_SESSION["username"] = $rows["username"];
        $_SESSION["password"] = $rows["pwd"];
        echo "valid";
    }
}else{
    echo "invalid";
}
exit();


?>
