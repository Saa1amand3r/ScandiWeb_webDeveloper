<?php
include_once ('ValidationController.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/Gateway/Request.php');

class FormController {
    private $form;
    private $formType;
    private $renderedProducts;
    
    public function __construct($form, $renderedProducts = []) {
        //setters!!!
        $this->form = $form;
        $this->renderedProducts = $renderedProducts;
    }

    private function deleteActionProcessing() {

        $deleteQueue = [];

        //getter!!!
        if (!empty($this->renderedProducts)) {
            foreach ($this->renderedProducts as $product) {
                if (isset($this->form[$product->getId()])) {
                    $deleteQueue[] = $product;
                }
            }
            
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
        $validatingModel = $this->form['productType'];
        $validationController = new ValidationController($validatingModel, $this->form);
        // $validData = $validationController->getValidData();
        $validData = $this->form;
        $request = new Request();
        $request->setAction(Request::SAVE);
        $request->setModel($validatingModel);
        $request->setData($validData);
        return $request;
        
    }

    public function checkIsFormSet() {
        if (isset($this->form['form_id'])) {
            return true;
        }
        else {
            return false;
        }
    }

    public function checkFormType() {
        $id = $this->form['form_id'];
        if ($id == "delete-button-form") {
            $this->formType = "deleteActionProcessing";
        }
        if ($id == "product-form") {
            $this->formType = "saveActionProcessing";
        }
    }

    public function processForm() {
        $this->checkFormType();
        $method = $this->formType;
        return $this->$method();
    }

}

?>