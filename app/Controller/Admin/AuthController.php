<?php

namespace App\Controller\Admin;

use App\Libraries\Auth\Auth;
use Framework\Blade\View;
use Framework\Flash\Flash;
use Framework\Response;
use Framework\Session\Session;

class AuthController {
    private $viewVars = array();
    protected function render($viewPath) {
        return View::make($viewPath)->with($this->viewVars);
    }

    public function login() {
        $flash = Flash::getInstance();
        $this->viewVars['flash'] = $flash;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $auth = new Auth();
            if($auth->check($_POST)) {
                return Response::redirect(url('admin/users'));
            } else {
                $flash->error('Email or Password incorrect.');
            }
        }
        return $this->render('admin.auth.login');
    }

    public function logout() {
        $session = new Session();
        $session->end();
        return Response::redirect(url('admin/auth/login'));
    }
}
