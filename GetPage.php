<?php



// Run a Json query, parse and return the data



include_once "DBConnector.php";







header('Access-Control-Allow-Origin: *');



header('Access-Control-Allow-Credentials: true');







$myDbConn = Get_DB_Connection();



$dbres = null;







if(isset($_GET["isSub"])){



    $dbres = Get_Page($myDbConn, $_GET["pageID"], True);



}else{



    $dbres = Get_Page($myDbConn, $_GET["pageID"], False);



}















if($dbres){



    $rows = mysqli_fetch_assoc($dbres);



    if (!$rows) {



        echo "No results";

    } else {



        do {



            // Getting information from the row

            $id = $rows['ID'];

            $belongsTo = $rows['belongsTo'];

   

            $isVisible = $rows['isVisible'];



            $title = $rows['title'];



            $body = $rows['body'];



            $footer = $rows['footer'];















            // Adding info to array



                $result['result'][] = array('ID' => $id, 'belongsTo' => $belongsTo, 'isVisible' => $isVisible, 'title' => $title, 'body' => $body, 'footer' => $footer);

            

        } while ($rows = mysqli_fetch_assoc($dbres));















        mysqli_close($myDbConn);





        // Converting to JSON and returning 


        echo json_encode($result);

    }









}else{



	echo "No response form DB";



}







?>



