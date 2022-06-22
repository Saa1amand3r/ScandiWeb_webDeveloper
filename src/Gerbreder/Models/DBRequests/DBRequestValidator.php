<?php 

namespace Gerbreder\Models\DBRequests;

use Gerbreder\Gateway\Request as Request;

    class DBRequestValidator{

        public function validate($request) {
            if ($request->getAction() != "none") {
                $types = $request->getActionTypes();
                foreach($types as $type => $typeValue) {
                    if ($request->getAction() == $typeValue) {
                        return true;
                    }
                }
                return false;
            } else {
                return false;
            }
        }

    }

?>