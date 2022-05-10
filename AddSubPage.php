<?php

// Run a Json query, parse and return the data

include_once "DBConnector.php";



header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Credentials: true');



$myDbConn = Get_DB_Connection();

$dbres = Create_Page($myDbConn, $_POST["title"], $_POST["body"],$_POST["footer"],$_POST["isVisible"], "true", $_POST["belongsTo"] );





if($dbres === TRUE){

    echo "Added Successfully";

}else{

	echo "Error Adding";

}

