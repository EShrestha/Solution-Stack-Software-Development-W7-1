<?php



// Run a Json query, parse and return the data



include_once "DBConnector.php";







header('Content-Type: application/json');



header('Access-Control-Allow-Origin: *');



header('Access-Control-Allow-Credentials: true');







$myDbConn = Get_DB_Connection();



$dbres = Get_All_Subpages($myDbConn); // Query















if ($dbres) {



    // Getting rows from the query



    $rows = mysqli_fetch_assoc($dbres);







    if (!$rows) {



        echo "No results";
    } else {







        do {



            // Getting information from the row



            $belongsTo = $rows['belongsTo'];

            $id = $rows['ID'];

            $isVisible = $rows['isVisible'];

            $title = $rows['title'];

            $body = $rows['body'];

            $footer = $rows['footer'];







            // Adding info to array



            $result['result'][] = array('belongsTo' => $belongsTo, 'ID' => $id, 'isVisible' => $isVisible, 'title' => $title, 'body' => $body, 'footer' => $footer);
        } while ($rows = mysqli_fetch_assoc($dbres));







        mysqli_close($myDbConn);







        // Converting to JSON and returning 



        echo json_encode($result);
    }
} else {



    echo "Error getting data.";
}

?>