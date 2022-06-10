<?php
include_once ('DataBaseConnection.php');
include_once ('Product.php');
include_once ('SimpleProduct.php');

    class Book extends Product{
        private const SQL_SAVE_TO_PRODUCT = 'INSERT INTO `product` SET type = "book", sku=?'; 
        private const SQL_SAVE_VALUES_TO_PRODUCT_BOOK = 'INSERT INTO `product_book` SET id=?, price=?, weight=?, sku=?, name=?';
        private const SQL_LOAD_ALL_VALUES_FROM_PRODUCT_BOOK = 'SELECT * FROM `product_book`';
        private const SQL_DELETE_OBJECT_BY_ID = 'DELETE FROM `product_book` WHERE id=?';
        private const SQL_DELETE_OBJECT_FROM_PRODUCTS_BY_ID = 'DELETE FROM `product` WHERE id=?';
        private $weight;

        public function getWeight() {
            return $this->weight;
        }

        public function setWeight($weight) {
            $this->weight = $weight;
        }

        public function __construct($data) {
            if (!empty($data)) {
                $this->setSku($data['sku']);
                $this->setName($data['name']);
                $this->setPrice($data['price']);
                $this->setWeight($data['weight']);
            }
        }

        public function delete() {
            $dbCon = new DataBaseConnection();
            $link = $dbCon->connect();

            $dbCon->preparedQuery($link, Book::SQL_DELETE_OBJECT_BY_ID, [$this->id]);
            $dbCon->preparedQuery($link, Book::SQL_DELETE_OBJECT_FROM_PRODUCTS_BY_ID, [$this->id]);

            $link->close();
        }


        public function save() {
            $dbCon = new DataBaseConnection();
            $link = $dbCon->connect();
            
            $stmt = $dbCon->preparedQuery($link, Book::SQL_SAVE_TO_PRODUCT, [$this->sku]);
            $stmt->store_result();

            $lastId = $link->insert_id;
            $stmt = $dbCon->preparedQuery($link, Book::SQL_SAVE_VALUES_TO_PRODUCT_BOOK, [$lastId, $this->price, $this->weight,$this->sku, $this->name]);
            $stmt->store_result();

            $link->close;
        }

        public static function loadAll() {
            $objects = Product::loadAllElements(Book::SQL_LOAD_ALL_VALUES_FROM_PRODUCT_BOOK, 'Book');
            return $objects;
        }

        public function simplify() {
            $simpleProduct = new SimpleProduct($this, "Weight", $this->getWeight() . "KG");
            return $simpleProduct;
        }
    }

?>