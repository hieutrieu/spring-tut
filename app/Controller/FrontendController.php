<?php

namespace App\Controller;
use Framework\Blade\View;

class FrontendController {
    protected $title    = '';
    protected $view     = null;
    protected $viewVars = [];
    protected $data = [];
    public $uriVars = [];
    private $filePath = '';
    public function __construct()
    {
        $this->filePath = __APP__.'/config/config.php';
        $this->data = include $this->filePath;
        $this->viewVars['config'] = $this->data;
        $this->viewVars['uriVars'] = $this->getUri();
    }

    protected function setTitle($title) {
        $this->title = $title;
        $this->viewVars['title'] = $this->title;
    }

    protected function render($viewPath) {
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

    public function redirect($redirectTo, $errorCode = 301) {
        header("Status: $errorCode Moved Permanently", false, $errorCode);
        header("Location:{$redirectTo}");
        exit;
    }

    public function getUri() {
        if(isset($_SERVER['REQUEST_URI'])) {
            $this->urlVars = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        }
        return $this->urlVars;
    }
}
