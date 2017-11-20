<?php namespace App\Libraries\Menu;

use Framework\Route;

class Menu {
    /**
     * @var string
     */
    public $class = 'sidebar-menu';
    private $items = array();

    /**
     * @param array $item
     */
    function __construct(array $items)
    {
        $this->items = $items;
    }

    public function renders() {
        $request_uri = preg_split( "/\?/", $_SERVER['REQUEST_URI'], 2 );
        //$requestUri = preg_split( "/\//", $request_uri[0] );
        $menuHtml = "<ul class='{$this->class}'>";
        $menuHtml .= "<li class='header'>MAIN NAVIGATION</li>";
        foreach($this->items as $item) {
            $icon = isset($item['icon'])?"<i class='fa fa-{$item['icon']}'></i>":'';
            if(isset($request_uri[0])) {
                $subClass = url($item['path']) == $request_uri[0] ? 'active' : '';
            } else {
                $subClass = '';
            }
            $menuHtml .= "<li class='treeview {$subClass}'><a href='".url($item['path'])."'>{$icon} <span>{$item['label']}</span></a></li>";
        }
        $menuHtml .= "</ul>";
        return $menuHtml;

    }
}
