<?php

namespace Gerbreder\Models\ViewModel;

use Gerbreder\Models\Entities\BookEntity as BookEntity;
use Gerbreder\Models\Entities\ProductEntity as ProductEntity;
use Gerbreder\Models\Entities\DvdEntity as DvdEntity;
use Gerbreder\Models\Entities\FurnitureEntity as FurnitureEntity;

    class SimpleProductViewModel{
        private const ENTITY_NAMESPACE_PREFIX = "Gerbreder\Models\Entities\\";
        private $paramName;
        private $id;
        private $sku;
        private $name;
        private $price;
        private $parameters;
        private $type;

        public function __construct($object, $paramName, $parameters, $type) {
            $this->setSku($object->getSku());
            $this->setName($object->getName());
            $this->setPrice($object->getPrice());
            $this->setId($object->getId());
            $this->setParameters($parameters);
            $this->setParamName($paramName);
            $this->setType($type);
        }

        public function getType() {
            return $this->type;
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

        protected function setType($type) {
            $this->type = $type;
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

        public function toBasicProduct() {
            $model = ProductEntity::ENTITY_NAMESPACE_PREFIX.$this->getType()."Entity";
            $object = new $model([]);
            $object->setId($this->getId());
            $object->setName($this->getName());
            $object->setSku($this->getSku());
            $object->setPrice($this->getPrice());
            return $object;
        }
    }

?>