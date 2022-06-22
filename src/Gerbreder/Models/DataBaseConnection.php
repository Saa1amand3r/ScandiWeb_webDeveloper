<?php

namespace Gerbreder\Models;

use Gerbreder\Configuration\Config as Config;

    class DataBaseConnection {

        private $link;
        private $lastOperationId;

        private function setLink($link) {
            $this->link = $link;
        }
        
        public function setLastOperationId() {
            $this->lastOperationId = $this->getLink()->insert_id;
        }

        public function getLastOperationId() {
            return $this->lastOperationId;
        }

        private function getLink() {
            return $this->link;
        }

        public function connect() {
            $this->setLink(mysqli_connect(Config::DATABASE_ADDRESS,Config::DATABASE_USERNAME,Config::DATABASE_PASSWORD,Config::DATABASE_NAME));
            if ($this->getLink() == false) {
                throw new Exception("ERROR: Cant connect to MYSQL: " + mysqli_connect_error());
            }
            else {
                mysqli_set_charset($this->getLink(), "utf8");
            }
        }
        
        public function preparedQuery($sql, $params, $types = "")
        {
            $types = $types ?: str_repeat("s", count($params));
            $stmt = $this->getLink()->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            return $stmt;
        }

        public function query($sql) {
            return $this->getLink()->query($sql);
        }

        public function close() {
            $this->getLink()->close();
        }

    }


?>