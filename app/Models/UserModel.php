<?php

namespace App\Models;

use Core\Model;

class UserModel extends Model
{
    public $table = "users";

    public function __construct()
    {
        parent::__construct();
    }
}
