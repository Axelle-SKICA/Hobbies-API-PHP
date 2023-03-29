<?php
    //import controller :
    require_once("./controller.php");
   
    //routes :
    // /hobbies => /GET_routes.php?req=hobbies
    // /hobbies/:id
    // /categories
    // /categories/:id
    // /categories/:id/hobbies
    // /levels
    // /levels/:id
    // /levels/:id/hobbies

    try{
        $request_method = $_SERVER["REQUEST_METHOD"];
        
        // GET METHOD:
        if($request_method==='GET') {
            if(isset($_GET['req']) && !empty($_GET['req'])){ //if a request is received with method GET

                //break apart info from the request URL. Each element after a '/' is stored in the $url array:
                $url=explode("/", filter_var($_GET['req'], FILTER_SANITIZE_URL));
        
                // then switch on the first bit of the url ($url[0])
                switch($url[0]){
                    case "hobbies":
                        if(empty($url[1])){ //if there is nothing after "/hobbies"
                            getAllHobbies();
                        } else {
                            //here $url[1] is the hobby id we get from the exploded url:
                            getOneHobby($url[1]);
                        }
                        break;
                    case "categories":
                        echo "Categories GET";
                        break;
                    case "levels":
                        echo "Levels GET";
                        break;
                    default:
                        throw new ExceptionWithCode("Not found", 404);
                }
            } else {
                throw new Exception('Problem of data recollection');
            }
        }

        //POST METHOD :
        elseif($request_method==='POST'){
            // echo "POST !"."\n";

            //break apart the request URL. Each element after a '/' is stored in the $url array:
            $url=explode("/", filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL)); 
            // print_r($url);

            // then switch on the first bit of the route ($url[1])
            switch($url[1]){
                case "hobbies":
                    addHobby('Dance in the car like nobody is watching', '1995', 4, [10]);
                    break;
                case "categories":
                    echo "Add one category";
                    break;
                case "levels":
                    echo "Add one level";
                    break;
                default:
                    throw new ExceptionWithCode("Not found", 404);
            }          
        }

    } catch (Exception $e){
        $error = [
            "message"=> $e->getMessage(),
            "code"=> $e->getCode()
        ];
        print_r($error);
    }

    class ExceptionWithCode extends Exception {
        public $code=0;
        public function __construct($message, $code){
            parent::__construct($message);
            $this->code=$code;
        }
    }

?>  