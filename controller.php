<?php
    //connect do DB
    include("db_connect.php");

    //get list of all the hobbies:
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
            ON hobby.level_id = level.id;";

        $response = array();

        //we store each row of the result in the $response array:
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)){
            $response[] = $row;
        }

        //we send the data from the array as JSON:
        header('Content-Type: application/json');
        echo json_encode($response, JSON_PRETTY_PRINT); //JSON_PRETTY_PRINT: to see more clearly on screen
    }

    //get one hobby by id
    function getOneHobby($id){
        echo "This is hobby n° {$id}";
    }

    //get all the hobbies by category
    function getHobbiesByCategory($catId){
        
    }

    //get all the hobbies by level
    function getHobbiesByLevel($levId){
        
}

?>
