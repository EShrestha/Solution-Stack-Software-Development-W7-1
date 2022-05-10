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

        echo "Invalid Username or Password";

    } else {

        echo "Here";

        $_SESSION["isAdmin"] = $rows["isAdmin"];

        $_SESSION["username"] = $rows["username"];

        $_SESSION["pwd"] = $rows["password"];

    }

}else{

    echo "Didn't work";

}



print_r($_SESSION);







echo $_SESSION["username"] . $_SESSION["pwd"] . $_SESSION["isAdmin"];



?>

