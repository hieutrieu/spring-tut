<?php

namespace App\Controller\Admin;
use App\Models\Notifications;
use App\Models\Tokenstatistic;
use Framework\Blade\View;
use Framework\Response;
use Framework\Input;
use Framework\Session\Session;

class DashboardController extends AdminController {
    public function __construct() {
        parent::__construct();
        $this->setTitle('Dashboard');
        $this->bc->add('Dashboard', 'admin/dashboard/index');
    }
    public function index() {
        /*$tokens = Notifications::getInstance()->getAllItems();
        foreach($tokens as $token) {
            Notifications::getInstance()->updateStaticticToday($token['created_at']);
        }*/
        $tokens = Tokenstatistic::getInstance()->getAllItems();
        return $this->render('dashboard.index')->with(array('users' => $tokens));
    }

    public function statisticUser(){
        $limit = Input::get('duration', 15);
        $tokens = Tokenstatistic::getInstance()->getAllItems($limit);
        return json_encode($tokens);
    }
}
