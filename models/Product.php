<?php
    
include_once ('DataBaseConnection.php');

    abstract class Product{
        private const SQL_SAVE_TO_PRODUCT = 'INSERT INTO `product` SET type =?, sku=?';
        private const SQL_DELETE_OBJECT_FROM_PRODUCTS_BY_ID = 'DELETE FROM `product` WHERE id=?';

        protected $id;
        protected $sku;
        protected $name;
        protected $price;

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

        public function setId($id) {
            $this->id = $id;
        }
        public function setSku($sku){
            $this->sku = $sku;
        }
        public function setName($name) {
            $this->name = $name;
        }
        public function setPrice($price) {
            $this->price = $price;
        }

        protected static function saveProduct($type, $sku, $uniqueSQL, $uniqueParameters) {
            $connection = new DataBaseConnection();
            $connection->connect();
            $stmt = $connection->preparedQuery(self::SQL_SAVE_TO_PRODUCT, [$type, $sku]);
            $stmt->store_result();
            $connection->saveLastOperationId();
            $uniqueParameters[] = $connection->getLastOperationId();
            $stmt = $connection->preparedQuery($uniqueSQL, $uniqueParameters);
            $connection->close();
        }

        protected static function deleteProduct($id, $uniqueSQL) {
            $connection = new DataBaseConnection();
            $connection->connect();

            $stmt = $connection->preparedQuery(self::SQL_DELETE_OBJECT_FROM_PRODUCTS_BY_ID, [$id]);
            $stmt->store_result();
            $connection->preparedQuery($uniqueSQL, [$id]);

            $connection->close();
        }

        protected static function loadAllElements($sql, $model) {
            $connection = new DataBaseConnection();
            $connection->connect();
            $objects = [];

            $result = $connection->query($sql);
            if (!$result) {
                throw new Exception ("SQL doesnt work");
            }
            while ($row = mysqli_fetch_array($result)) {
                $object = new $model($row);
                $object->setId($row['id']);
                $objects[] = $object;
            }
            
            $connection->close();
            return $objects;
        }


        public static function loadAllProducts() {
            $simpleProductArray = [];
            $classes = self::findAllSubclasses();
            foreach ($classes as $class) {
                $products = $class::loadAll();
                if (!empty($products)) {
                    $simpleProductArray = array_merge($simpleProductArray, Product::simplifyArray($products));
                }
            }
            return $simpleProductArray;
        }

        public static function simplifyArray($data) {
            if (!empty($data)){
                foreach($data as $object) {
                    $simpleProduct = $object->simplify();
                    $simpleProductArray[] = $simpleProduct;
                }
                return $simpleProductArray;
            }
        }

        private static function findAllSubclasses() {
            $classes = [];
            $declaredClasses = get_declared_classes();
            foreach($declaredClasses as $dclass) {
                if (is_subclass_of($dclass, __CLASS__)) {
                    $classes[] = $dclass;
                }
            }
            return $classes;
        }
    }


?>