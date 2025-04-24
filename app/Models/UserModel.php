<?php

namespace App\Models;

use Core\Model;

class UserModel extends Model
{
    protected string $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }
}
