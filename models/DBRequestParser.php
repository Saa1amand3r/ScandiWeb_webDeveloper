<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/service/Request.php';
require_once "DBRequestValidator.php";
    class DBRequestParser {

        private $request;

        public function parse($DBRequest) {
            // setter!!!
            $this->request = $DBRequest;
            $action = $this->request->getAction();

            $requestValidator = new DBRequestValidator();
            
            if ($requestValidator->validate($this->request)) {
                $method = $action . "ActionParse";
                return $this->$method();
            } else {
                return null;
            }
        }

        private function saveActionParse() {
            $model = $this->request->getModel();
            $object = new $model($this->request->getData());
            $object->save();
            return null;
        }

        private function loadAllActionParse() {
            $objects = Product::loadAllProducts();
            return $objects;
        }

        private function deleteActionParse() {
            foreach ($this->request->getData() as $product) {
                $object = $product->toBasicProduct();
                $object->delete();
            }
            return null;
        }

    }

?>