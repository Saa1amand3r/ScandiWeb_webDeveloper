<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/controller/FormController.php';
$formController = new FormController();
$formController->processForm($_POST);
?>