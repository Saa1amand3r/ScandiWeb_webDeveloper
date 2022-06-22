<?php

namespace Gerbreder\Controllers;

use Gerbreder\Controllers\ValidationController as ValidationController;
use Gerbreder\Gateway\Request as Request;

class FormController {
    private $form;
    private $formType;
    private $renderedProducts;
    
    private function setForm($form) {
        $this->form = $form;
    }
    private function setFormType($formType) {
        $this->formType = $formType;
    }
    private function setRenderedProducts($renderedProducts) {
        $this->renderedProducts = $renderedProducts;
    }
    
    private function getForm() {
        return $this->form;
    }
    
    private function getFormType() {
        return $this->formType;
    }
    
    private function getRenderedProducts() {
        return $this->renderedProducts;
    }

    public function __construct($form, $renderedProducts = []) {
        $this->setForm($form);
        $this->setRenderedProducts($renderedProducts);
    }

    private function deleteActionProcessing() {

        $deleteQueue = [];

        if (!empty($this->getRenderedProducts())) {
            $deleteQueue = $this->findMarkedProducts();
            $request = new Request();
            $request->setAction(Request::DELETE);
            $request->setData($deleteQueue);
            return $request;
        }
        else {
            $request = new Request();
            $request->setAction(Request::NONE);
            return $request;
        }
    }

    private function saveActionProcessing() {
        $productModel = $this->form['productType'];
        $validData = $this->validateForm();
        $request = new Request();
        $request->setAction(Request::SAVE);
        $request->setModel($productModel);
        $request->setData($validData);
        return $request;
    }

    public function checkIsFormSet() {
        if (isset($this->getForm()['form_id'])) {
            return true;
        }
        else {
            return false;
        }
    }

    private function checkFormType() {
        $id = $this->getForm()['form_id'];
        if ($id == "delete-button-form") {
            $this->setFormType("deleteActionProcessing");
        }
        if ($id == "product-form") {
            $this->setFormType("saveActionProcessing");
        }
    }

    public function processForm() {
        $this->checkFormType();
        $method = $this->getFormType();
        return $this->$method();
    }


    private function findMarkedProducts() {
        foreach ($this->getRenderedProducts() as $product) {
            if (isset($this->getForm()[$product->getId()])) {
                $deleteQueue[] = $product;
            }
        }
        return $deleteQueue;
    }

    private function validateForm() {
        $validationController = new ValidationController($this->getForm());
        $validData = $validationController->getValidData();
        return $validData;
    }
}

?>