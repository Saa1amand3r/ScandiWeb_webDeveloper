<?php

namespace Gerbreder\Controllers;

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