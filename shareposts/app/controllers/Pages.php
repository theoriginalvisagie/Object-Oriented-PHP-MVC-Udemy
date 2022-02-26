<?php
    class Pages extends Controller{

        public function __construct(){

        }

        public function index(){
            $data = array(
                "title"=>"SharePosts",
                "description"=>"mvc framework"
                );
            $this->view("pages/index",$data);
        }

        public function about(){
            $data = array(
                "title"=>"About",
                "description"=>"Share Posts"
                );
            $this->view("pages/about", $data);
        }
    }
?>