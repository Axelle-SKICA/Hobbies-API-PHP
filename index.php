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
                        if(empty($url[1])){ //if there is nothing after "/categories"
                            getAllCategories();
                        } else {
                            //here $url[1] is the category id we get from the exploded url:
                            getOneCategory($url[1]);
                        }
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
            //break apart the request URL. Each element after a '/' is stored in the $url array:
            $url=explode("/", filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL)); 
            // print_r($url);
            // echo "\n";

            // then switch on the first bit of the route ($url[1])
            switch($url[1]){
                case "hobbies":
                    // Get the JSON contents of the body
                    $body = file_get_contents('php://input');

                    // decode the json data
                    $data = json_decode($body);

                    // print_r($data);

                    if(!empty($data->name)
                    && !empty($data->start_year)
                    && !empty($data->level_id)
                    && !empty(($data->categories)[0])){
                        //we get the data from the body of the request:
                        $name=$data->name;
                        $start_year=$data->start_year;
                        $level_id=$data->level_id;
                        $categories=array();
                        for($i=0; $i<count($data->categories); $i++){
                            $categories[]=($data->categories)[$i];
                        }
                        //we call the addHobby function passing this data:
                        addHobby($name, $start_year, $level_id, $categories);
                    }
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

        // PATCH METHOD:
        if($request_method==='PATCH') {
            echo "PATCH !";
        }

        // DELETE METHOD:
        if($request_method==='DELETE') {
            echo "DELETE !";
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