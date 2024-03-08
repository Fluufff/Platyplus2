<?php

namespace App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

class LoginControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;

    public function testLoginPage()
    {
        $result = $this->withURI('http://example.com/login')
            ->controller(\App\Controllers\LoginController::class)
            ->execute('index');

        $this->assertTrue($result->isOK());
    }
}