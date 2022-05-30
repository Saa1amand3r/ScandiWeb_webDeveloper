<?php

class FormController {
    public function processForm($id, $form) {
        if ($id == "delete-button-form") {
            $this->deleteProductForm($form);
        }
        if ($id == "product-form") {
            $this->saveProductForm($form);
        }
        header ('Location: http://localhost/ScandiWeb_webDeveloper/');
    }

    private function deleteProductForm($form) {
        // realisation
        //header ('Location: http://localhost/ScandiWeb_webDeveloper/'); // delete when will be realisation of this method
    }

    private function saveProductForm($form) {
        //realisation
        //header ('Location: http://localhost/ScandiWeb_webDeveloper/'); // delete when will be realisation of this method

    }
}

?>