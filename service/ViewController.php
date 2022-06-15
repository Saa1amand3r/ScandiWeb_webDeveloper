<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Product.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Book.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Dvd.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Furniture.php');

    class ViewController {

        public function render($simpleProductArray) {
            if (!empty($simpleProductArray) && is_array($simpleProductArray)) {
                foreach($simpleProductArray as $simpleProduct) {
                    $jsonProductArray [] = $simpleProduct->toArray();
                }
                echo json_encode($jsonProductArray);
            } 
            
            return $simpleProductArray;
        }
    }

?>