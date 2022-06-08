<?php

    class DataBaseConnection {
        private const SERVER_ADDRESS = "localhost";
        private const USERNAME = "root";
        private const DATABASE_NAME = "scandiweb_junior";
        private const PASSWORD = "";

        public function connect() {
            $sql = mysqli_connect(DataBaseConnection::SERVER_ADDRESS,DataBaseConnection::USERNAME,DataBaseConnection::PASSWORD,DataBaseConnection::DATABASE_NAME);
            if ($sql == false) {
                throw new Exception("ERROR: Cant connect to MYSQL: " + mysqli_connect_error());
            }
            else {
                mysqli_set_charset($sql, "utf8");
                return $sql;
            }
        }
        
        public function preparedQuery($mysqli, $sql, $params, $types = "")
        {
            $types = $types ?: str_repeat("s", count($params));
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            return $stmt;
        }

        
    }


?>