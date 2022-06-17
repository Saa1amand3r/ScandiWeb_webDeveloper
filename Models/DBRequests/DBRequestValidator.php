<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/ScandiWeb_webDeveloper/Gateway/Request.php';

    class DBRequestValidator{

        public function validate($request) {
            if ($request->getAction() != "none") {
                $types = $request->getActionTypes();
                foreach($types as $type => $typeValue) {
                    if ($request->getAction() == $typeValue) {
                        return true;
                    }
                }
                throw new Exception("ACTION IS UNREGISTRED");
            } else {
                return false;
            }
        }

    }

?>