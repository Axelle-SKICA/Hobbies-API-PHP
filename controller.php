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
                    level.name AS level,
                    JSON_OBJECTAGG(category.id, category.name) AS categories,
                    hobby.created_at,
                    hobby.updated_at
                FROM hobby
                    JOIN level ON hobby.level_id = level.id
                    JOIN hobby_has_category ON hobby.id = hobby_has_category.hobby_id
                    JOIN category ON hobby_has_category.category_id = category.id
                GROUP BY hobby.id;";

        //we store each row of the result in an array ($hobbies):
        $hobbies = array();
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $hobbies[] = $row;
        }
        
        //we send the data from the array as JSON:
        http_response_code(200);
        sendJSON($hobbies); 
        
        //close connection
        mysqli_close($conn);
    }


    // FUNCTION : get one hobby by id
    function getOneHobby($id){
        try {
            global $conn; 
    
            $query="SELECT
                    hobby.id,
                    hobby.name,
                    hobby.start_year,
                    hobby.level_id,
                    level.name AS level,
                    JSON_OBJECTAGG(category.id, category.name) AS categories,
                    hobby.created_at,
                    hobby.updated_at
                FROM hobby
                    JOIN level ON hobby.level_id = level.id
                    JOIN hobby_has_category ON hobby.id = hobby_has_category.hobby_id
                    JOIN category ON hobby_has_category.category_id = category.id
                GROUP BY hobby.id
                HAVING hobby.id=?;";
    
            //prepare the query :        
            $stmt = mysqli_prepare($conn, $query);
    
            //bind parameter (for the "?" IN QUERY):
            mysqli_stmt_bind_param($stmt, 'i', $id); // 'i' is for integer
    
            //execute query:
            mysqli_stmt_execute($stmt);
    
            //get result:
            $result = mysqli_stmt_get_result($stmt);
            
            $hobby=array();
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $hobby[] = $row;
            }
            
            //if there is no hobby in DB for this $id, we throw an exception:
            if(!$hobby){
                throw new ExceptionWithCode("There is no hobby with id '{$id}', try another id.", 404);
            } else {
                //we send the data from the array as JSON:
                http_response_code(200);
                sendJSON($hobby[0]); 
            }

            //close statement & connection:
            mysqli_stmt_close($stmt);
            mysqli_close($conn); 

        } catch (Exception $e){
            $error = [
                "message"=> $e->getMessage(),
                "code"=> $e->getCode()
            ];
            print_r($error);
        }
    }


    // FUNCTION : get all the hobbies by category
    function getHobbiesByCategory($catId){
        
    }

     
    // FUNCTION : get all the hobbies by level
    function getHobbiesByLevel($levId){
        
    }


    // FUNCTION : add one hobby
    function addHobby($name, $start_year, $level_id, $categoriesArray){
        try{

            global $conn; 
    
            // 1) first we add hobby to hobby table:
            $hobbyQuery="INSERT INTO hobby (name, start_year, level_id)
                VALUES (?,?,?);";
    
            //prepare the query :        
            $stmt = mysqli_prepare($conn, $hobbyQuery);
    
            //bind parameters (for the "?" IN QUERY):
            mysqli_stmt_bind_param($stmt, 'ssi', $name, $start_year, $level_id); // 'ssi' is for string/string/integer
            
            
            //array to store the good execution of queries
            $executed=array();
            
            if(mysqli_stmt_execute($stmt)){
                $executed[]=true;
            } else {
                $executed[]=false;
            }

            //get id of the added hobby:
            $addedId = mysqli_insert_id($conn);

            // 2) then we insert lines in the hobby_has_category table:
            for($i=0; $i<count($categoriesArray); $i++){
                $hobbyHasCatQuery="INSERT INTO hobby_has_category(hobby_id, category_id) VALUES (?,?)";
                //prepare the query :        
                $stmt2 = mysqli_prepare($conn, $hobbyHasCatQuery);
                //bind parameters (for the "?" IN QUERY):
                mysqli_stmt_bind_param($stmt2, 'ii', $addedId, $categoriesArray[$i]); // 'ii' is for integer/integer
                if(mysqli_stmt_execute($stmt2)){
                    $executed[]=true;
                } else {
                    $executed[]=false;
                }
            }
            
            $allInsertsOk;
            for($j=0; $j<count($executed); $j++){
                if($executed[$j]){
                    $allInsertsOk=true;
                } else {
                    return $allInsertsOk=false;
                }
            }

            if ($allInsertsOk){
                //get the added hobby from DB:
                global $conn; 
                $query="SELECT
                        hobby.id,
                        hobby.name,
                        hobby.start_year,
                        hobby.level_id,
                        level.name AS level,
                        JSON_OBJECTAGG(category.id, category.name) AS categories,
                        hobby.created_at,
                        hobby.updated_at
                    FROM hobby
                        JOIN level ON hobby.level_id = level.id
                        JOIN hobby_has_category ON hobby.id = hobby_has_category.hobby_id
                        JOIN category ON hobby_has_category.category_id = category.id
                    GROUP BY hobby.id
                    HAVING hobby.id=?;";
                //prepare the query :        
                $stmt = mysqli_prepare($conn, $query);
                //bind parameter (for the "?" IN QUERY):
                mysqli_stmt_bind_param($stmt, 'i', $addedId); // 'i' is for integer
                //execute query:
                mysqli_stmt_execute($stmt);
                //get result:
                $result = mysqli_stmt_get_result($stmt);
                $addedHobby=array();
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $addedHobby[] = $row;
                }
                //send data as JSON:
                http_response_code(201);
                sendJSON($addedHobby[0]); 
            } else {
                throw new ExceptionWithCode('Internal server error',500);
            }

        } catch (Exception $e) {
            $error = [
                "message"=> $e->getMessage(),
                "code"=> $e->getCode()
            ];
            print_r($error);
        }
    }

    //FUNCTION : get list of all the categories:
    function getAllCategories(){
        global $conn; //we use global variable $conn (connection to DB) from db_connect.php

        //the SQL query to get all categories :
        $query="SELECT * FROM category ORDER BY category.id;";

        //we store each row of the result in an array ($categories):
        $categories = array();
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $categories[] = $row;
        }
        
        //we send the data from the array as JSON:
        http_response_code(200);
        sendJSON($categories); 
        
        //close connection
        mysqli_close($conn);
    }


    // FUNCTION : get one categoryy by id
    function getOneCategory($id){
        try {
            global $conn; 
    
            $query="SELECT * FROM category WHERE category.id=?;";
    
            //prepare the query :        
            $stmt = mysqli_prepare($conn, $query);
    
            //bind parameter (for the "?" IN QUERY):
            mysqli_stmt_bind_param($stmt, 'i', $id); // 'i' is for integer
    
            //execute query:
            mysqli_stmt_execute($stmt);
    
            //get result:
            $result = mysqli_stmt_get_result($stmt);
            
            $category=array();
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $category[] = $row;
            }
            
            //if there is no category in DB for this $id, we throw an exception:
            if(!$category){
                throw new ExceptionWithCode("There is no category with id '{$id}', try another id.", 404);
            } else {
                //we send the data from the array as JSON:
                http_response_code(200);
                sendJSON($category[0]); 
            }

            //close statement & connection:
            mysqli_stmt_close($stmt);
            mysqli_close($conn); 
    
            } catch (Exception $e){
                $error = [
                    "message"=> $e->getMessage(),
                    "code"=> $e->getCode()
                ];
                print_r($error);
            }
    }


     //FUNCTION : get list of all the levels:
     function getAllLevels(){
        global $conn; //we use global variable $conn (connection to DB) from db_connect.php

        //the SQL query to get all levels :
        $query="SELECT * FROM level ORDER BY level.id;";

        //we store each row of the result in an array ($levels):
        $levels = array();
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $levels[] = $row;
        }
        
        //we send the data from the array as JSON:
        http_response_code(200);
        sendJSON($levels); 
        
        //close connection
        mysqli_close($conn);
    }


    // FUNCTION : get one level by id
    function getOneLevel($id){
        try {
            global $conn; 
    
            $query="SELECT * FROM level WHERE level.id=?;";
    
            //prepare the query :        
            $stmt = mysqli_prepare($conn, $query);
    
            //bind parameter (for the "?" IN QUERY):
            mysqli_stmt_bind_param($stmt, 'i', $id); // 'i' is for integer
    
            //execute query:
            mysqli_stmt_execute($stmt);
    
            //get result:
            $result = mysqli_stmt_get_result($stmt);
            
            $level=array();
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $level[] = $row;
            }
            
            //if there is no level in DB for this $id, we throw an exception:
            if(!$level){
                throw new ExceptionWithCode("There is no level with id '{$id}', try another id.", 404);
            } else {
                //we send the data from the array as JSON:
                http_response_code(200);
                sendJSON($level[0]); 
            }

            //close statement & connection:
            mysqli_stmt_close($stmt);
            mysqli_close($conn); 
    
            } catch (Exception $e){
                $error = [
                    "message"=> $e->getMessage(),
                    "code"=> $e->getCode()
                ];
                print_r($error);
            }
    }


    //FUNCTION TO SEND JSON:
    function sendJSON($data){
        header("Access-Control-Allow-Origin: *"); //CORS
        header("Content-Type: application/json");
        echo json_encode($data, JSON_PRETTY_PRINT); //JSON_PRETTY_PRINT: to see more clearly on screen
        //or JSON_UNESCAPED_UNICODE to handle accents etc
    }

?>
