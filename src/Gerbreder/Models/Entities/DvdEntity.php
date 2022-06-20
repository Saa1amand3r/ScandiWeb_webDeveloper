<?php

namespace Gerbreder\Models\Entities;

use Gerbreder\Models\ViewModel\SimpleProductViewModel as SimpleProductViewModel;

    class DvdEntity extends ProductEntity{ 
        private const SQL_SAVE_VALUES_TO_PRODUCT_DVD = 'INSERT INTO `product_dvd` SET price=?, size=?, sku=?, name=?, id=?';
        private const SQL_DELETE_OBJECT_BY_ID = 'DELETE FROM `product_dvd` WHERE id=?';
        private const SQL_LOAD_ALL_VALUES = 'SELECT * FROM `product_dvd`';
        private const TYPE = "Dvd";
        private $size;

        public function getSize() {
            return $this->size;
        }

        public function setSize($size) {
            $this->size = $size;
        }

        function __construct($data) {
            if (!empty($data)) {
                $this->setSku($data['sku']);
                $this->setName($data['name']);
                $this->setPrice($data['price']);
                $this->setSize($data['size']);
            }
        }

        public function delete() {
            ProductEntity::deleteProduct($this->getId(), self::SQL_DELETE_OBJECT_BY_ID);
        }


        public function save() {
            $parametersForDvd = [$this->getPrice(), $this->getSize(),$this->getSku(), $this->getName()];
            ProductEntity::saveProduct(self::TYPE, $this->getSku(),self::SQL_SAVE_VALUES_TO_PRODUCT_DVD, $parametersForDvd);
        }

        public static function loadAll() {
            return ProductEntity::loadAllElements(self::SQL_LOAD_ALL_VALUES, self::TYPE."Entity");
        }

        public function simplify() {
            $simpleProduct = new SimpleProductViewModel($this, "Size", $this->getSize() . " MB", self::TYPE);
            return $simpleProduct;
        }
    }

?>