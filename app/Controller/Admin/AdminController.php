<?php

namespace App\Controller\Admin;
use App\Libraries\Acl\Acl;
use App\Libraries\Breadcrumb\Breadcrumbs;
use App\Libraries\Menu\Menu;
use Framework\Blade\View;
use Framework\Flash\Flash;
use Framework\Session\Session;

class AdminController {
    protected $title    = '';
    protected $menu     = null;
    protected $view     = null;
    protected $viewVars = [];
    protected $bc       = null;
    protected $admin    = [];
    protected $flash    = null;

    public function __construct()
    {
        $this->bc = new Breadcrumbs();
        $this->addMenu();
        $this->checkAuth();
        $this->viewVars['admin'] = $this->admin;
        $this->flash = Flash::getInstance();
        $this->viewVars['flash'] = $this->flash;
    }


    protected function setTitle($title) {
        $this->title = $title;
        $this->viewVars['title'] = $this->title;
    }

    protected function render($viewPath) {
        $this->addViewVar('bc', $this->bc->generate());
        return View::make($viewPath)->with($this->viewVars);
    }

    /**
     * @param array $variables
     */
    protected function addViewVars(array $variables)
    {
        foreach($variables as $variable => $value) {
            $this->viewVars[$variable] = $value;
        }
    }

    protected function addViewVar($variable, $value)
    {
        $this->viewVars[$variable] = $value;
    }

    protected function resetViewVars()
    {
        $this->viewVars = [];
    }

    protected function addMenu()
    {
        $this->menu = new Menu(array(
            array(
                'path' => 'admin/users',
                'label' => 'Users Manager',
                'icon' => 'user'
            ),
//            array(
//                'path' => 'admin/groups',
//                'label' => 'Groups Manager',
//                'icon' => 'users'
//            ),
            array(
                'path' => 'admin/config',
                'label' => 'Price Manager',
                'icon' => 'cogs'
            ),
        ));
        $this->viewVars['menu'] = $this->menu;
    }

    public function checkAuth() {
        $acl = Acl::getInstance();
        $functionArray = explode("/", $_SERVER['REDIRECT_URL'] );
        $session = Session::getInstance();
        if($session->get('telephone_auth')) {
            $this->admin = $session->get('telephone_auth');
            if (in_array($functionArray[2], array_keys($acl->getResources()))) {
                if (!$acl->getAcl()->isAllowed($this->admin['permission'], $functionArray[2], '*')) {
                    $this->redirect(url('admin/errors/access'));
                }
            }
        } else {
            $this->redirect(url('admin/auth/login'));
        }
    }

    public function redirect($redirectTo, $errorCode = 301) {
        header("Status: $errorCode Moved Permanently", false, $errorCode);
        header("Location:{$redirectTo}");
        exit;
    }
}
