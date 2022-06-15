<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/service/ViewController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/service/FormController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/service/Request.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/DBRequestParser.php';

    class Gateway {

        private $renderedProducts;

        public function __construct($form) {
            $this->viewActionHandler();

            $formProcessor = new FormController($form, $this->getRenderedProducts());
            if ($formProcessor->checkIsFormSet()) {
                $request = $formProcessor->processForm();
                $this->databaseRequestHandler($request);
            }

            
        }

        private function databaseRequestHandler($request) {
            $dbRequestParser = new DBRequestParser();
            $result = $dbRequestParser->parse($request);
            
            if ($result != null) {
                return $result;
            } else {
                header('Location: http://localhost/ScandiWeb_webDeveloper/');
            }
        }


        private function setRenderedProducts($renderedProducts) {
            $this->renderedProducts = $renderedProducts;
        }

        private function getRenderedProducts() {
            return $this->renderedProducts;
        }

        private function viewActionHandler() {
            $request = new Request();
            $request->setAction(Request::LOADALL);
            $result = $this->databaseRequestHandler($request);
            

            $viewController = new ViewController();
            $renderedProducts = $viewController->render($result);
            $this->setRenderedProducts($renderedProducts);
        }

        

    }

?>