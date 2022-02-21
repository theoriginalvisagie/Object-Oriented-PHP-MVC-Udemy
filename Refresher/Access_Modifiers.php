<?php
    class newUser{
        /**
         * 3 types of properties
         * private -> only this class can access
         * public -> anywhere can access
         * protected -> this class + any class that extends it
         */
        private $name;
        private $age;

        public function __construct($name, $age){
            $this->name = $name;
            $this->age = $age;
        }
        
        /*=====[custom getters and setters]=====*/
        //Getter - fetches the name
        public function getName(){
            return $this->name;
        }

        //Setter Sets the name
        public function setName($name){
            $this->name = $name;
        }
        /*==========*/

        //__get Magic Method
        public function __get($property){
            if(property_exists($this,$property)){
                return $this->$property;
            }
        }

        //__set Magic Method
        public function __set($property, $value){
            if(property_exists($this,$property)){
                $this->$property = $value;
            }

            return $this->$property;
        }
       
    }

    $user1 = new newUser("John", 48);

    // echo $user1->setName("Geoff");
    // echo $user1->getName();

    echo $user1->__get("name");

    $user1->__set("age",48);
    echo $user1->__get("age");

?>