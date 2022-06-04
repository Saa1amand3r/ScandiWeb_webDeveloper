<?php
include_once ('DataBaseConnection.php');
include_once ('Product.php');

    class Book extends Product{
        private const SQL_SAVE_TO_PRODUCT = 'INSERT INTO `product` SET type = "book", sku=?'; 
        private const SQL_SAVE_VALUES_TO_PRODUCT_BOOK = 'INSERT INTO `product_book` SET id=?, price=?, weight=?, sku=?, name=?';
        private $weight;

        public function getWeight() {
            return $this->weight;
        }

        public function setWeight($weight) {
            $this->weight = $weight;
        }

        function __construct($data) {
            $this->setSku($data['sku']);
            $this->setName($data['name']);
            $this->setPrice($data['price']);
            $this->setWeight($data['weight']);
        }

        public function delete() {

        }


        public function save() {
            $dbCon = new DataBaseConnection();
            $link = $dbCon->connect();
            
            $stmt = $dbCon->prepared_query($link, Book::SQL_SAVE_TO_PRODUCT, [$this->sku]);
            $stmt->store_result();

            $lastId = $link->insert_id;
            $stmt = $dbCon->prepared_query($link, Book::SQL_SAVE_VALUES_TO_PRODUCT_BOOK, [$lastId, $this->price, $this->weight,$this->sku, $this->name]);
            $stmt->store_result();

            $link->close;
        }
    }

?>