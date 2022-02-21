<?php
    //Define Class
    class User{
        // Properties(attributes)

        //Instatiate public property and set it
        // public $name = "Christiaan";

        //Instatiate public property
        public $name;


        //Methods (functions)
        public function sayHello(){
            //Access property
            return $this->name. " Says hello";
            // return "hello";
        }
    }

    //Creating Object
    $user1 = new user();

    //Call a property and set it
    $user1->name = "Christiaan";
    echo $user1->name;
    echo "<br>";
    //Call a Method
    echo $user1->sayHello();

    echo "<br>";

    //Create New User and set property value
    $user2 = new User();
    $user2->name = "Sam";
    echo $user2->sayHello();

?>