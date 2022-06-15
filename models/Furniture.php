<?php

include_once ('Product.php');
include_once ('SimpleProduct.php');


    class Furniture extends Product{ 
        private const SQL_SAVE_VALUES_TO_PRODUCT_FURNITURE = 'INSERT INTO `product_furniture` SET price=?, sku=?, name=?, height=?, width=?, length=?, id=?';
        private const SQL_DELETE_OBJECT_BY_ID = 'DELETE FROM `product_furniture` WHERE id=?';
        private const SQL_LOAD_ALL_VALUES = 'SELECT * FROM `product_furniture`';
        private const TYPE = "Furniture";
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
            if (!empty($data)) {
                $this->setSku($data['sku']);
                $this->setName($data['name']);
                $this->setPrice($data['price']);
                $this->setHeight($data['height']);
                $this->setWidth($data['width']);
                $this->setLength($data['length']);
            }
        }

        public function delete() {
            Product::deleteProduct($this->getId(), self::SQL_DELETE_OBJECT_BY_ID);
        }


        public function save() {
            //furnitureToArray()
            $parametersForFurniture = [$this->getPrice(),$this->getSku(), $this->getName(),
                                       $this->getHeight(), $this->getWidth(), $this->getLength()];
            Product::saveProduct(self::TYPE, $this->getSku(), self::SQL_SAVE_VALUES_TO_PRODUCT_FURNITURE, $parametersForFurniture);
        }

        public static function loadAll() {
            return Product::loadAllElements(self::SQL_LOAD_ALL_VALUES, self::TYPE);
        }

        public function simplify() {
            $simpleProduct = new SimpleProduct($this, "Dimension", $this->getHeight() . "x" . $this->getWidth() . "x" . $this->getLength(), self::TYPE);
            return $simpleProduct;
        }
    }

?>