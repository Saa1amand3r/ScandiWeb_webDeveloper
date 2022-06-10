<?php

include_once ('Product.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Book.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Dvd.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Furniture.php');


    class SimpleProduct{
        private $paramName;
        private $id;
        private $sku;
        private $name;
        private $price;
        private $parameters;

        public function __construct($object, $paramName, $parameters) {
            $this->setSku($object->getSku());
            $this->setName($object->getName());
            $this->setPrice($object->getPrice());
            $this->setId($object->getId());
            $this->setParameters($parameters);
            $this->setParamName($paramName);
        }

        public function getId() {
            return $this->id;
        }
        public function getSku() {
            return $this->sku;
        }
        public function getName() {
            return $this->name;
        }
        public function getPrice() {
            return $this->price;
        }

        protected function setId($id) {
            $this->id = $id;
        }
        protected function setSku($sku){
            $this->sku = $sku;
        }
        protected function setName($name) {
            $this->name = $name;
        }
        protected function setPrice($price) {
            $this->price = $price;
        }

        public function getParamName() {
            return $this->paramName;
        }

        public function getParameters() {
            return $this->parameters;
        }

        public function setParamName($paramName) {
            $this->paramName = $paramName;
        }

        public function setParameters($params) {
            $this->parameters = $params;
        }

        public function toArray() {
            $data = array (
                "id" => $this->getId(),
                "name" => $this->getName(),
                "sku" => $this->getSku(),
                "price" => $this->getPrice(),
                "paramName" => $this->getParamName(),
                "parameters" => $this->getParameters()
            );
            return $data;
        }
    }

?>