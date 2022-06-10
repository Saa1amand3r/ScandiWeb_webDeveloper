<?php
    
    abstract class Product{
        protected $id;
        protected $sku;
        protected $name;
        protected $price;

        abstract public function delete();
        abstract public function save();
        abstract public static function loadAll();
        abstract public function simplify();

        public function getId() {
            return $this->id;
        }
        public function getSku() {
            return $this->sku;
        }
        public function getName() {
            return $this->name;
        }
        public function getPrice() {
            return $this->price;
        }

        protected function setId($id) {
            $this->id = $id;
        }
        protected function setSku($sku){
            $this->sku = $sku;
        }
        protected function setName($name) {
            $this->name = $name;
        }
        protected function setPrice($price) {
            $this->price = $price;
        }
        protected static function loadAllElements($sql, $model) {
            $dbCon = new DataBaseConnection();
            $link = $dbCon->connect();
            $objects = [];

            $result = $link->query($sql);
            if (!$result) {
                throw new Exception ("SQL doesnt work");
            }
            while ($row = mysqli_fetch_array($result)) {
                $object = new $model($row);
                $object->setId($row['id']);
                
                $objects[] = $object;
            }
            
            $link->close();
            return $objects;
        }

        public static function simplifyAllElements($data) {
            if (!empty($data)){
                foreach($data as $object) {
                    $simpleProduct = $object->simplify();
                    $simpleProductArray[] = $simpleProduct;
                }
                return $simpleProductArray;
            }
        }

        public static function loadAndSimplify() {
            $products[] = Book::loadAll(); //NULL
            $products[] = Furniture::loadAll();
            $products[] = Dvd::loadAll();
            $simpleProductArray = [];
            foreach($products as $array) {
                if (!empty($array)) {
                    $simpleProductArray = array_merge($simpleProductArray, Product::simplifyAllElements($array));
                }
            }
            return $simpleProductArray;
        }
    }


?>