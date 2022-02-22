<?php
    /**
     * Base Controller
     * Loads models and views
     */

    class Controller{
        // Load the Model
        public function model($model){
            // Look for model file 
            require_once("../app/models/".$model.".php");

            //Instantiate model
            return new $model();
        }

        // Load View
        public function view($view, $data = array()){
            // Look for view file 
            // echo "HERE". $view;
            if(file_exists("../app/views/".$view.".php")){
                require_once("../app/views/".$view.".php");
            }else{
                die("View does not exist.");
            }
        }
    }

    
    
?>