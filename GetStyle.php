<?php

session_start();

// Run a Json query, parse and return the data

include_once "DBConnector.php";

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Credentials: true');

$myDbConn = Get_DB_Connection();





$dbres = Get_Style($myDbConn);

if($dbres){

    $rows = mysqli_fetch_assoc($dbres);

    if (!$rows) {

        echo "Invalid Username or Password";

    } else {


        echo $rows["styleSheet"];

       

    }

}else{

    echo "Didn't work";

}







