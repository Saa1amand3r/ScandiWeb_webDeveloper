<?php

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
        // realisation
    }

    private function saveProductForm($form) {
        //realisation
    }
}

?>