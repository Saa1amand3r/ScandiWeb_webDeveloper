<?php

    class Book extends Product{
        private const SQL_SAVE_TYPE_TO_PRODUCT = 'INSERT INTO product SET type = "book"';
        private const SQL_SAVE_SKU_TO_PRODUCT = 'INSERT INTO product SET sku=?'; 
        private const SQL_SAVE_INT_VALUES_TO_PRODUCT_BOOK = 'INSERT INTO product_book SET id=?, price=?, weight=?';
        private const SQL_SAVE_STR_VALUES_TO_PRODUCT_BOOK = 'INSERT INTO product_book SET sku=?, name=?';
        private $weight;

        public function getWeight() {
            return $this->$weight;
        }

        public function setWeight($weight) {
            $this->$weight = $weight;
        }

        public function delete() {

        }
        public function save() {
            $dbCon = new DataBaseConnection();
            $link = $dbCon->connect();
            $result = $mysqli_query($link, Book::SQL_SAVE_TYPE_TO_PRODUCT);
            if ($result == false) {
                throw new Exception("SQL query execution failed");
            }

            $stmt = $link->prepare(Book::SQL_SAVE_SKU_TO_PRODUCT);
            $stmt->bind_param("s", $this->$sku);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result == false) {
                throw new Exception("SQL query execution failed");
            }

            $lastId = mysqli_insert_id($link);
            $stmt = $link->prepare(Book::SQL_SAVE_INT_VALUES_TO_PRODUCT_BOOK);
            $stmt->bind_param("i", $lastId, $this->$price, $this->$weight);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result == false) {
                throw new Exception("SQL query execution failed");
            }

            $stmt = $link->prepare(Book::SQL_SAVE_STR_VALUES_TO_PRODUCT_BOOK);
            $stmt->bind_param("s", $this->$sku, $this->$name);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result == false) {
                throw new Exception("SQL query execution failed");
            }
        }
    }

?>