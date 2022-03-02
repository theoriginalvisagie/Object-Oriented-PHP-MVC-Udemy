<?php
    class Users extends Controller {
        public function __construct(){
            $this->userModel = $this->model('Users');
        }

        public function register(){
            //Check for post
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                //Process Form

                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Init Data
                $data = array(
                    "name" => trim($_POST['name']),
                    "email" => trim($_POST['email']),
                    "password" => trim($_POST['password']),
                    "confirm_password" => trim($_POST['confirm_password']),
                    "name_err" => "",
                    "email_err" => "", 
                    "password_err" => "",
                    "confirm_password_err" => ""
                );

                //Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = "Please enter email";
                }else{
                    //Check email
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = "Email is already taken";
                    }
                }

                //Validate Name
                if(empty($data['name'])){
                    $data['name_err'] = "Please enter name";
                }

                //validate password
                if(empty($data['password'])){
                    $data['password_err'] = "Please enter password";
                }else if(strlen($data['password']) < 6){
                    $data['password_err'] = "Password must be at least 6 characters";
                }

                //Validate Confirm Password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = "Please confirm password";
                } else {
                    if($data['password'] != $data['confirm_password']){
                        $data['confirm_password_err'] = "Passwords do not match";
                    }
                }

                //Make sure errors are empty
                if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                    die("SUCCESS");
                }else{
                    //Load view with errors
                    $this->view("users/register", $data);
                }
                    //Validated
                    
                    // //Hash Password
                    // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // //Register User
                    // if($this->userModel->register($data)){
                    //     flash('register_success', 'You are registered and can log in');
                    //     redirect('users/login');
                    // }else{
                    //     die('Something went wrong');
                    // }
            }else{
                //Init Data
                $data = array(
                    "name" => "",
                    "email" => "",
                    "password" => "",
                    "confirm_password" => "",
                    "name_err" => "",
                    "email_err" => "", 
                    "password_err" => "",
                    "confirm_password_err" => ""
                );

                //Load View
                $this->view("users/register", $data);
            }
        }

        public function login(){
            //Check for post
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                //Process Form

                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Init Data
                $data = array(
                    "email" => trim($_POST['email']),
                    "password" => trim($_POST['password']),
                    "email_err" => "", 
                    "password_err" => "",
                );

                  //Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = "Please enter email";
                } 

                  //validate password
                if(empty($data['password'])){
                    $data['password_err'] = "Please enter password";
                }

                if(empty($data['email_err']) && empty($data['password_err'])){
                    die("SUCCESS");
                }else{
                    //Load view with errors
                    $this->view("users/login", $data);
                }

            }else{
                //Init Data
                $data = array(
                    "email" => "",
                    "password" => "",
                    "email_err" => "", 
                    "password_err" => ""
                );

                //Load View
                $this->view("users/login", $data);
            }
        }
    }
?>