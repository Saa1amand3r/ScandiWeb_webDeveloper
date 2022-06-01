<?php
    
    abstract class Product{
        protected $id;
        protected $sku;
        protected $name;
        protected $price;

        abstract public function delete();
        abstract public function save();

        public function getId() {
            return $this->$id;
        }
        public function getSku() {
            return $this->$sku;
        }
        public function getName() {
            return $this->$name;
        }
        public function getPrice() {
            return $this->$price;
        }

        public function setSku($sku){
            $this->$sku = $sku;
        }
        public function setName($name) {
            $this->$name = $name;
        }
        public function setPrice($price) {
            $this->$price = $price;
        }
    }


?>