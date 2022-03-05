<?php
    class Posts extends Controller{

        public function __construct(){
            if(!isLoggedIn()){
                redirect("users/login");
            }    

            $this->postModel = $this->model("Post");
        }

        public function index(){
            //Get Posts
            $posts = $this->postModel->getPosts();
            $data = array(
                "posts" => $posts
            );

            $this->view('posts/index', $data);
        }

        public function add(){
            // die("HERER");
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                //SANITIZE post array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = array(
                    "title" => trim($_POST['title']),
                    "body" => trim($_POST['body']),
                    "userID" => trim($_SESSION['user_id']),
                    "title_err" => trim($_POST['title_err']),
                    "body_err" => trim($_POST['body_err']),
                );

                if(empty($data['title'])){
                    $data['title_err'] = "Please fill in title";
                }

                if(empty($data['body'])){
                    $data['body_err'] = "Please fill in a body";
                }

                // No Errors
                if(empty($data['title_err']) && empty($data['body_err'])){
                    //Validated
                    if($this->postModel->addPost($data)){   
                        echo "POST<pre>".print_r($data,true)."</pre>";
                        flash("post_message","Post Added");
                        redirect("posts");
                    }else{
                        die("OOPS");
                    }
                }else{
                    // Load view with errors
                    $this->view("posts/add", $data);
                }

            }else{
                $data = array(
                    "title" => "",
                    "body" => ""
                );
            }
            

            $this->view('posts/add', $data);
        }
    }
?>