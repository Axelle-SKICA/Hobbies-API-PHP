<?php
    //connect do DB
    include("db_connect.php");

    //FUNCTION : get list of all the hobbies:
    function getAllHobbies(){
        global $conn; //we use global variable $conn (connection to DB) from db_connect.php

        //the SQL query to get all hobbies with name of the level:
        $query="SELECT
            hobby.id,
            hobby.name,
            hobby.start_year,
            hobby.level_id,
            level.name level
            FROM hobby
            JOIN level
            ON hobby.level_id = level.id
            ORDER BY hobby.id;";

        //we store each row of the result in an array ($hobbies):
        $hobbies = array();
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $hobbies[] = $row;
        }
        
        //we send the data from the array as JSON:
        sendJSON($hobbies); 
        
        //close connection
        mysqli_close($conn);
    }


    // FUNCTION : get one hobby by id
    function getOneHobby($id){
        global $conn; 

        $query="SELECT
            hobby.id,
            hobby.name,
            hobby.start_year,
            hobby.level_id,
            level.name level
            FROM hobby
            JOIN level
            ON hobby.level_id = level.id
            WHERE hobby.id=?;";

        //prepare the query :        
        $stmt = mysqli_prepare($conn, $query);

        //bind parameter (for the "?" IN QUERY):
        mysqli_stmt_bind_param($stmt, 'i', $id); // 'i' is for integer

        //execute query:
        mysqli_stmt_execute($stmt);

        // //bind result:
        // mysqli_stmt_bind_result($stmt, $id);

        //get result:
        $result = mysqli_stmt_get_result($stmt);

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $hobby[] = $row;
        }
        
        //we send the data from the array as JSON:
        sendJSON($hobby); 

        //close statement & connection:
        mysqli_stmt_close($stmt);
        mysqli_close($conn); 
    }


    // FUNCTION : get all the hobbies by category
    function getHobbiesByCategory($catId){
        
    }

     
    // FUNCTION : get all the hobbies by level
    function getHobbiesByLevel($levId){
        
}


    //FUNCTION TO SEND JSON:
    function sendJSON($data){
        header("Access-Control-Allow-Origin: *"); //CORS
        header("Content-Type: application/json");
        echo json_encode($data, JSON_PRETTY_PRINT); //JSON_PRETTY_PRINT: to see more clearly on screen
    }

?>
