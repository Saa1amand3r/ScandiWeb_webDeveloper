<?php

use Gerbreder\Autoload\AutoloadHandler as Autoloader;
use Gerbreder\Gateway\Processor as Processor;

require_once $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/src/Gerbreder/Autoload/AutoloadHandler.php';

Autoloader::autoload();
$processor = new Processor($_POST);
?>