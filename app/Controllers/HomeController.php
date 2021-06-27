<?php

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $params = [
            "title" => "Welcome",
            "data" => "Index view",
            "footer" => "Adress"
        ];
        $this->return_view("home", $params);
    }

    public function show($request)
    {
        $id = $request['get']['id'];
        $params = [
            "title" => "Welcome",
            "data" => "You are on index view #{$id}",
            "footer" => "Adress"
        ];
        $this->return_view("home", $params);
    }
}
