<?php
    class Pages extends Controller{

        public function __construct(){

        }

        public function index(){
            $data = array("tile"=>"Welcome");
            $this->view("pages/index",$data);
        }

        public function about(){
            $data = array("tile"=>"About");
            $this->view("pages/about", $data);
        }
    }
?>