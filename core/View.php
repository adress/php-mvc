<?php

namespace Core;

use Helper;

class View
{
    protected $template;
    protected $viewName;
    protected $params;

    public function __construct($viewName, $params = array())
    {
        $this->viewName = $viewName;
        $this->params = $params;
        $this->render();
    }

    protected function render()
    {
        $file_name = $this->viewName;
        $this->template = $this->getContentTemplate($file_name);
        echo $this->template; //shows the view
    }

    protected function getContentTemplate($file_name)
    {
        $file_path = Helper::join_paths(__DIR__ ,"/../resources/views/","{$file_name}.php");
        //var_dump($file_path);
        extract($this->params);
        ob_start(); //inicia el buffer
        require($file_path);
        $template = ob_get_contents(); //asigna lo obtenido al template
        ob_end_clean(); //cierra el buffer
        return $template;
    }
}
