<?php
    class Pages extends Controller{
        public function __construct(){
            // echo "Pages Loaded";
            $this->postModel = $this->model("Post");
        }

        public function index(){
            // echo "PAGES INDEX";
            $data = array("tile"=>"Welcome");
            $this->view("pages/index",$data);
        }

        public function about(){
            $data = array("tile"=>"About");
            $this->view("pages/about", $data);
        }
    }
?>