<?php

namespace App\Controller;

class ErrorsController extends FrontendController {
    public function __construct() {
        parent::__construct();
        $this->setTitle('Errors');
    }

    public function access() {
        return $this->render('errors.access');
    }
}
