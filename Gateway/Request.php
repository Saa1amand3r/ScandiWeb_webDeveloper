<?php

    class Request{
        public const LOADALL= "loadAll";
        public const SAVE = "save";
        public const DELETE = "delete";
        public const NONE = "none";

        private $action;
        private $requestType;
        private $data;
        private $model;

        public static function getActionTypes() {
            $reflection = new ReflectionClass('Request');
            return $reflection->getConstants();
        }

        public function setAction($action) {
            $this->action = $action;
        }
        
        public function setRequestType($requestType) {
            $this->requestType = $requestType;
        }

        public function setData($data) {
            $this->data = $data;
        }
        
        public function setModel($model) {
            $this->model = $model;
        }

        public function getAction() {
            return $this->action;
        }

        public function getData() {
            return $this->data;
        }

        public function getRequestType() {
            return $this->requestType;
        }

        public function getModel() {
            return $this->model;
        }
    }

?>