<?php
    class Users{
        public $name;
        public $age;

        /**
         * Constructors run when object is created/instantiated
         * Can take properties and set them
         * Runs everytime a new instance of object is created
         * Part of the Magic Methods
         */
        public function __construct($name, $age){
            // echo "Contructor ran";

            /*=====[Magic Constant]=====*/
            echo __CLASS__ . " Instatiated<br>";
            /*==========*/

            //Setting public properties when class is instantiated
            $this->name = $name;
            $this->age = $age;
        }

        public function sayHello(){
            return $this->name . " Says Hello";
        }

        /**
         * Destructor called when no other references to a certain object
         * Used for cleanup, closing connections etc
         * Part of the Magic Methods
         */
        public function __destruct(){
            echo "Destructor ran";
            
        }
    }

    //Creating multiple instaces of one class and using them.
    $user1 = new Users("Christiaan", "26");
    echo $user1->name ." is " . $user1->age . " years old ";
    echo "<br>";
    echo $user1->sayHello();

    echo "<br>";

    $user2 = new Users("Sarah", "22");
    echo $user2->name ." is " . $user2->age . " years old ";
    echo "<br>";
    echo $user2->sayHello();
?>