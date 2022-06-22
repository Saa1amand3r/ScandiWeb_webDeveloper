<?php

namespace Gerbreder\Controllers;

    class ValidationController {
    
        private $validData;

        private function setValidData($data) {
            $this->validData = $data;
        }

        public function getValidData() {
            return $this->validData;
        }

        public function __construct($form) {
            $this->setValidData($this->validator($form));
        }

        private function validator($data) {
            foreach($data as $key => $value) {
                $data[$key] = trim($value);
                $data[$key] = stripslashes($value);
                $data[$key] = htmlspecialchars($value);
            }
            return $data;
        }
    }

?>