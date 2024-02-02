<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'test';

    public function getTest()
    {
        return $this->findAll();
    }
}
