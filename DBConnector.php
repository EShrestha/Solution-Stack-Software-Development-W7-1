<?php

DEFINE ("DB_USER", "admin");
DEFINE ("DB_PWD", "testtest1");
DEFINE ("DB_SERVER", "localhost");
//DEFINE ("DB_SERVER", "10.0.0.28");
DEFINE ("DB_NAME", "myDB");
DEFINE ("DB_PORT", "3306");

// Returns a connection to the data base
function Get_DB_Connection(){
    $dbConnection = @mysqli_connect(DB_SERVER, DB_USER, DB_PWD, DB_NAME, DB_PORT)
    OR die('Failed to connect to MySQL ' . DB_SERVER . '::' . DB_NAME . ' : ' . mysqli_connect_error());
    return $dbConnection;
}

// Tries to prevent any SQL injection
function SANITIZE($q){
    return str_replace(";", "", $q);
}

function Get_All_Pages($dbConnection){
    $q = "SELECT * FROM Page";
    return @mysqli_query($dbConnection, $q);
}

function Get_All_Subpages($dbConnection){
    $q = "SELECT * FROM Sub_Pages";
    return @mysqli_query($dbConnection, $q);

}

function Get_User($dbConnection, $username, $password){
    $q = "SELECT * FROM Users WHERE username LIKE '{$username}' AND  pwd LIKE '{$password}'";
    return @mysqli_query($dbConnection, $q);

}

function Create_Page($dbConnection, $title, $body, $footer, $isVisible=1, $isSubPage="false", $belongsTo=1){
    if(strcmp($isSubPage, "false") == 0){
        $q = SANITIZE("INSERT INTO Page (title, body, footer, isVisible) VALUES ('{$title}', '{$body}', '{$footer}', {$isVisible})");
    }else{
        $q = SANITIZE("INSERT INTO Sub_Pages (belongsTo, title, body, footer, isVisible) VALUES ({$belongsTo}, '{$title}', '{$body}', '{$footer}', {$isVisible})");
    }
    return @mysqli_query($dbConnection, $q);
}

function Delete_Page($dbConnection, $pageID, $isSubPage){
    if($isSubPage){
        $q = "DELETE FROM Sub_Pages WHERE ID = {$pageID}";
    return @mysqli_query($dbConnection, $q);

    }else{
        $qA = "DELETE FROM Page WHERE ID = {$pageID};"; 
        $qB = "DELETE FROM Sub_Pages WHERE belongsTo = {$pageID};";
        
        $a = @mysqli_query($dbConnection, $qA);
        $b = @mysqli_query($dbConnection, $qB);
        return ($a && $b);

    }
}

function Get_Page($dbConnection, $pageID, $isSubPage){
    if ($isSubPage) {

        $q = "SELECT * FROM Sub_Pages WHERE ID = {$pageID}";

    } else {

        $q = "SELECT * FROM Page WHERE ID = {$pageID};";

       

    }
    return @mysqli_query($dbConnection, $q);

}

function Get_Style($dbConnection){
    $q = "SELECT * FROM Website";
    return @mysqli_query($dbConnection, $q);

}

function Update_Style($dbConnection, $styleName)
{
    $qA = "DELETE FROM Website;";
    $qB = "INSERT INTO Website (styleSheet) VALUES ('{$styleName}')";
    $a =  @mysqli_query($dbConnection, $qA);
    $b =  @mysqli_query($dbConnection, $qB);
    return ($a && $b);
}


?>









