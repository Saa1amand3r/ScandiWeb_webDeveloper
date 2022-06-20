<?php

namespace Gerbreder\Models\DBRequests;

use Gerbreder\Gateway\Request as Request;
use Gerbreder\Models\DBRequests\DBRequestValidator as DBRequestValidator;
use Gerbreder\Models\Entities\ProductEntity as ProductEntity;

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
            $model = ProductEntity::ENTITY_NAMESPACE_PREFIX.$this->request->getModel()."Entity";
            $object = new $model($this->request->getData());
            $object->save();
            return null;
        }

        private function loadAllActionParse() {
            $objects = ProductEntity::loadAllProducts();
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