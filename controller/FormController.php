<?php
include_once ('ValidationController.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Book.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Dvd.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/models/Furniture.php');

class FormController {
    public function processForm($form) {
        if (isset($form['form_id'])){ // checking if form is sended.
            $id = $form['form_id'];
            if ($id == "delete-button-form") {
                $this->deleteProductForm($form);
            }
            if ($id == "product-form") {
                $this->saveProductForm($form);
            }
            header ('Location: http://localhost/ScandiWeb_webDeveloper/');
        }
    }

    private function deleteProductForm($form) {
        $books = Book::loadAll();
        $furnitureArray = Furniture::loadAll();
        $dvds = Dvd::loadAll();
        foreach($books as $product) {
            if (isset($form[$product->getId()])) {
                $product->delete();
            }
        }
        foreach($dvds as $product) {
            if (isset($form[$product->getId()])) {
                $product->delete();
            }
        }
        foreach($furnitureArray as $product) {
            if (isset($form[$product->getId()])) {
                $product->delete();
            }
        }
    }

    private function saveProductForm($form) {
        $validationMethod = 'validator' . $form['productType'];
        $validationController = new ValidationController();
        $validData = $validationController->$validationMethod($form);
        if ($validData) {
            $model = $validData['productType'];
            $object = new $model($validData);
            $object->save();
        }
    }
}

?>