<?php

namespace App\Controller;

class HomeController extends FrontendController {
    public function index(){
        return $this->render('home.index')->with([]);
    }
}
