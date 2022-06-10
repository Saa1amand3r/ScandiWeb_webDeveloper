<?php

include_once ('DataBaseConnection.php');
include_once ('Product.php');

    class Dvd extends Product{
        private const SQL_SAVE_TO_PRODUCT = 'INSERT INTO `product` SET type = "dvd", sku=?'; 
        private const SQL_SAVE_VALUES_TO_PRODUCT_DVD = 'INSERT INTO `product_dvd` SET id=?, price=?, size=?, sku=?, name=?';
        private const SQL_LOAD_ALL_VALUES_FROM_PRODUCT_DVD = 'SELECT * FROM `product_dvd`';
        private const SQL_DELETE_OBJECT_BY_ID = 'DELETE FROM `product_dvd` WHERE id=?';
        private const SQL_DELETE_OBJECT_FROM_PRODUCTS_BY_ID = 'DELETE FROM `product` WHERE id=?';
        private $size;

        public function getSize() {
            return $this->size;
        }

        public function setSize($size) {
            $this->size = $size;
        }

        function __construct($data) {
            $this->setSku($data['sku']);
            $this->setName($data['name']);
            $this->setPrice($data['price']);
            $this->setSize($data['size']);
        }

        public function delete() {
            $dbCon = new DataBaseConnection();
            $link = $dbCon->connect();

            $dbCon->preparedQuery($link, Dvd::SQL_DELETE_OBJECT_BY_ID, [$this->id]);
            $dbCon->preparedQuery($link, Dvd::SQL_DELETE_OBJECT_FROM_PRODUCTS_BY_ID, [$this->id]);

            $link->close();
        }


        public function save() {
            $dbCon = new DataBaseConnection();
            $link = $dbCon->connect();
            
            $stmt = $dbCon->preparedQuery($link, Dvd::SQL_SAVE_TO_PRODUCT, [$this->sku]);
            $stmt->store_result();

            $lastId = $link->insert_id;
            $stmt = $dbCon->preparedQuery($link, Dvd::SQL_SAVE_VALUES_TO_PRODUCT_DVD, [$lastId, $this->price, $this->size,$this->sku, $this->name]);
            $stmt->store_result();

            $link->close;
        }

        public static function loadAll() {
            $objects = Product::loadAllElements(Dvd::SQL_LOAD_ALL_VALUES_FROM_PRODUCT_DVD, 'Dvd');
            return $objects;
        }

        public function simplify() {
            $simpleProduct = new SimpleProduct($this, "Size", $this->getSize() . " MB");
            return $simpleProduct;
        }
    }

?>