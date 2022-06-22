<?php

namespace Gerbreder\Gateway;

use Gerbreder\Controllers\ViewController as ViewController;
use Gerbreder\Controllers\FormController as FormController;
use Gerbreder\Models\DBRequests\DBRequestParser as DBRequestParser;
use Gerbreder\Configuration\Config as Config;

    class Processor {

        private $renderedProducts;


        private function setRenderedProducts($renderedProducts) {
            $this->renderedProducts = $renderedProducts;
        }


        private function getRenderedProducts() {
            return $this->renderedProducts;
        }


        public function __construct($form) {
            $this->viewActionHandler();
            $this->formActionHandler($form);
        }


        private function databaseRequestHandler($request) {
            $dbRequestParser = new DBRequestParser();
            $result = $dbRequestParser->parse($request);
            
            if ($result != null) {
                return $result;
            } else {
                $url = Config::HOME_PAGE_FULL_ADDRESS;
                echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
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

        private function formActionHandler($form) {
            $formProcessor = new FormController($form, $this->getRenderedProducts());
            if ($formProcessor->checkIsFormSet()) {
                $request = $formProcessor->processForm();
                $this->databaseRequestHandler($request);
            }
        }

    }

?>