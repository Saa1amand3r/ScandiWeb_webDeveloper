<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/controller/ViewController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/controller/FormController.php';
$formController = new FormController(); // optimize
$formController->processForm($_POST);
$viewController = new ViewController();
?>