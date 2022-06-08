<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Product.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Book.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Dvd.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Furniture.php');

    class ViewController {
        public function __construct() {
            $this->view();
            
        }

        public function __destruct() {
        }

        private function view() {
            $books = Book::loadAll();
            $furnitureArray = Furniture::loadAll();
            $dvds = Dvd::loadAll();
            $simpleProductArray = array_merge(Product::simplifyAllElements($books), 
                                              Product::simplifyAllElements($furnitureArray),
                                              Product::simplifyAllElements($dvds));
            foreach($simpleProductArray as $simpleProduct) {
                $jsonProductArray [] = $simpleProduct->toArray();
                
            }
            echo json_encode($jsonProductArray);
            
        }
    }

?>