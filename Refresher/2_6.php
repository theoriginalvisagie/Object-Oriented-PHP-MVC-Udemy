<?php
    class OtherUser{
        protected $name;
        protected $age;

        public function __construct($name, $age){
            $this->name = $name;
            $this->age = $age;
        }
    }

    class Customer extends OtherUser{
        private $balance;

        public function __construct($name, $age, $balance){
            parent::__construct($name, $age);
            $this->balance = $balance;
        }

        public function pay($amount){
            return $this->name . " paid R" . $amount;
        }

        public function getBalance()
        {
            return $this->balance;
        }
    }

    $customer1 = new Customer("Christiaan", 26, 600);

    echo $customer1->pay(100);

    echo "<br>";

    echo $customer1->getBalance();
?>