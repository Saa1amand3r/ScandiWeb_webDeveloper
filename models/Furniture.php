<?php

include_once ('DataBaseConnection.php');
include_once ('Product.php');

    class Furniture extends Product{
        private const SQL_SAVE_TO_PRODUCT = 'INSERT INTO `product` SET type = "furniture", sku=?'; 
        private const SQL_SAVE_VALUES_TO_PRODUCT_FURNITURE = 'INSERT INTO `product_furniture` SET id=?, price=?, sku=?, name=?, height=?, width=?, length=?';
        private const SQL_LOAD_ALL_VALUES_FROM_PRODUCT_FURNITURE = 'SELECT * FROM `product_furniture`';
        private $height;
        private $width;
        private $length;

        public function getHeight() {
            return $this->height;
        }

        public function setHeight($height) {
            $this->height = $height;
        }

        public function getWidth() {
            return $this->width;
        }

        public function setWidth($width) {
            $this->width = $width;
        }

        public function getLength() {
            return $this->length;
        }

        public function setLength($length) {
            $this->length = $length;
        }

        function __construct($data) {
            $this->setSku($data['sku']);
            $this->setName($data['name']);
            $this->setPrice($data['price']);
            $this->setHeight($data['height']);
            $this->setWidth($data['width']);
            $this->setLength($data['length']);
        }

        public function delete() {

        }


        public function save() {
            $dbCon = new DataBaseConnection();
            $link = $dbCon->connect();
            
            $stmt = $dbCon->preparedQuery($link, Furniture::SQL_SAVE_TO_PRODUCT, [$this->sku]);
            $stmt->store_result();

            $lastId = $link->insert_id;
            $stmt = $dbCon->preparedQuery($link, Furniture::SQL_SAVE_VALUES_TO_PRODUCT_FURNITURE, [$lastId, $this->price,$this->sku, $this->name,
                                                                                               $this->height, $this->width, $this->length]);
            $stmt->store_result();

            $link->close;
        }

        public static function loadAll() {
            $objects = Product::loadAllElements(Furniture::SQL_LOAD_ALL_VALUES_FROM_PRODUCT_FURNITURE, 'Furniture');
            return $objects;
        }

        public function simplify() {
            $simpleProduct = new SimpleProduct($this, "Dimension", $this->getHeight() . "x" . $this->getWidth() . "x" . $this->getLength());
            return $simpleProduct;
        }
    }

?>