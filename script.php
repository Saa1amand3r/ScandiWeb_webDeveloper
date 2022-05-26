<?php


$formId = isset($_POST['form_id']) ? $_POST['form_id'] : 1;
if ($formId == 2) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/controller/ButtonController.php';
    $deleteButton = new ButtonController();
    $deleteButton->delete();
    header ('Location: http://localhost/ScandiWeb_webDeveloper/');
}

?>