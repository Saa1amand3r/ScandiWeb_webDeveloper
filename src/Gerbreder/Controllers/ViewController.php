<?php

namespace Gerbreder\Controllers;

    class ViewController {

        private $preparedData;

        private function getPreparedData() {
            return $this->preparedData;
        }

        private function setPreparedData($data) {
            $this->preparedData = $data;
        }

        public function render($simpleProductArray) {
            if (!empty($simpleProductArray) && is_array($simpleProductArray)) {
                $this->prepareDataForRender($simpleProductArray);
                echo $this->getPreparedData();
            }
            return $simpleProductArray;
        }

        private function prepareDataForRender($data) {
            foreach($data as $simpleProduct) {
                $jsonProductArray [] = $simpleProduct->toArray();
            }
            $this->setPreparedData(json_encode($jsonProductArray));
        }
    }

?>