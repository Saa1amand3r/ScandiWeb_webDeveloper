<?php
include_once ('ProductEntity.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/Models/ViewModel/SimpleProductViewModel.php');

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
            //change with BookToArray() method
            $parametersForBook = [$this->getPrice(),$this->getWeight(), $this->getSku(), $this->getName()];
            ProductEntity::saveProduct(self::TYPE, $this->getSku(), self::SQL_SAVE_VALUES_TO_ProductEntity_BOOK, $parametersForBook);
        }

        public static function loadAll() {
            return ProductEntity::loadAllElements(self::SQL_LOAD_ALL_VALUES, self::TYPE."Entity");
        }

        public function simplify() {
            $simpleProductEntity = new SimpleProductViewModel($this, "Weight", $this->getWeight() . "KG", self::TYPE);
            return $simpleProductEntity;
        }
    }

?>