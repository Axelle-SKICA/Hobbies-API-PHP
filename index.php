<?php
    //connect do DB
    include("db_connect.php");
   
    //routes :
    // /hobbies => /hobbies.php?req=hobbies
    // /hobbies/:id
    // /categories
    // /categories/:id
    // /categories/:id/hobbies
    // /levels
    // /levels/:id
    // /levels/:id/hobbies

    try{
        if(!empty($_GET['req'])){ //if a request is received

            //break apart info from the request URL. Each element after a '/' is stored in the $url array:
            $url=explode("/", filter_var($_GET['req'], FILTER_SANITIZE_URL));

            // then switch on the first bit of the url ($url[0])
            switch($url[0]){
                case "hobbies":
                    echo "Hobbies";
                    break;
                case "categories":
                    echo "Categories";
                    break;
                case "levels":
                    echo "Levels";
                    break;
                default:
                    throw new Exception ('URL unknown');
            }
        } else {
            throw new Exception('Problem of data recollection');
        }

    } catch (Exception $e){
        $error = [
            "message"=> $e->getMessage(),
            "code"=> $e->getCode()
        ];
        print_r($error);
    }

?>  