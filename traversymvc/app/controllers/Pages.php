<?php
    class Pages extends Controller{
        public function __construct(){
            // echo "Pages Loaded";
        }

        public function index(){
            echo "PAGES INDEX";
            $data = array("tile"=>"Welcome");
            $this->view("pages/index",$data);
        }

        public function about()
        {
            echo "PAGES about";

            $this->view("pages/about");
        }
    }
?>