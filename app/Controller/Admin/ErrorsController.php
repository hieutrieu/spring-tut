<?php

namespace App\Controller\Admin;

class ErrorsController extends AdminController {
    public function __construct() {
        parent::__construct();
        $this->setTitle('Errors');
        $this->bc->add('Errors', 'admin/errors');
    }

    public function access() {
        return $this->render('admin.errors.access');
    }
    public function exception() {
        return $this->render('admin.errors.exception')->with($this->viewVars);
    }
}
