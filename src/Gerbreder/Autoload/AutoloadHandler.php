<?php

    namespace Gerbreder\Autoload;

    class AutoloadHandler {
        
        public static function autoload() {
            spl_autoload_register(function ($className) {
                $ds = DIRECTORY_SEPARATOR;
                $filepath = $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/src/' . str_replace('\\', $ds, $className) . '.php';
                require($filepath);
            });
        }
    }

?>