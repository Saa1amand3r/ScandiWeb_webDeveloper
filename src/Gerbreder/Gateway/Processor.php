<?php

namespace Gerbreder\Gateway;

use Gerbreder\Controllers\ViewController as ViewController;
use Gerbreder\Controllers\FormController as FormController;
use Gerbreder\Models\DBRequests\DBRequestParser as DBRequestParser;

    class Processor {

        private $renderedProducts;


        public function __construct($form) {
            $this->viewActionHandler();

            $formProcessor = new FormController($form, $this->getRenderedProducts());
            if ($formProcessor->checkIsFormSet()) {
                $request = $formProcessor->processForm();
                $this->databaseRequestHandler($request);
            }
        }


        private function setRenderedProducts($renderedProducts) {
            $this->renderedProducts = $renderedProducts;
        }


        private function getRenderedProducts() {
            return $this->renderedProducts;
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