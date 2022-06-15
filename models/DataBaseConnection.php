<?php

    class DataBaseConnection {
        private const SERVER_ADDRESS = "localhost";
        private const USERNAME = "root";
        private const DATABASE_NAME = "scandiweb_junior";
        private const PASSWORD = "";

        private $link;
        private $lastId;

        public function connect() {
            //setter
            $this->link = mysqli_connect(DataBaseConnection::SERVER_ADDRESS,DataBaseConnection::USERNAME,DataBaseConnection::PASSWORD,DataBaseConnection::DATABASE_NAME);
            if ($this->link == false) {
                throw new Exception("ERROR: Cant connect to MYSQL: " + mysqli_connect_error());
            }
            else {
                mysqli_set_charset($this->link, "utf8");
            }
        }
        
        public function preparedQuery($sql, $params, $types = "")
        {
            $types = $types ?: str_repeat("s", count($params));
            $stmt = $this->link->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            return $stmt;
        }

        public function query($sql) {
            return $this->link->query($sql);
        }

        public function saveLastOperationId() {
            $this->lastId = $this->link->insert_id;
        }

        public function getLastOperationId() {
            return $this->lastId;
        }
        public function close() {
            $this->link->close();
        }

    }


?>