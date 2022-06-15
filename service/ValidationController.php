<?php

    class ValidationController {
        private $errors = [];
        private $validData;

        public function __construct($validatingModel, $form) {
            $validationMethod = 'validator' . $validatingModel;
            //setter!!!
            $this->validData = $this->$validationMethod($form);
        }

        public function getValidData() {
            return $this->validData;
        }

        private function validator($data) {
            foreach($data as $key => $value) {
                $data[$key] = trim($value);
                $data[$key] = stripslashes($value);
                $data[$key] = htmlspecialchars($value);
            }

            if (empty($data['sku'])) {
                $skuErr = "SKU is required";
                $this->errors[] = $skuErr;
                return 0;
            } else {
                if (!preg_match("/^[A-Za-z0-9]*$/",$data['sku'])) {
                    $skuErr = "Only letters and numbers allowed";
                    $this->errors[] = $skuErr;
                }
            }

            if (empty($data['name'])) {
                $nameErr = "Name is required";
                $this->errors[] = $nameErr;
                return 0;
            } else {
                if (!preg_match("/^[0-9a-zA-Z-' ]*$/",$data['name'])) {
                    $nameErr = "Only letters and white space allowed";
                    $this->errors[] = $nameErr;
                }
            }

            if (empty($data['price'])) {
                $priceErr = "Price is required";
                $this->errors[] = $priceErr;
                return 0;
            }

            if (empty($this->errors)) {
                return $data;
            }
        }

        private function validatorBook($data) {
            
            $data = $this->validator($data);
            if (empty($data['weight'])) {
                $weightErr = "Weight is required";
                $this->errors[] = $weightErr;
                return 0;
            }
            if (empty($this->errors)) {
                return $data;
            }
        }

        private function validatorDvd($data) {
            
            $data = $this->validator($data);
            if (empty($data['size'])) {
                $sizeErr = "Size is required";
                $this->errors[] = $sizeErr;
                return 0;
            }
            if (empty($this->errors)) {
                return $data;
            }
        }

        private function validatorFurniture($data) {

            $data = $this->validator($data);
            if (empty($data['height'])) {
                $heightErr = "Height is required";
                $this->errors[] = $heightErr;
                return 0;
            }
            if (empty($data['width'])) {
                $widthErr = "Width is required";
                $this->errors[] = $widthErr;
                return 0;
            }
            if (empty($data['length'])) {
                $lengthErr = "Length is required";
                $this->errors[] = $lengthErr;
                return 0;
            }
            if (empty($this->errors)) {
                return $data;
            }
        }
    }

?>