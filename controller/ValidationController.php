<?php

    class ValidationController {
        private $errors = [];

        private function validator($data) {
            foreach($data as $key => $value) {
                $data[$key] = trim($value);
                $data[$key] = stripslashes($value);
                $data[$key] = htmlspecialchars($value);
            }

            if (empty($data['sku'])) {
                $skuErr = "SKU is required";
                $this->errors[] = $skuErr;
            } else {
                if (!preg_match("/^[A-Za-z0-9]*$/",$data['sku'])) {
                    $skuErr = "Only letters and numbers allowed";
                    $this->errors[] = $skuErr;
                }
            }

            if (empty($data['name'])) {
                $nameErr = "Name is required";
                $this->errors[] = $nameErr;
            } else {
                if (!preg_match("/^[a-zA-Z-' ]*$/",$data['name'])) {
                    $nameErr = "Only letters and white space allowed";
                    $this->errors[] = $nameErr;
                }
            }

            if (empty($data['price'])) {
                $priceErr = "Price is required";
                $this->errors[] = $priceErr;
            }

            if (empty($this->errors)) {
                return $data;
            }
        }

        public function validatorBook($data) {
            
            $data = $this->validator($data);
            if (empty($data['weight'])) {
                $weightErr = "Weight is required";
                $this->errors[] = $weightErr;
            }
            if (empty($this->errors)) {
                return $data;
            }
        }

        public function validatorDvd($data) {
            
            $data = $this->validator($data);
            if (empty($data['size'])) {
                $sizeErr = "Size is required";
                $this->errors[] = $sizeErr;
            }
            if (empty($this->errors)) {
                return $data;
            }
        }

        public function validatorFurniture($data) {

            $data = $this->validator($data);
            if (empty($data['height'])) {
                $heightErr = "Height is required";
                $this->errors[] = $heightErr;
            }
            if (empty($data['width'])) {
                $widthErr = "Width is required";
                $this->errors[] = $widthErr;
            }
            if (empty($data['length'])) {
                $lengthErr = "Length is required";
                $this->errors[] = $lengthErr;
            }
            if (empty($this->errors)) {
                return $data;
            }
        }
    }

?>