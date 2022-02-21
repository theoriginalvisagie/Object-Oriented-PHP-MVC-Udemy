<?php
    /**
     * Static methods and properties
     * Value is not relative to certain instance
     * relative to class itself
     * Don't need to instantiate class/object to use it
     */

    class StaticUser{
        //Unique to every instance of object
        public $name;
        public $age;

        //Alwasy remains the same
        public static $minPassLenght = 6;

        public static function validatePass($pass){
            if(strlen($pass) >= self::$minPassLenght){
                return true;
            }else{
                return false;
            }
        }
    }

    //Using static method and property
    $password = "Hello";
    if(StaticUser::validatePass($password)){
        echo "Valid";
    }else{
        echo "Not Valid";
    }
?>