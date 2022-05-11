<?php



DEFINE("DB_USER", "admin");

DEFINE("DB_PWD", "testtest1");

DEFINE("DB_SERVER", "localhost");

//DEFINE ("DB_SERVER", "10.0.0.28");

DEFINE("DB_NAME", "myDB");

DEFINE("DB_PORT", "3306");



// Returns a connection to the data base

function Get_DB_Connection()
{

    $dbConnection = @mysqli_connect(DB_SERVER, DB_USER, DB_PWD, DB_NAME, DB_PORT)

        or die('Failed to connect to MySQL ' . DB_SERVER . '::' . DB_NAME . ' : ' . mysqli_connect_error());

    return $dbConnection;
}



// Tries to prevent any SQL injection

function SANITIZE($q)
{

    return str_replace(";", "", $q);
}



function Get_All_Pages($dbConnection)
{

    $q = "SELECT * FROM Page";

    return @mysqli_query($dbConnection, $q);
}



function Get_All_Subpages($dbConnection)
{

    $q = "SELECT * FROM Sub_Pages";

    return @mysqli_query($dbConnection, $q);
}



function Get_User($dbConnection, $username, $password)
{


    $q = "SELECT * FROM Users WHERE username LIKE '{$username}' AND  pwd LIKE '{$password}'";

    return @mysqli_query($dbConnection, $q);
}



function Create_Page($dbConnection, $title, $body, $footer, $isVisible = 1, $isSubPage = "false", $belongsTo = 1)
{

    if (strcmp($isSubPage, "false") == 0) {

        $q = SANITIZE("INSERT INTO Page (title, body, footer, isVisible) VALUES ('{$title}', '{$body}', '{$footer}', {$isVisible})");

    } else {


        $q = SANITIZE("INSERT INTO Sub_Pages (belongsTo, title, body, footer, isVisible) VALUES ({$belongsTo}, '{$title}', '{$body}', '{$footer}', {$isVisible})");


    }

    return @mysqli_query($dbConnection, $q);
}



function Delete_Page($dbConnection, $pageID, $isSubPage)
{

    echo $isSubPage;

    if ($isSubPage) {

        $q = "DELETE FROM Sub_Pages WHERE ID = {$pageID}";

        return @mysqli_query($dbConnection, $q);
    } else {

        $qA = "DELETE FROM Page WHERE ID = {$pageID};";

        $qB = "DELETE FROM Sub_Pages WHERE belongsTo = {$pageID};";



        $a = @mysqli_query($dbConnection, $qA);

        $b = @mysqli_query($dbConnection, $qB);

        return ($a && $b);
    }
}



function Get_Page($dbConnection, $pageID, $isSubPage)
{

    if ($isSubPage) {




        $q = "SELECT * FROM Sub_Pages WHERE ID = {$pageID}";
    } else {


        $q = "SELECT * FROM Page WHERE ID = {$pageID};";
    }

    return @mysqli_query($dbConnection, $q);
}





?>



























































// // Getting records by city with optional parameters first name, last name, limit

// function Get_Records_With_Options($dbConnection, $pageID,$sessionInfo){







// // If any other parameter is set then add them tom the query

// $fName = isset($fName) ? " AND FirstName LIKE '{$fName}'" : "";

// $lName = isset($lName) ? " AND LastName LIKE '{$lName}'" : "";

// $limit = isset($limit) ? " LIMIT {$limit}" : "";



// $q = SANITIZE("SELECT * FROM People WHERE City LIKE '{$city}'{$fName}{$lName}{$limit}");

// return @mysqli_query($dbConnection, $q);

// }



// // Adding a person to the table with the provided parameters

// function Create_Record($dbConnection, $id, $fName, $lName, $address, $city){

// $q = SANITIZE("INSERT INTO People (PersonID, FirstName, LastName, Address, City) VALUES ({$id},'{$fName}','{$lName}','{$address}','{$city}')");

// return @mysqli_query($dbConnection, $q);

// }



// // Updating an existing records fields based on the provided field(s)

// function Update_Record($dbConnection, $id, $fName=null, $lName=null, $address=null, $city=null){



// $fName = isset($fName) ? " FirstName='{$fName}'," : "";

// $lName = isset($lName) ? " LastName='{$lName}'," : "";

// $address = isset($address) ? " Address='{$address}'," : "";

// $city= isset($city) ? " City='{$city}'," : "";



// $q = SANITIZE("UPDATE People SET {$fName}{$lName}{$address}{$city}PersonID={$id} WHERE PersonID = {$id}");

// return @mysqli_query($dbConnection, $q);

// }



// // Deletes a person from the database based on their ID

// function Delete_Record($dbConnection, $id){



// $q = SANITIZE("DELETE FROM People WHERE PersonID = {$id}");

// return @mysqli_query($dbConnection, $q);

// }

?>