<?php

    class RequestParser{


        // maybe add request validation

        public function parseRequestType($request) {
            $requestType = $request->getRequestType();
            if ($requestType == "Gateway") {
                return gatewayRequestParse($request);
            } 
            if ($requestType == "DataBase") {
                return databaseRequestParser();
            }
            else {
                throw new Exception("UNKNOWN REQUEST TYPE");
            }
        }

        private function gatewayRequestParse ($request) {
            $action = $request->getAction() . "ActionRequestHandler";
            return $action;
        }

        private function databaseRequestParser() {
            return "databaseRequestHandler";
        }

    }

?>