<?php

session_start();

// Run a Json query, parse and return the data

include_once "DBConnector.php";

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Credentials: true');

$myDbConn = Get_DB_Connection();





$dbres = Update_Style($myDbConn, $_GET["styleName"]);

if($dbres){

    echo "Updated!";


}else{

    echo "Didn't work";

}

