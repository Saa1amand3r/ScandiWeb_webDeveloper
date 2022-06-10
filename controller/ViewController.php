<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Product.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Book.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Dvd.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Furniture.php');

    class ViewController {
        public function __construct() {
            $this->view();
        }

        private function view() {
            $simpleProductArray = Product::loadAndSimplify();
            if (!empty($simpleProductArray)) {
                foreach($simpleProductArray as $simpleProduct) {
                    $jsonProductArray [] = $simpleProduct->toArray();
                }
                echo json_encode($jsonProductArray);
            }
        }
    }

?>