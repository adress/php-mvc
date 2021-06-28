<?php

namespace App\Controllers;

use App\Models\UserModel;
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
        $user = new UserModel();
        $name = $user->findById($id)['name'] ?? '';
        $params = [
            "title" => "Welcome",
            "data" => ucwords($name) . " Welcome to Show View",
            "footer" => "Adress"
        ];
        $this->return_view("home", $params);
    }
}
