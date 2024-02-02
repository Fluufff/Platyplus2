<?php

namespace App\Controllers;


use App\Models\LoginModel;

class Login extends BaseController
{
    public function index()
    {
        $page = 'Login';
        $data['title'] = ucfirst($page); // Capitalize the first letter

        $model = model(LoginModel::class);
        $data['test'] = $model->getTest();

        return view('header.php', $data)
            . view('Login/index.php')
            . view('footer.php');
    }    
}
