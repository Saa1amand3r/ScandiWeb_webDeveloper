<?php

include_once ('DataBaseConnection.php');
include_once ('Product.php');

    class Dvd extends Product{
        private const SQL_SAVE_TO_PRODUCT = 'INSERT INTO `product` SET type = "dvd", sku=?'; 
        private const SQL_SAVE_VALUES_TO_PRODUCT_DISK = 'INSERT INTO `product_disk` SET id=?, price=?, size=?, sku=?, name=?';
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

        }


        public function save() {
            $dbCon = new DataBaseConnection();
            $link = $dbCon->connect();
            
            $stmt = $dbCon->prepared_query($link, Dvd::SQL_SAVE_TO_PRODUCT, [$this->sku]);
            $stmt->store_result();

            $lastId = $link->insert_id;
            $stmt = $dbCon->prepared_query($link, Dvd::SQL_SAVE_VALUES_TO_PRODUCT_DISK, [$lastId, $this->price, $this->size,$this->sku, $this->name]);
            $stmt->store_result();

            $link->close;
        }
    }

?>