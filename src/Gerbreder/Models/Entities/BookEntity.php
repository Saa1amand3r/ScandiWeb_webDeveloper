<?php

namespace Gerbreder\Models\Entities;

use Gerbreder\Models\ViewModel\SimpleProductViewModel as SimpleProductViewModel;

    class BookEntity extends ProductEntity{

        private const SQL_SAVE_VALUES_TO_ProductEntity_BOOK = 'INSERT INTO `product_book` SET price=?, weight=?, sku=?, name=?, id=?';
        private const SQL_DELETE_OBJECT_BY_ID = 'DELETE FROM `product_book` WHERE id=?';
        private const SQL_LOAD_ALL_VALUES = 'SELECT * FROM `product_book`';
        private const TYPE = "Book";

        private $weight;



        public function getWeight() {
            return $this->weight;
        }

        public function setWeight($weight) {
            $this->weight = $weight;
        }

        private function setValues($data) {
            $this->setSku($data['sku']);
            $this->setName($data['name']);
            $this->setPrice($data['price']);
            $this->setWeight($data['weight']);
        }

        public function __construct($data) {
            if (!empty($data)) {
                $this->setValues($data);
            }
        }

        public function delete() {
            ProductEntity::deleteProduct($this->getId(), self::SQL_DELETE_OBJECT_BY_ID);
        }


        public function save() {
            ProductEntity::saveProduct(self::TYPE, $this->getSku(), self::SQL_SAVE_VALUES_TO_ProductEntity_BOOK, $this->toArray());
        }

        public static function loadAll() {
            return ProductEntity::loadAllElements(self::SQL_LOAD_ALL_VALUES, self::TYPE."Entity");
        }

        public function simplify() {
            return new SimpleProductViewModel($this, "Weight", $this->getWeight() . "KG", self::TYPE);
        }

        public function toArray() {
            return [$this->getPrice(),$this->getWeight(), $this->getSku(), $this->getName()];
        }
    }

?>