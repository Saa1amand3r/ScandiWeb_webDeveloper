<?php

    class QueryService{

        private const SQL_DELETE_OBJECT_FROM_PRODUCTS_BY_ID = 'DELETE FROM `product` WHERE id=?';
        private const SQL_DELETE_OBJECT_BY_ID = 'DELETE FROM `?` WHERE id=?';
        private const SQL_LOAD_ALL_VALUES = 'SELECT * FROM `{$table}`';
        private const SQL_SAVE_TO_PRODUCT = 'INSERT INTO `product` SET type = "?", sku=?';
    
        private $lastOperationId;
        private $link;

        public function __construct() {
            $dbCon = new DataBaseConnection();
            //setter!!!
            $this->link = $dbCon->connect();
        }

        public function __destruct() {
            $this->link->close();
        }

        private function setLastOperationId($id) {
            $this->lastOperationId = $id;
        }

        private function getLastOperationId() {
            return $this->lastOperationId;
        }


        public function preparedQuery($sql, $params, $types = "")
        {

            $types = $types ?: str_repeat("s", count($params));
            $stmt = $this->link->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            if (!$stmt) {
                throw new Exception("SQL ERROR");
            }

            $lastId = $this->link->insert_id;
            $this->setLastOperationId($lastId);
            
            

            return $stmt;
        }

        public function query($sql) {
            return $this->link->query($sql);
        }
    }

?>