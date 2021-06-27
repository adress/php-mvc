<?php

namespace Core;

abstract class Controller
{
    private $view;

    protected function return_view($view_name = '', $params = array())
    {
        $this->view = new View($view_name, $params);
    }
}
