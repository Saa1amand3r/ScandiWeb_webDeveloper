<?php

    class ValidationController {
        
        private const FIELD_NAMES = [
            "name", "sku", "price"
        ];
        private const VALIDATION_RULES = [
            "name" => "/^[0-9a-zA-Z-' ]*$/",
            "sku" => "/^[A-Za-z0-9]*$/"
        ];
        private const ERROR_TEXT = [
            "name" => "Only letters and white space allowed",
            "sku" => "Only letters and numbers allowed"
        ];
        
        private $errors = [];
        private $validData;
        private $validatingModel;

        public function __construct($validatingModel, $form) {
            $this->setValidatingModel($validatingModel);
            $this->setValidData($this->$validator);
        }

        private function validator($data) {
            foreach($data as $key => $value) {
                $data[$key] = trim($value);
                $data[$key] = stripslashes($value);
                $data[$key] = htmlspecialchars($value);
            }

            foreach(self::FIELD_NAMES as $name) {
                if (empty($data[$name])) {
                    $this->addErrorToErrors($name." is required");
                } else {
                    if ($name !="price" && !preg_match(self::VALIDATION_RULES[$name],$data[$name])) {
                        $this->addErrorToErrors(ERROR_TEXT[$name]);
                    }
                }
            }

            if (empty($this->getErrors())) {
                $validationMethod = 'validator' . $this->getValidatingModel();
                $result = $this->$validationMethod($data);
                return $result;
            }
            throw new Exception("Validation error");
        }

        private function validatorBook($data) {
            if (empty($data['weight'])) {
                $weightErr = "Weight is required";
                $this->addErrorToErrors($weightErr);
            }
            if (empty($this->getErrors())) {
                return $data;
            }
            return 0;
        }

        private function validatorDvd($data) {
            if (empty($data['size'])) {
                $sizeErr = "Size is required";
                $this->addErrorToErrors($sizeErr);
            }
            if (empty($this->getErrors())) {
                return $data;
            }
            return 0;
        }

        private function validatorFurniture($data) {
            if (empty($data['height'])) {
                $heightErr = "Height is required";
                $this->addErrorToErrors($heightErr);
                
            }
            if (empty($data['width'])) {
                $widthErr = "Width is required";
                $this->addErrorToErrors($widthErr);
                
            }
            if (empty($data['length'])) {
                $lengthErr = "Length is required";
                $this->addErrorToErrors($lengthErr);
                
            }
            if (empty($this->getErrors())) {
                return $data;
            }
            return 0;
        }


        private function setValidData($data) {
            $this->validData = $data;
        }
        private function addErrorToErrors($error) {
            $this->errors[] = $error;
        }

        public function getValidData() {
            return $this->validData;
        }

        public function getErrors() {
            return $this->errors;
        }

        public function setValidatingModel($model) {
            $this->validatingModel = $model;
        }
        public function getValidatingModel() {
            return $this->validatingModel;
        }
    }

?>