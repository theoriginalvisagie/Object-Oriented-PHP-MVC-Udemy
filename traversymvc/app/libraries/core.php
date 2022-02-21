<?php
    /** App Core Class
     *  Creates URL & loads controller
     *  URL format - /controller/method/params
     */

    class Core{
        protected $currentController = "Pages";
        protected $currentMethod = "index";
        protected $params = [];

        public function __construct(){
            //print_r($this->getUrl());
           $url = $this->getUrl();
           //Look for first value in controllers

           if(file_exists("../app/controllers/".ucwords($url[0]). ".php")){
               //If file exists
               $this->currentController = ucwords($url[0]);
               //Unset 0 index
               unset($url[0]);
           }

           //Require Controller
           require_once("../app/controllers/".$this->currentController.".php");

           $this->currentController = new $this->currentController;

           //Check for second param -> method to be called
           if(isset($url[1])){
               //Check to see if method exists
               if(method_exists($this->currentController, $url[1])){
                   $this->currentMethod = $url[1];
                   unset($url[1]);
               }
           }

           //get params
           $this->params = $url ? array_values($url) : [];

           //Call callback with array of params
           call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

        //    echo "HERE".$this->currentMethod;
        }

        public function getUrl(){
            // echo $_GET['url'];
            if(isset($_GET['url'])){
               
                //Split Url to use
                $url = rtrim($_GET['url'],"/");
                $url = filter_var($url, FILTER_SANITIZE_URL);

                //Turn into array
                $url = explode("/",$url);
                return $url;
            }
        }
    }
?>