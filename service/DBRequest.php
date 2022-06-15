<?php

    class DBRequest extends Request{

        public function __construct($model, $action, $data = []) {
            //do setters instead of direct statements
            $this->model = $model;
            $this->action = $action;
            $this->data = $data;
        }
    }

?>