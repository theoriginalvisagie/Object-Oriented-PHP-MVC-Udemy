<?php
    class Posts extends Controller{

        public function __construct(){
            if(!isLoggedIn()){
                redirect("users/login");
            }    

            $this->postModel = $this->model("Post");
            $this->userModel = $this->model("User");
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

        public function edit($id){
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                //SANITIZE post array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = array(
                    "id" => $id,
                    "title" => trim($_POST['title']),
                    "body" => trim($_POST['body']),
                    "userID" => trim($_SESSION['user_id']),
                    "title_err" => "",
                    "body_err" => "",
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
                    if($this->postModel->updatePost($data)){   
                        flash("post_message","Post Updated");
                        redirect("posts");
                    }else{
                        die("OOPS");
                    }
                }else{
                    $this->view("posts/edit", $data);
                }

            }else{
                // Get existing post
                $post = $this->postModel->getPostById($id);
                //Check for owner
                if($post->userID != $_SESSION['user_id']){
                    redirect("posts");
                }

                $data = array(
                    "id" => $id,
                    "title" => $post->title,
                    "body" => $post->body
                );
            }
            

            $this->view('posts/edit', $data);
        }

        public function show($id){
            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->userID);
            $data = array(
                "post"=>$post,
                "user"=>$user
            );
            $this->view("posts/show", $data);
        }

        public function delete($id){

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                 //Check for owner
                $post = $this->postModel->getPostById($id);
                if($post->userID != $_SESSION['user_id']){
                    redirect("posts");
                }

                if($this->postModel->deletePost($id)){
                    flash("post_message","Post Removed","alert alert-danger");
                    redirect("posts");
                }else{
                    die("DELETE");
                }
                
            }else{
                redirect("posts");
            }
           
        
        }
    }
?>