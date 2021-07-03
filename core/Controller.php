<?php

namespace Core;

abstract class Controller
{
    private $view;

    protected function return_view($view_name = '', $params = array())
    {
        $this->view = new View($view_name, $params);
    }

    protected function json_response($data = null, $httpStatus = 200)
    {
        header_remove();
        header("Content-Type: application/json");
        http_response_code($httpStatus);
        echo json_encode($data);
        exit();
    }
}
